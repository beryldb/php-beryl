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

final class ILogin extends Command
{
      private $command;
      private $parameters;
    
      public function __construct($user, $pass)
      {
            $this->parameters  = "php1 " . $pass . " " . $user;
            $this->command     = "ILOGIN";
           
            parent::__construct($this->command, $this->parameters);
      }
}

?>