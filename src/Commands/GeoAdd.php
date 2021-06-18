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
use Beryl\Connection\CustomCommand;
use Beryl\Base\Protocols;

final class GeoAdd extends CustomCommand
{
    public $ok = BRLD_QUERY_OK;
    public $err = array(ERR_EXPIRE, ERR_QUERY);

    public function __construct($client, $name, $key, $value)
    {
        $this->parameters = $name . ' ' . $key . ' ' . $value;
        $this->command = "GEOADD";
        
        parent::__construct($this->ok, $this->err, $client, $this->command, $this->parameters);
    }
}

