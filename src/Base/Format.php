<?php
/*
 * php-beryl - PHP Driver for BerylDB.
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

/* 
 * Formats a given string, based in provided parameters.
 * These formatters make it easier to send commands to the
 * remote server.
 */
 
class Format
{
         public function __construct()
         {
    
         }

        /* 
         * Creates a parameter that is used when setting or
         * to look for a given value.
         *
         * @parameters:
	 *
	 *         · string	: Key to use.
	 *         · string	: Value to look up.
	 * 
         * @return:
 	 *
         *         · string	: key "value"
         */          
    
         public static function Key($key, $value)
         {
               return $key . ' "' . $value . '"';
         }
      
        /* 
         * Formats a simple key value parameter.
         * 
	 * 
         * @return:
 	 *
         *         · string	:  key value
         */          
         
         public static function Basic($key, $value)
         {
               return $key . ' ' . $value;
         }
         
        /* 
         * Formats a parameter for a map-hash relationship.
         * 
         * @parameters:
	 *
	 *         · string	: Hashing key.
	 * 
         * @return:
 	 *
         *         · string	: key hash value
         */             
         
         public static function Limits($key, $hash, $value)
         {
              return $key . ' ' . $hash . ' ' . $value;
         }

        /* 
         * This function is a combination of Limits and Key.
         * 
         * @return:
 	 *
         *         · string	: key hash "value"
         */    
         
         public static function Hash($key, $hash, $value)
         {
             return $key . ' ' . $hash . ' "' . $value . '"';
         }
}

?>
