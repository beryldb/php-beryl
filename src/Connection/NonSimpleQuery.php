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
use Beryl\Base\NonQueryResult;

abstract class NonSimpleQuery implements CommandInterface
{
    private $command;
    private $parameters;
    private $client;

    public $iter = false;
    
    public $ok = BRLD_QUERY_OK;
    public $err = array(ERR_QUERY);

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
             $result = new NonQueryResult($this, $response->status, $response->simple);             
             return $result;
             
    }
    
}