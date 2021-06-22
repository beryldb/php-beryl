<?php
/*
 * php-beryl - PHP Client for BerylDB.
 * http://www.beryldb.com
 *
 * Copyright (C) 2021 - Carlos F. Ferry <cferry@beryldb.com>
 * 
 * This file is part of BerylDB. BerylDB is free software: you can
 * redistribute it and/or modify it under the terms of the BSD License
 * version 3.
 *
 * More information about our licensing can be found at https://docs.beryl.dev
 */

namespace Beryl\Connection;

use Beryl\Base\Command;
use Beryl\Base\Response;
use Beryl\Connection\Protocols;
use Beryl\Connection\Server;

use Beryl\Base\Parser;
use Beryl\Commands;
use Beryl\Exceptions\ConnectionException;

class Client
{
      public $client;
      public $parser;

      private function check_args($args)
      {
           if (empty($args['host']))
           {
                $args['host'] = 'localhost';
           }
           
           if (empty($args['port']))
           {
                $args['port'] = 6378;
           }
           
           if (empty($args['timeout']))
           {
                $args['timeout'] = 30;
           }
           
           if (empty($args['login']))
           {
                $args['login'] = 'root';
           }
           
           if (empty($args['password']))
           {
                $args['password'] = 'default';
           }
        
           if (empty($args['debug']))
           {
                $args['debug'] = false;
           }
                
           return $args;
      }
      
      public function __construct($args)
      {
            $args = $this->check_args($args);       
            $this->client = new Server($args);
      }


      public function disconnect()
      {
           $this->client->disconnect();
           return "OK";
      }

      public function connect()
      {
            parent::connect();
      }	
      

      /* Server functionalities. */
      
      public function flushdb()
      {
             $cmd = new Commands\Flushdb($this->client);
             return $cmd->Run();
      }

      public function current()
      {
             $cmd = new Commands\Current($this->client);
             return $cmd->Run();
      }

      public function dbsize()
      {
             $cmd = new Commands\DBSize($this->client);
             return $cmd->Run()->value;
      }

      public function use($id)
      {
             $cmd = new Commands\UseCommand($this->client, $id);
             return $cmd->Run();
      }
      
      public function using($instance)
      {
             $cmd = new Commands\UsingCommand($this->client, $instance);
             return $cmd->Run();
      }
      
      /* 
       * Keys manipulators.
       * These are functions that bypass core_keys from
       * BerylDB.
       */    

      public function exists($key)
      {
             $cmd = new Commands\Exists($this->client, $key);
             return $cmd->Run();
      }

      public function rkey()
      {
             $cmd = new Commands\RKey($this->client);
             return $cmd->Run();
      }

      public function del($key)
      {
             $cmd = new Commands\Del($this->client, $key);
             return $cmd->Run();
      }
       
      public function getset($key, $value)
      {
             $cmd = new Commands\GetSet($this->client, $key, $value);
             return $cmd->Run();
      }

      public function getdel($key)
      {
             $cmd = new Commands\GetDel($this->client, $key);
             return $cmd->Run();
      }

      public function touch($key)
      {
             $cmd = new Commands\Touch($this->client, $key);
             return $cmd->Run();
      }


      public function ntouch($key)
      {
             $cmd = new Commands\NTouch($this->client, $key);
             return $cmd->Run();
      }

      public function strlen($key)
      {
             $cmd = new Commands\Strlen($this->client, $key);
             return $cmd->Run();
      }

      public function move($key, $dest)
      {
             $cmd = new Commands\Move($this->client, $key, $dest);
             return $cmd->Run();
      }
      
      public function rename($key, $dest)
      {
             $cmd = new Commands\Rename($this->client, $key, $dest);
             return $cmd->Run();
      }
      
      public function renamenx($key, $dest)
      {
             $cmd = new Commands\RenameNX($this->client, $key, $dest);
             return $cmd->Run();
      }

      public function concat($key, $dest)
      {
             $cmd = new Commands\Concat($this->client, $key, $dest);
             return $cmd->Run();
      }

      public function append($key, $dest)
      {
             $cmd = new Commands\Append($this->client, $key, $dest);
             return $cmd->Run();
      }
      
      public function copy($key, $dest)
      {
             $cmd = new Commands\Copy($this->client, $key, $dest);
             return $cmd->Run();
      }
      
      public function set($key, $value)
      {
             $cmd = new Commands\Set($this->client, $key, $value);
             return $cmd->Run();
      }

      public function get($key)
      {
             $cmd = new Commands\Get($this->client, $key);
             return $cmd->Run();
      }

      public function setnx($key, $value)
      {
             $cmd = new Commands\SetNX($this->client, $key, $value);
             return $cmd->Run();
      }
      
      public function settx($key, $value)
      {
             $cmd = new Commands\SetTX($this->client, $key, $value);
             return $cmd->Run();
      }

      public function count($key)
      {
             $cmd = new Commands\Count($this->client, $key);
             return $cmd->Run();
      }

      public function find($key, $offset = 0, $limit = -1)
      {
             $cmd = new Commands\Find($this->client, $key, $offset, $limit);
             return $cmd->Run();
      }

      public function search($key, $offset = 0, $limit = -1)
      {
             $cmd = new Commands\Search($this->client, $key, $offset, $limit);
             return $cmd->Run();
      }


      /* Expires */
      
      public function ttl($key)
      {
             $cmd = new Commands\TTL($this->client, $key);
             return $cmd->Run();
      }
      
      public function expire($key, $seconds)
      {
             $cmd = new Commands\Expire($this->client, $key, $seconds);
             return $cmd->Run();
      }
      
      public function setex($seconds, $key, $value)
      {
             $cmd = new Commands\Setex($this->client, $seconds, $key, $value);
             return $cmd->Run();
      }


      public function reset()
      {
             $cmd = new Commands\Reset($this->client);
             return $cmd->Run();
      }
      

      /* 
       * Alternatives
       */
       
       public function sendcmd($cmd, $args)
       {
             $cmd = new Commands\RawCommand($this->client, $cmd, $args);
             return $cmd->Run();
       }
       
      public function firstof($login)
      {
             $cmd = new Commands\FirstOf($this->client, $login);
             return $cmd->Run();
      }

      public function logout($instance, $reason)
      {
             $cmd = new Commands\Logout($this->client, $instance, $reason);
             return $cmd->Run();
      }
       
      /*
       * Informational interface. 
       */

      public function type($key)
      {
             $cmd = new Commands\Type($this->client, $key);
             return $cmd->Run();
      }
       
      public function commands()
      {
             $cmd = new Commands\Commands($this->client);
             return $cmd->Run();
      }

      public function version()
      {
             $cmd = new Commands\Version($this->client);
             return $cmd->Run();
      }

      public function me()
      {
            return $this->client->me;
      }

      public function whoami()
      {
             $cmd = new Commands\Whoami($this->client);
             return $cmd->Run()->status;
      }
       
      public function pwd()
      {
             $cmd = new Commands\Pwd($this->client);
             return $cmd->Run()->status;
      }
      
      public function modules()
      {
             $cmd = new Commands\Modules($this->client);
             return $cmd->Run();
      }
      
      public function coremodules()
      {
             $cmd = new Commands\Coremodules($this->client);
             return $cmd->Run();
      }
      
      public function time()
      {
             $cmd = new Commands\Time($this->client);
             return $cmd->Run()->status;
      }
      
      public function epoch()
      {
             $cmd = new Commands\Epoch($this->client);
             return $cmd->Run()->status;
      }

      public function myagent()
      {
             $cmd = new Commands\MyAgent($this->client);
             return $cmd->Run();
      }


      /* Admin */
      
      public function restart()
      {
             $cmd = new Commands\Restart($this->client);
             return $cmd->Run();
      }

      public function shutdown()
      {
             $cmd = new Commands\Shutdown($this->client);
             return $cmd->Run();
      }

      public function finger()
      {
             $cmd = new Commands\Finger($this->client);
             return $cmd->Run();
      }

      public function idle($instance)
      {
             $cmd = new Commands\Idle($this->client, $instance);
             return $cmd->Run();
      }
      
      /* Operation functions. */
      
      public function incr($var)
      {
             $cmd = new Commands\Incr($this->client, $var);
             return $cmd->Run();
      }

      public function decr($var)
      {
             $cmd = new Commands\Decr($this->client, $var);
             return $cmd->Run();
      }

      public function decrby($var, $value)
      {
             $cmd = new Commands\IncrBy($this->client, $var, $value);
             return $cmd->Run();
      }
      
      public function incrby($var, $value)
      {
             $cmd = new Commands\IncrBy($this->client, $var, $value);
             return $cmd->Run();
      }

      public function div($var, $value)
      {
             $cmd = new Commands\Div($this->client, $var, $value);
             return $cmd->Run();
      }

      public function mult($var, $value)
      {
             $cmd = new Commands\Mult($this->client, $var, $value);
             return $cmd->Run();
      }
      
      /* Geo functions */
      
      public function geoadd($name, $lat, $long)
      {
             $cmd = new Commands\GeoAdd($this->client, $name, $lat, $long);
             return $cmd->Run();
      }

      public function geodel($name)
      {
             $cmd = new Commands\GeoDel($this->client, $name);
             return $cmd->Run();
      }
      
      public function geoget($name)
      {
             $cmd = new Commands\GeoGet($this->client, $name);
             return $cmd->Run();
      }

      /* Maps */
      
      public function hset($key, $hash, $value)
      {
             $cmd = new Commands\HSet($this->client, $key, $hash, $value);
             return $cmd->Run();
      }
      
      public function hget($key, $hash)
      {
             $cmd = new Commands\HGet($this->client, $key, $hash);
             return $cmd->Run();
      }

      public function hcount($key)
      {
             $cmd = new Commands\HCount($this->client, $key);
             return $cmd->Run();
      }

      public function hkeys($key, $offset = 0, $limit = -1)
      {
             $cmd = new Commands\HKeys($this->client, $key, $offset, $limit);
             return $cmd->Run();
      }

      public function hmove($map, $hash, $dest)
      {
             $cmd = new Commands\HMove($this->client, $map, $hash, $dest);
             return $cmd->Run();
      }

      public function hdelall($key)
      {
             $cmd = new Commands\HDelAll($this->client, $key);
             return $cmd->Run();
      }
      
      public function hsearch($map, $offset = 0, $limit = -1)
      {
             $cmd = new Commands\HSearch($this->client, $map, $offset, $limit);
             return $cmd->Run();
      }

      public function hdel($key, $hesh)
      {
             $cmd = new Commands\HDel($this->client, $key, $hesh);
             return $cmd->Run();
      }

      public function hseek($key, $offset = 0, $limit = -1)
      {
             $cmd = new Commands\HSeek($this->client, $key, $offset, $limit);
             return $cmd->Run();
      }
      
      /* Lists */
      
      public function lpush($key, $hesh)
      {
             $cmd = new Commands\LPush($this->client, $key, $hesh);
             return $cmd->Run();
      }

      public function lremove($key)
      {
             $cmd = new Commands\LRemove($this->client, $key);
             return $cmd->Run();
      }

      public function lpop($key, $value)
      {
             $cmd = new Commands\LPop($this->client, $key, $value);
             return $cmd->Run();
      }

      public function lpopall($key, $value)
      {
             $cmd = new Commands\LPopAll($this->client, $key, $value);
             return $cmd->Run();
      }
      
      public function lcount($key)
      {
             $cmd = new Commands\LCount($this->client, $key);
             return $cmd->Run();
      }

      public function lsearch($key, $offset = 0, $limit = -1)
      {
             $cmd = new Commands\LSearch($this->client, $key, $offset, $limit);
             return $cmd->Run();
      }

      public function lfind($map, $key, $offset = 0, $limit = -1)
      {
             $cmd = new Commands\LFind($this->client, $map, $key, $offset, $limit);
             return $cmd->Run();
      }

      public function lget($key, $offset = 0, $limit = -1)
      {
             $cmd = new Commands\LGet($this->client, $key, $offset, $limit);
             return $cmd->Run();
      }
      
      public function lexist($key, $value)
      {
             $cmd = new Commands\LExist($this->client, $key, $value);
             return $cmd->Run();
      }
      
      /* Database management */
      
      public function db($key, $value)
      {
             $cmd = new Commands\DB($this->client, $key, $value);
             return $cmd->Run();
      }
      
      public function change($key, $value)
      {
             $cmd = new Commands\Change($this->client, $key, $value);
             return $cmd->Run();
      }
      
      
      

}