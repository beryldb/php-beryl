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

//echo $client->set("peo", "x"). "\r\n";
echo $client->get("a")->status . "\r\n";

//return;

//echo $client->whoami() . "\r\n";


//echo $client->copy("a", "x")->value . "\r\n";
//echo $client->get("x")->value .  "\n";
//echo $client->flushdb()->status . "\n";

//echo $client->type("a22")->value . "\r\n";

return;


echo $client->set("a2", "b")->value .  "\n";
echo $client->del("a2")->value .  "\n";

return;

?>