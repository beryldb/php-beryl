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

define("BRLD_SHUTTING_DOWN", 292);
define("BRLD_EXP_DELETED", 183);
define("BRLD_CURRENT_USE", 165);
define("BRLD_MONITOR", 245);
define("BRLD_NOTIFICATION", 277);
define("BRLD_FIRSTOF", 287);
define("ERR_NOT_FOUND", 576);
define("BRLD_COMMANDS_START", 162);
define("BRLD_COMMANDS_END", 163);
define("BRLD_COMMAND_ITEM", 290);
define("BRLD_LOCAL_EPOCH", 269);
define("BRLD_VERSION", 133);
define("BRLD_AGENT", 268);

define("BRLD_USING", 259);
define("BRLD_WHOAMI", 260);
define("BRLD_IDLE", 263);
define("ERR_NO_INSTANCE", 500);

define("BRLD_FINGER_BEGIN", 184);
define("BRLD_FINGER_LIST", 128);
define("BRLD_FINGER_END", 140);

define("BRLD_LOCAL_TIME", 106);
define("BRLD_RESTART_OK", 289);
define("BRLD_RESTART", 221);
define("ERR_USE", 548);
define("BRLD_NEW_USE", 161);
define("INTERNAL_OK", "OK");
define("INTERNAL_ERROR", "ERROR");

define("BRLD_MODLIST", 131);
define("BRLD_END_OF_MODLIST", 132);
define("BRLD_BEGIN_OF_MODLIST", 187);

define("ERR_MISS_PARAMS", 521);
define("BRLD_PERSIST", 172);
define("ERR_PERSIST", 545); 
define("BRLD_TTL", 171);
define("ERR_NOT_EXPIRE", 544); 
define("ERR_EXPIRE", 543);
define("BRLD_EXPIRE_ADD", 170); 
define("ERR_WRONG_PASS", 536);
define("ERR_UNABLE_FLUSH", 550);
define("BRLD_FLUSHED", 288);
define("ERR_NO_FLAGS", 539);
define("BRLD_ITEM", 196);
define("BRLD_CURRENT_DIR", 201);
define("ERR_QUERY", 538); 
define("BRLD_PING", 110); 
define("BRLD_QUERY_OK", 164);
define("BRLD_ERROR", 142);
define("BRLD_CONNECTED", 108);
define("BRLD_YOUR_FLAGS", 186);
define("BRLD_START_LIST", 282);
define("BRLD_END_LIST", 283);
define("BRLD_START_UNQ_LIST", 284);
define("BRLD_END_UNQ_LIST", 285);
define("BRLD_FIND_ITEM", 196);
?>