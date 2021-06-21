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

//echo $client->flushdb()->status . "\n";

echo $client->hset("a22", "b", "pico")->value. "\n";

echo $client->hget("a22", "b")->value .  "\n";

//echo $client->set("a2", "b")->value .  "\n";
//echo $client->set("a23", "b")->value .  "\n";

return;




return;

//print_r($client->get("a", "b"));

/* Find keys: offset 0, limit 3. */

print_r($client->find("*", 0, 3));

/* Find values: offset 0, limit 3. */

print_r($client->search("*", 0, 3));

?>