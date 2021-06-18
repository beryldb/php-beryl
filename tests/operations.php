<?php
/*
 *
 * This script can be runned directly from the php-beryl directory:
 *
 * => php tests/keys.php
 */
 
require __DIR__.'/../vendor/autoload.php';

use Beryl\Connection;

$client = new Beryl\Connection\Client([  
                    'host' => 'localhost', 
                    'port' => 6378, 
                    'login' => 'root', 
                    'password' => 'default'
                   ]);


/* Flush database. */

$client->flushdb();

/* Increment a by 1 */

print_r($client->incr("a"));

/* Increment a by 20 */

print_r($client->incrby("a", 20));

/* Gets a */

print_r($client->get("a"));


?>