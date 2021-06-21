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

namespace Beryl\Base;

class ListResult
{
    public $raw;
    public $lastcmd;
    public $code;
    public $stack = [];
    public $status;
    public $items = [];
    public $list = array();
    
    public function __construct($_lastcmd)
    {
         $this->lastcmd = $_lastcmd;
    }    
    
    public function append_stack($_stack)
    {

        $this->stack = $_stack;
        
        if ($this->lastcmd->dual)
        {
           foreach ($_stack as $item)
           {
                  $str = explode(" ", $item);
                  $val = $str[3];
              
                  unset($str[0]);
                  unset($str[1]);
                  unset($str[2]);
                  unset($str[3]);
              
                 $format = implode(" ", $str);
                 $format = substr($format, 1);
                 $this->items[$val] = $format;
           }
      }
      else
      {
           foreach ($_stack as $item)
           {
                  $str = explode(" ", $item);

                  unset($str[0]);
                  unset($str[1]);
                  unset($str[2]);
              
                 $format = implode(" ", $str);
                 $format = substr($format, 1);
                 array_push($this->list, $format);
           }
              
      }
        
    }
    
        
    
    public function to_json()
    {
         return json_encode($this->items);
    }    
}

