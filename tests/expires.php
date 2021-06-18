<?php
/*
 * Sets a key, and expire and then looks up for its ttl. 
 * Finally, a setex on b2 is requested.
 *
 * This script can be runned directly from the php-beryl directory:
 *
 * => php tests/sets.php
 */
 
require __DIR__.'/../vendor/autoload.php';

$client = new Beryl\Connection\Client([  
                    'host' => 'localhost', 
                    'port' => 6378, 
                    'timeout' => 30, 
                    'login' => 'root', 
                    'password' => 'default'
                   ]);


/* Flush database. */

$client->flushdb();

/* Sets key a */

print_r($client->set("a", "b"));

/* Sets an expire on key 'a' */

print_r($client->expire("a", 30));

/* Obtain time to live for 'a' */

print_r($client->ttl("a"));

print_r($client->setex(100, "b2", "testing setex"));
print_r($client->ttl("b2"));


?>