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
use Beryl\Base\Command as CommandInterface;

abstract class BrldCommand implements CommandInterface
{
    private $command;
    private $parameters;
    private $client;
    
    public $iter     = false;
    public $extra    = false;
    public $comillas = false;
    public $msg	     = false;
    
    public $ok       = Protocol::BRLD_OK;
    public $err      = array(Protocol::ERR_INPUT);

    public function __construct($client, $command, $parameters)
    {
        $this->command = $command;
        
        if (!empty($parameters))
        {
             $this->parameters = $parameters;
        }
        else
        {
             $this->parameters = "";
        }

        $this->client = $client;
    }
    
    public function __toString(): string
    {
         return $this->command . " " . $this->parameters . "\r\n";
    }
    
    public function Run()
    {
         $response = $this->client->send($this);
 
         if ($response->status != $this->ok)
         {
               switch ($response->status)
               {
                    case Protocol::ERR_INPUT:
                           return 0;
                    break;
               }
         }

         $str = explode(" ", $response->simple); 
         
         unset($str[0]);
         unset($str[1]);
         unset($str[2]);
         
         if ($this->msg)
         {
               $value = implode(" ", $str);

               $str = explode(":", $value); 
               return $str[1];
         }
         
         if ($this->extra)
         {
               unset($str[3]);
         }
         
         $value = implode(" ", $str);
         $final = substr($value, 1);         
         
         if ($this->comillas)
         {
              return substr($final, 1, -1);
         }
         
         return $final;
    }

}    

?>