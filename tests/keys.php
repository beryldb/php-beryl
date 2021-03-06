<?php
/*
 * In this test:
 *
 * We define key set, check for its length and verify its type (KEY).
 * We also run a getdel, which basically retrieves the hello key and then removes it.
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


echo $client->flushall()                  .  "\n"; /* OK */

echo $client->set("hello", "world") 	  .  "\n";    /* OK */

/* Wildcard match */

echo $client->ismatch("hello", "wo*")     . "\n";  /* 1 */

echo $client->strlen("hello") 	          . "\n"; /* 5 */

/* Increment var by 1 */

echo $client->incr("var")               . "\n";

/* Increment var by 50 */

echo $client->incrby("var", "50")       . "\n";

/* Check if hello actually exists */

echo $client->exists("hello")       	  . "\n"; /* 1 */

echo $client->type("hello")               . "\n"; /* KEY */
echo $client->getdel("hello")             . "\n"; /* world */

echo $client->set("a", "b")               . "\n"; /* OK */
echo $client->set("c", "d")               . "\n"; /* OK */

/* Copy a to x */

echo $client->copy("a", "x")              .  "\n"; /* OK */

/* Redefine 'a's value as upper letters */

echo $client->toupper("a")                . "\n"; /* OK */

$results = $client->search("*");

if ($results)
{
     foreach ($results as $key => $value)
     {
           printf("%-20s | %-10s\n", $key, $value);
     }
}

/* Set key 'a' to be automatically deleted after 300 seconds. */

echo $client->expire("a", 300)       . "\n"; /* OK */
