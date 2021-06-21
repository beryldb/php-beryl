<?php

require __DIR__.'/vendor/autoload.php';

$client = new Beryl\Connection\Client([  
                    'host' => 'localhost', 
                    'port' => 6378, 
                    'timeout' => 30, 
                    'login' => 'root', 
                    'password' => 'default',
                    'debug' => false
                   ]);


/* Flush database. */

//print_r($client->flushdb());

echo $client->flushdb()->value . "\n";

echo $client->set("a2", "b2")->status. "\n";
echo $client->get("a2")->value . "\n";

echo $client->hset("a3", "b2", "lala")->status. "\n";
echo $client->hget("a3", "b2")->value. "\n";



return;

//print_r($client->get("a", "b"));

/* Find keys: offset 0, limit 3. */

print_r($client->find("*", 0, 3));

/* Find values: offset 0, limit 3. */

print_r($client->search("*", 0, 3));

?>