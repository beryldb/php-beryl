<?php
/*
 * Pushes two elements 'b' to list 'a', and then
 * looks for all items with limit 3.
 *
 * This script can be runned directly from the php-beryl directory:
 *
 * => php tests/lists.php
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

print_r($client->lpush("a", "b"));
print_r($client->lpush("a", "b"));

/* offset 0, limit 3 */

print_r($client->lfind("a", "b*", 0, 3));

?>