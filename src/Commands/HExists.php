<?php
/*
 * php-beryl - PHP Driver for BerylDB.
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
use Beryl\Connection\BrldCommand;
use Beryl\Base\Format;

final class HExists extends BrldCommand
{
    public function __construct($client, $key, $hash)
    {
         $this->parameters = Format::Basic($key, $hash);
         $this->command    = "HEXISTS";
        
         parent::__construct($client, $this->command, $this->parameters);
    }
}

?>
