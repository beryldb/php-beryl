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

abstract class CustomListCommand implements CommandInterface
{
    public $end   = Protocol::BRLD_END_LIST;
    public $start = Protocol::BRLD_START_LIST;
    public $item  = Protocol::BRLD_ITEM_LIST;
    
    public $iter  = true;
    public $dual  = false;
    public $split = 0;
    
    public $status;
    
    public $list   = [];
    public $items  = [];

    public $err = array(Protocol::ERR_INPUT);

    public function __construct($client, $command, $parameters)
    {
          $this->command    = $command;
          $this->parameters = $parameters;
          $this->client     = $client;
    }
     
    public function __toString(): string
    {
          return $this->command . " " . $this->parameters . "\r\n";
    }

    public function Run()
    {
          $response = $this->client->send($this);
          
          $this->status = $response->status;
          
          if ($this->status != Protocol::BRLD_END_LIST)
          {
               $this->status = 0;
               return;
          }
          
          $result = new ListResult($this);
          
          if ($response->status == $this->end)
          {
                   $result->append_stack($response->stack);
          }

          $this->items = $result->items;
          $this->list = $result->list;
    }

}

?>