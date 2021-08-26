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

class Response
{
    public $message = [];
    public $stack   = [];

    public $status;
    public $simple;

    public function __construct($_status, $_message)
    {
        $this->status = $_status;
        $this->message = $_message;
    }
}

?>