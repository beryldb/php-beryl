<?php
/*
 * php-beryl - PHP Client for BerylDB.
 * http://www.beryldb.com
 *
 * Copyright (C) 2021 - Carlos F. Ferry <cferry@beryldb.com>
 * 
 * This file is part of BerylDB. BerylDB is free software: you can
 * redistribute it and/or modify it under the terms of the BSD License
 * version 3.
 *
 * More information about our licensing can be found at https://docs.beryl.dev
 */

namespace Beryl\Connection;

use Beryl\Connection\Protocol;
use Beryl\Base\Response;
use Beryl\Connection\Instance;

use Beryl\Base\Server as ServerInterface;
use Beryl\Base\Command as CommandInterface;
use Beryl\Commands\ILogin;
use Beryl\Commands\Pong;

class Server implements ServerInterface
{
        public  $stack   = [];
        private $buffer  = [];
        
        private $counter = 0;
        private $resource;
        private $host;
        private $port;
        private $errorno;
        private $error_msg;
        private $timeout;
        private $last_code;

        public function __construct($args)
        {
              $this->host     =   $args['host'];
              $this->port     =   $args['port'];
              $this->timeout  =   $args['timeout'];

              if (isset($args['debug']))
              {	
                   $this->debug = $args['debug'];
              }
              else
              {
                   $this->debug = false;
              }

              $this->errorno = null;
              $this->error_message = '';
              $this->connect();
        
              $this->send(new ILogin($args['login'], $args['password'])); 
        }

        /* 
         * Connects to remote server.
	 * 
	 * @actions:
         *
         *        · Creates a tcp-based stream socket.
         */    
         
        public function connect()
        {
              if (!$this->resource = @stream_socket_client("tcp://{$this->host}:{$this->port}", $this->errorno, $this->error_msg, $this->timeout)) 
              {
                    Instance::Exit("Unable to connect to " . $this->host . ":" . $this->port . " " . $this->error_message);
              }
        }   
 
        /* 
         * This function sends a raw message to the remote server without
         * reading for a response.
         * 
         * @parameters:
	 *
	 *         · CommandInterface : Command to send.
         */           
         
        public function sendraw(CommandInterface $command)
        {
              if (!$this->resource) 
              {
                   throw new ConnectionException();
              }

              fwrite($this->resource, $command);
        }
        
        public function read() 
        {
             $stacking = false;

             while ($message = stream_get_line($this->resource, 2048, "\r\n"))
             {
                  $str = explode(" ", $message);
    
                  if ($str[0] == Protocol::BRLD_PING)
                  {
                         $this->lastping = microtime(true);
                         $this->sendraw(new Pong(":1"));
                         continue;
                 }
    
                 if ($this->debug)
                 {
                        echo $message . "\r\n";
                 }
                 
                 $this->last_code = $str[1];                 

                 /* These operations are NOT supported by this PHP api. */

                 if ($this->last_code == Protocol::BRLD_NOTIFICATION || $this->last_code == Protocol::BRLD_MONITOR)
                 {
                        continue;
                 }
                 
                 if ($this->last_code == Protocol::ERR_WRONG_PASS)
                 {
                        Instance::Exit("Incorrect login.");
                 }
                 
                 if ($this->last_code == Protocol::BRLD_RESTART)
                 {
                        Instance::Exit("Restarting.");
                 }
                 
                 if ($this->last_code == Protocol::ERR_MISS_PARAMS)
                 {
                         Instance::Exit("Missing parameters: " + $this->lastcmd);
                 }
                 
                 if ($this->last_code == Protocol::BRLD_CONNECTED)
                 {
                        if (isset($str[2]))
                        {
                               $this->me     = $str[2];
                        }
                        else
                        {
                               Instance::Exit("Error while connecting.");
                        }

                        $this->buffer = [];
                  
                        break;
                 }
                 
                 if ($this->lastcmd->iter && in_array($this->last_code, $this->lastcmd->err))
                 {
                        $response         = new Response($this->last_code, $this->buffer);
                        $response->simple = $message;
                        $this->buffer     = [];
                  
                        return $response;
                 }   

                 if ($this->lastcmd->iter && $this->last_code == $this->lastcmd->start)
                 {
                        $stacking = true;
                        continue;
                 }

                 if ($this->lastcmd->iter && $this->last_code == $this->lastcmd->end)
                 {   
                        $stacking        = false;
                        $response        = new Response($this->last_code, $this->buffer);
                        $response->stack = $this->stack;
                        $this->buffer    = [];
                        $this->stack     = [];
                        
                        return $response;
                 }

                 if ($this->lastcmd->iter && ($this->last_code == $this->lastcmd->item) && $stacking)
                 {
                        $this->counter++;
                        $this->stack[$this->counter] = $message;
                        continue;
                 }

                 $this->buffer[$this->last_code] = $message;
                  
                 if (isset($this->lastcmd->ok) == $this->last_code || (count($this->lastcmd->err) > 0 && in_array($this->last_code, $this->lastcmd->err)))            
                 {
                        $response = new Response($this->last_code, $this->buffer);
                        $response->simple = $this->buffer[$this->last_code];
                        $this->buffer = [];
                        return $response;
                 }
                 else
                 {
                        $this->buffer = [];
                        break;
                 }
                  
             }
        }

        /* 
         * Sends a command to the server. A command is typically defined
         * in src/Commands,
         * 
         * @parameters:
	 *
	 *         · CommandInterface    : Command to deliver.
         *
         * @return:
         *
         +         · $read:	: Reading string.	 
         */    
         
        public function send(CommandInterface $command)
        {
             if (!$this->resource) 
             {
                    throw new ConnectionException();
             }
             
             $this->lastcmd = $command;
             fwrite($this->resource, $command);
             return $this->read();
        }

        /* Disconnects from remote server */
        
        public function disconnect()
        {
              stream_socket_shutdown($this->resource, STREAM_SHUT_WR);
              $this->resource = null;
        }

}
