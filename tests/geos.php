<?php
/*
 * In this test:
 *
 * We add two geo locations (Miami and Los_Angeles), with their respecting
 * latitudes and longitudes.
 * Finally, we calculate the distance between these two points.
 *
 * => php tests/geos.php
 */
 
require __DIR__.'/../vendor/autoload.php';

$client = new Beryl\Connection\Client([  
                    'host' => 'localhost', 
                    'port' => 6378, 
                    'login' => 'root', 
                    'password' => 'default'
                   ]);


echo $client->geoadd("Miami", 25.761681, -80.191788)        . "\n"; /* OK */
echo $client->geoadd("Los_Angeles", 34.052235, -118.243683) . "\n"; /* OK */
echo $client->geodist("Los_Angeles", "Miami")               . "\n"; /* 4222.46 */
