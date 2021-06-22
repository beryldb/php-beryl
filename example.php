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

/*
echo $client->pwd() . "\n";

echo $client->time() . "\n";
echo $client->epoch() . "\n";


return;
*/

echo $client->get("hello")->code . "\n";
echo $client->get("hello")->status . "\n";
echo $client->get("hello")->value ."\n";

return;


/* Flush database (remove current database's content). */

echo $client->flushdb()->status . "\r\n";

return;

echo $client->set("hello", "world")->value . "\n";
echo $client->get("hello")->value . "\n";
echo $client->del("hello")->value .  "\n";

echo $client->get("test")->value . "\n";

//echo $client->getdel("test")->value . "\r\n";

return;
/* Flush database (remove current database's content). */

$client->flushdb();

echo $client->set("hello", "world")->value . "\n";
echo $client->get("hello")->value . "\n";
echo $client->del("hello")->value .  "\n";


return;

//return;

echo $client->me() . "\n";
echo $client->whoami() . "\n";


//echo $client->copy("a", "x")->value . "\r\n";
//echo $client->get("x")->value .  "\n";
//echo $client->flushdb()->status . "\n";

//echo $client->type("a22")->value . "\r\n";

return;


echo $client->set("a2", "b")->value .  "\n";
echo $client->del("a2")->value .  "\n";

return;

?>