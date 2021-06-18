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

class QueryResult
{
    public $status;
    public $value;
    
    public function __construct($_status, $_value)
    {
         $this->status = $_status;
         $this->value = $_value;
    }    
    
    public function to_json()
    {
         return json_encode($this);
    }    
}

