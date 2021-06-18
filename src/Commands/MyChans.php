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

use Beryl\Channel\CustomCommand;
use Beryl\Base\Protocols;

final class MyChans extends CustomCommand
{
    public $ok = BRLD_MY_CHANS;
    public $err = array(ERR_NO_CHANS);
      
    public function __construct($client)
    {
        $this->parameters = "";
        $this->command = "MYCHANS";
        
        parent::__construct($this->ok, $this->err, $client, $this->command, $this->parameters);
    }
}


