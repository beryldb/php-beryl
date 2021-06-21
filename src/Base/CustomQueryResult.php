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

class CustomQueryResult
{
    public $status;
    public $raw;
    public $value;
    public $lastcmd;
    public $code;
    
    public function __construct($_lastcmd, $_status, $_value)
    {
         $this->lastcmd = $_lastcmd;

         $this->code = $_status;

         if ($this->lastcmd->ok == $_status)
         {
             $this->status = "OK";
             return;
         }
         else if (in_array($_status, $this->lastcmd->err))
         {

         }
         else
         {

         }
        
         $this->raw = $_value;
         
         $str = explode(" ", $_value);
         
         unset($str[0]);
         unset($str[1]);
         unset($str[2]);

         $this->status = implode(" ", $str);
         $this->status = substr($this->status, 1);
         
    }    
    
    public function to_json()
    {
         return json_encode($this);
    }    
}

