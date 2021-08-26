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

namespace Beryl\Connection;

use Beryl\Base\Command as CommandInterface;

abstract class BasicQuery implements CommandInterface
{
    private $command;
    private $parameters;
    private $client;

    
    public function __construct($client, $command, $parameters)
    {
    
    }
    
    public function Run()
    {
    
    }
}

?>