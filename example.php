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



echo $client->pwd() . "\n";

echo $client->time() . "\n";
echo $client->epoch() . "\n";

/* Flush database. */

//$client->flushdb();


echo $client->mset("a", "b", "d")->value . "\n";

foreach ($client->mget("a")->list as $key)
{
      echo $key . "\r\n";
}

return;

echo $client->hsetnx("a", "b", "d")->value . "\n";
echo $client->hget("a", "b")->value . "\n";


foreach ($client->hkeys("a")->list as $key)
{
      echo $key . "\r\n";
}

/*echo $client->expire("a", 200)->status .  "\n";
echo $client->ttl("a")->value .  "\n";
*/
/*echo $client->hset("hello2", "a", "world")->status . "\n";
echo $client->hdel("hello2", "a")->value . "\n";
echo $client->hget("hello2", "a")->value . "\n";
*/
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