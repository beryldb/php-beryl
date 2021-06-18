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

use Beryl\Connection\CustomListCommand;
use Beryl\Base\Protocols;

final class Modules extends CustomListCommand
{
    private $command;
    private $parameters;
    
    public $start = BRLD_BEGIN_OF_MODLIST;
    public $end = BRLD_END_OF_MODLIST;
    public $item = BRLD_MODLIST;
    
    public function __construct($client)
    {
        $this->parameters;
        $this->command = "MODULES";
        
        parent::__construct($this->start, $this->end, $this->item, $client, $this->command, $this->parameters);
    }
}


