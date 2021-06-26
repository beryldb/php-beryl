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

use Beryl\Connection\Protocols;
use Beryl\Exceptions\ConnectionException;
use Beryl\Base\Server as ServerInterface;
use Beryl\Base\Command as CommandInterface;
use Beryl\Base\Response;
use Beryl\Commands\Handler;

class Server implements ServerInterface
{
    private $resource;
    public $last_ping = 0;
    private $host;
    private $port;
    private $errorNo;
    private $error_message;
    private $max_timeout;
    private $connected;
    public  $buffer = [];
    public  $stack = [];
    public  $counter = 0;
    public  $me;
    public  $reply;
    public  $lastcmd;
    public  $code = 0;
    public  $parser;
    public  $debug;
    

   /* 
    * Constructor.
    * 
    * @parameters:
    *
    *         · $args: List of arguments used to connect to server.
    */    

    public function __construct($args)
    {
         $this->host = $args['host'];
         $this->port = $args['port'];
         $this->max_timeout = $args['timeout'];
         
         if (isset($args['debug']))
         {
              $this->debug = $args['debug'];
         }
         else
         {
              $this->debug = false;
         }
         
         $this->errorNo = null;
         $this->error_message = '';
         $this->connect();
         
         $this->send(new Handler('ILOGIN', 'php1' . ' ' . $args['password'] . ' ' . $args['login']));
    }

   /* 
    * Sends a command to the server.
    * 
    * @parameters:
    *
    *         · CommandInterface: Command to send.
    * 
    * @return:
    *
    *         · socket data: Stream of data. 
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

   /* 
    * Sends data to server without awaiting for a return.
    * 
    * @parameters:
    *
    *         · CommandInterface: Command to send.
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
           
            if ($this->debug)
            {            
                echo $message . "\r\n";
            }
            
            $this->code = $str[1];

            if ($this->code == ERR_WRONG_PASS)
            {
                     echo "Incorrect login.\n\r";
                     exit;
            }
            
            if ($this->code == BRLD_RESTART)
            {
                   echo "Restarting.\n\r";
                   exit;
            }
            
            if ($this->code == BRLD_NOTIFICATION || $this->code == BRLD_MONITOR)
            {
                  continue;
            }

            if ($this->code == ERR_MISS_PARAMS)
            {
                    echo "Missing parameters: " . $this->lastcmd;
                    exit;                    
            }
            
            /* Pings should not be added to the buffer. */
            
            if ($str[0] == BRLD_PING)
            {
                  $this->lastping = microtime(true);

                  $this->sendraw(new Handler('PONG', ':cl'));
                  continue;
            }

            if ($this->lastcmd->iter && in_array($this->code, $this->lastcmd->err))
            {
                   $response = new Response($this->code, $this->buffer);
                   $response->simple = $this->buffer[$this->code];
                   $this->buffer = [];
                   return $response;
            }	

            if ($this->lastcmd->iter && $this->code == $this->lastcmd->start)
            {
                    $stacking = true;
                    continue;
            }

            if ($this->lastcmd->iter && $this->code == $this->lastcmd->end)
            {   
                    $stacking = false;
                    $response = new Response($this->code, $this->buffer);
                    $response->stack = $this->stack;
                    $this->buffer = [];
                    $this->stack = [];
                    return $response;
            }

            if ($this->lastcmd->iter && ($this->code == $this->lastcmd->item) && $stacking)
            {
                  $this->counter++;
                  $this->stack[$this->counter] = $message;
                  continue;
            }

            /* Connected */

            if ($this->code == BRLD_CONNECTED)
            {
                     $this->me = $str[2];
                     //echo "Connected";
                     $this->buffer = [];
                     break;
            }
            
            if ($this->code == BRLD_YOUR_FLAGS)
            {
                     break;
            }

            $this->buffer[$this->code] = $message;

            if (isset($this->lastcmd->ok) == $this->code || (count($this->lastcmd->err) > 0 && in_array($this->code, $this->lastcmd->err)))
            {
                   /* reset buffer */
                   
                   $response = new Response($this->code, $this->buffer);
                   $response->simple = $this->buffer[$this->code];
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
    
    public function connect()
    {	
          if (!$this->resource = @stream_socket_client("tcp://{$this->host}:{$this->port}", $this->errorNo, $this->error_message, $this->max_timeout)) 
          {
                 echo "Unable to connect to " . $this->host . ":" . $this->port . ": $this->error_message\r\n";
                 exit;
          }
    }
    
    public function disconnect()
    {
        stream_socket_shutdown($this->resource, STREAM_SHUT_WR);
        $this->resource = null;
    }

    public function ClearBuffer()
    {
        stream_get_line($this->resource, 4096, "\r\n");
        return true;
    }
}

?>