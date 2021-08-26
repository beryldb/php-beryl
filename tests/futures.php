<?php
/*
 * In this test:
 *
 * We basically add a hello future, check its expected execution and
 * force its execution.
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

echo $client->future(3600, "hello", "world") . "\n"; /* OK */
echo $client->tte("hello") 		     . "\n"; /* 3600 */
echo $client->exec("hello") 		     . "\n"; /* OK */
echo $client->get("hello") 		     . "\n"; /* world */
