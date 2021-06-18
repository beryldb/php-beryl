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

final class HMove extends SimpleQuery
{
    public function __construct($client, $map, $key, $dest)
    {
        $this->parameters = $map . ' ' . $key . ' ' . $dest;
        $this->command = "HMOVE";
        
        parent::__construct($client, $this->command, $this->parameters);
    }
}


