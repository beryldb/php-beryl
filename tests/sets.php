<?php
/*
 * Defines 3 keys to map a, and another map a2.
 * This script later runs hsearch and hkeys to list keys
 * associated to a map.
 *
 * This script can be runned directly from the php-beryl directory:
 *
 * => php tests/sets.php
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

print_r($client->hset("a", "b", "c"));
print_r($client->hset("a", "b2", "c"));
print_r($client->hset("a2", "b3", "c"));
print_r($client->hget("a", "b"));

/* Find maps: offset 0, limit 3. */

print_r($client->hsearch("*", 0, 3));
print_r($client->hkeys("a", 0, 3));

?>