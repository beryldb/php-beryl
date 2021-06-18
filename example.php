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

$client->flushdb();

//echo $client->set("a", "b");
echo $client->set("a2", "b2")->to_json() . "\n";
echo $client->get("a")->to_json() . "\n";

return;

//print_r($client->get("a", "b"));

/* Find keys: offset 0, limit 3. */

print_r($client->find("*", 0, 3));

/* Find values: offset 0, limit 3. */

print_r($client->search("*", 0, 3));

?>