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

class NonQueryResult
{
    public $status;
    public $raw;
    public $lastcmd;
    
    public function __construct($_lastcmd, $_status, $_value)
    {
         $this->lastcmd = $_lastcmd;

         if ($_status == ERR_QUERY)
         {
             $this->value = "NULL";
             return;
         }
         
         $this->code = $_status;

         $str = explode(" ", $_value);
         unset($str[0]);
         unset($str[1]);
         unset($str[2]);

         $_value = implode(" ", $str);
         $_value = substr($_value, 1);
         
         $this->value = $_value;
         
    }    
    
    public function to_json()
    {
         return json_encode($this);
    }    
}

