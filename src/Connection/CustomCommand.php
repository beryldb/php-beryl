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

abstract class CustomCommand implements CommandInterface
{
    private $command;
    private $parameters;
    private $client;

    public $iter = false;
    
    public $ok;
    public $err = array();

    public function __construct($_ok, $_err, $client, $command, $parameters)
    {
        $this->command = $command;
        $this->parameters = $parameters;
        $this->client = $client;
        $this->ok = $_ok;
        $this->err = $_err;
    }
    
    public function __toString(): string
    {
        return $this->command . " " . $this->parameters . "\r\n";
    }
    
    public function GetCMD()
    {
         return $this->command;
    }

    public function Run()
    {
             $response = $this->client->send($this);

             $result = [];
             $result['code'] = $response->status;
             
             if ($response->status == $this->ok)
             {
                   $result['status'] = INTERNAL_OK;
             }

             if (in_array($response->status, $this->err))
             {
                   $result['status'] = INTERNAL_ERROR;
             }
            
             $result['value'] =  $response->simple;
             return $result;

    }
    
}