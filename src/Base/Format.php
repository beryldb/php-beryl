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

class Format
{
      public function __construct()
      {
    
      }

      public static function Limits($key, $hash, $value)
      {
           return $key . ' ' . $hash . ' ' . $value;
      }

      public static function Hash($key, $hash, $value)
      {
           return $key . ' ' . $hash . ' "' . $value . '"';
      }
    
      public static function Key($key, $value)
      {
           return $key . ' "' . $value . '"';
      }
      
      public static function Basic($key, $value)
      {
           return $key . ' ' . $value;
      }
      
}

?>
