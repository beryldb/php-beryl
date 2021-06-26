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
use Beryl\Connection\NonSimpleQuery;
use Beryl\Base\Protocols;

final class Type extends NonSimpleQuery
{
    public function __construct($client, $key)
    {
        $this->parameters = $key;
        $this->command = "TYPE";
        
        parent::__construct($client, $this->command, $this->parameters);
    }
}

