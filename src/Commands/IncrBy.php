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

namespace Beryl\Commands;

use Beryl\Base\Response;
use Beryl\Connection\SimpleQuery;
use Beryl\Base\Protocols;

final class IncrBy extends SimpleQuery
{
    public function __construct($client, $key, $value)
    {
        $this->parameters = $key . ' ' . $value;
        $this->command = "INCRBY";
        
        parent::__construct($client, $this->command, $this->parameters);
    }
}

