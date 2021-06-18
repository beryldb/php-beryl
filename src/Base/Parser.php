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


class Parser
{
    
    public function __construct()
    {

    }
    
    public function format($str)
    {
                   unset($str[0]);
                   unset($str[1]);
                   unset($str[2]);
                   unset($str[3]);

                   $format = implode(" ", $str);
                   $format = substr($format, 1);
                   $format = substr($format, 1);
                   $format = substr($format, 0, -1);
                   return $format;

    }
    
    
}

