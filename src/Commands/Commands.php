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

final class Commands extends CustomListCommand
{
    private $command;
    private $parameters;
    
    public $start = BRLD_COMMANDS_START;
    public $end = BRLD_COMMANDS_END;
    public $item = BRLD_COMMAND_ITEM;
    
    public function __construct($client)
    {
        $this->parameters;
        $this->command = "COMMANDS";
        
        parent::__construct($this->start, $this->end, $this->item, $client, $this->command, $this->parameters);
    }
}


