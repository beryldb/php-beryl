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

$client = new Beryl\Connection\Client([  
                    'host' => 'localhost', 
                    'port' => 6378, 
                    'login' => 'root', 
                    'password' => 'default'
                   ]);


/* Let's set key test and then remove it after a get request. */

echo $client->set("test", "world")->value . "\n";
echo $client->getdel("test")->value . "\r\n";

/* Flush database (remove current database's content). */

$client->flushdb();

echo $client->set("hello", "world")->value . "\n";
echo $client->get("hello")->value . "\n";
echo $client->del("hello")->value .  "\n";

/* Find keys: offset 0, limit 3. */

foreach ($client->find("*")->items as $key => $value)
{
      echo $key . " => " . $value . "\r\n";
}

/* Searches values: offset 0, limit 3. */

foreach ($client->search("*")->list as $key)
{
      echo $key . "\r\n";
}

/* You may also check what kind of data is a given key: */

echo $client->type("hello")->value. "\r\n";

?>