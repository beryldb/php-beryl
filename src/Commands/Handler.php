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

use Beryl\Connection\Command;

final class Handler extends Command
{
    private $command;
    private $parameters;
    
    public $err = array();

    public function __construct($command, $param)
    {
        $this->parameters = $param;
        $this->command = $command;
        parent::__construct($this->command, $this->parameters);
    }
}

