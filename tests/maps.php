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

$client = new Beryl\Connection\Client([  
                    'host' => 'localhost', 
                    'port' => 6378, 
                    'login' => 'root', 
                    'password' => 'default'
                   ]);


/* Flush database. */

$client->flushdb();

echo $client->hset("a", "b2", "c")->value . "\n";
echo $client->hset("a", "b3", "c")->value . "\n";
echo $client->hget("a", "b")->value . "\n";

/* Find maps: offset 0, limit 3. */

foreach ($client->hkeys("a")->list as $key)
{
      echo $key . "\r\n";
}

?>