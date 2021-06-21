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
use Beryl\Base\ListResult;

abstract class ListCommand implements CommandInterface
{
    private $command;
    private $parameters;
    private $client;
    
    public $iter = true;
    public $dual = false;
    
    public $end = BRLD_END_LIST;
    public $start = BRLD_START_LIST;
    public $item = BRLD_ITEM;
    
    public $err = array();
    
    public function __construct($client, $command, $parameters)
    {
        $this->command = $command;
        $this->parameters = $parameters;
        $this->client = $client;
    }
    
    public function __toString(): string
    {
        return $this->command . " " . $this->parameters . "\r\n";
    }
    
    public function Run()
    {
             $response = $this->client->send($this);

             $result = new ListResult($this);
             
             if ($response->status == $this->end)
             {
                   $result->append_stack($response->stack);
             }
             
             return $result;
    }
    
}