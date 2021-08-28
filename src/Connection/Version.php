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

/* 
 * Returns current version. This class is used to keep track
 * of current version. It is also used when running workflows on GitHub.
 */
 
class Version
{
    public function __construct()
    {

    }

    public function Get()
    {
         return "0.1.0";
    }
}
