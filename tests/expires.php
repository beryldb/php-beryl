<?php
/*
 * In this test:
 *
 * We basically set 'hello' key, and later define and expire
 * to be executed after 1 hour.
 *
 * 
 * We later verify whether it was executed or not. 
 * => php tests/futures.php
 */
 
require __DIR__.'/../vendor/autoload.php';

$client = new Beryl\Connection\Client([  
                    'host' => 'localhost', 
                    'port' => 6378, 
                    'login' => 'root', 
                    'password' => 'default'
                   ]);

echo $client->set("hello", "world")        . "\n"; /* OK */
echo $client->expire("hello", 3600) 	   . "\n"; /* 3600 */

/* Time to live check */

echo $client->ttl("hello") 		   . "\n"; /* 3600 */

/* Prevent this key from expiring. */

echo $client->persist("hello") 		   . "\n"; /* OK */
