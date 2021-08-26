<?php
/*
 * In this test:
 *
 * We retrieve version, check for this current database's size and retrieve
 * server's time.
 *
 * We later perform other minor task, as asking for time as expressed in unix
 * timestamp and check for current select.
 *
 * => php tests/info.php
 */
 
require __DIR__.'/../vendor/autoload.php';

$client = new Beryl\Connection\Client([  
                    'host' => 'localhost', 
                    'port' => 6378, 
                    'login' => 'root', 
                    'password' => 'default'
                   ]);


echo $client->version()         . "\n"; /* BerylDB-0 BerylDB-0.8.3 */
echo $client->dbsize() 		. "\n"; /* 0.1 KB */
echo $client->time() 		. "\n"; /* Wed Aug 25 2021 18:11:09 */
echo $client->epoch() 		. "\n"; /* 1629929469 */
echo $client->current()         . "\n"; /* 1 */
echo $client->db()              . "\n"; /* default */

