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
    public $value;
    public $code;
    
    private $raw;
    private $lastcmd;
    
    public function __construct($_lastcmd, $_status, $_value)
    {
         $this->lastcmd = $_lastcmd;

         $this->code = $_status;

         if ($this->lastcmd->ok == $_status && $_status == BRLD_QUERY_OK)
         {
             $this->status = "OK";
             return;
         }
         
         switch ($this->lastcmd->ok)
         {
              case BRLD_TTL:

                     $this->status = "EXPIRE";
                     $this->raw = $_value;
                     $str = explode(" ", $_value);

                     unset($str[0]);
                     unset($str[1]);
                     unset($str[2]);

                     $this->value = implode(" ", $str);
                     $this->value = substr($this->value, 1);
                   
              break;

              case BRLD_WHOAMI:
              {
                     $str = explode(" ", $_value);
                     $this->status = $str[3];
                     return;
              }
              
              case BRLD_CURRENT_DIR:
              {
                     $str = explode(" ", $_value);
                     $this->status = $str[3];
                     return;
              }
              
              case BRLD_LOCAL_TIME:
              case BRLD_LOCAL_EPOCH:
              {
                     $str = explode(" ", $_value);
                     unset($str[0]);
                     unset($str[1]);
                     unset($str[2]);
                     unset($str[3]);
         
                     $this->status = implode(" ", $str);
                     $this->status = substr($this->status, 1);
                     return;
              }
              
              default:
              {
                     $this->raw = $_value;
                     $str = explode(" ", $_value);
                     
                     unset($str[0]);
                     unset($str[1]);
                     unset($str[2]);

                     $this->status = implode(" ", $str);
                     $this->status = substr($this->status, 1);
              }
         }
         
    }    
    
    public function to_json()
    {
         return json_encode($this);
    }    
}

