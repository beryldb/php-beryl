<?php
/*
 * Sets two keys (a, and a2) and then runs a get and a copy. Also,
 * this script runs both find and search.
 *
 * This script can be runned directly from the php-beryl directory:
 *
 * => php tests/keys.php
 */
 
require __DIR__.'/../vendor/autoload.php';

use Beryl\Connection;

$client = new Connection\Server([  
                    'host' => 'localhost', 
                    'port' => 6378, 
                    'login' => 'root', 
                    'password' => 'default'
                   ]);


/* Flush database. */

$client->flushdb();

print_r($client->set("a", "b"));
print_r($client->set("a2", "b2"));
print_r($client->get("a", "b"));
print_r($client->copy("a", "c"));
print_r($client->exists("b"));

/* Find keys: offset 0, limit 3. */

print_r($client->find("*", 0, 3));

/* Find values: offset 0, limit 3. */

print_r($client->search("*", 0, 3));

?>