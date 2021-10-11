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

/* 
 * This class define basic protocols that match the ones
 * defined in the BerylDB protocol. 
 */
 
class Protocol
{
    const  BRLD_CONNECTED	=	108;
    const  BRLD_OK	        =       164;
    const  BRLD_RUN             =       165;
    const  ERR_INPUT            =       586;
    const  ERR_INPUT2           =       587;
    const  ERR_INPUT3           =       588;
    const  BRLD_START_LIST      =       282;
    const  BRLD_END_LIST        =       283;
    const  BRLD_ITEM_LIST       =       215;
    const  BRLD_NEW_USE         =	161;
    const  ERR_MISS_PARAMS      = 	521;
    const  ERR_WRONG_PASS	=	536;
    const  BRLD_PING		=	110;
    const  BRLD_RESTART		=	289;
    const  BRLD_NOTIFICATION	= 	277;
    const  BRLD_MONITOR		=	245;
    const  BRLD_JOIN            =       145;
    const  BRLD_QUEUED          =       162;
    const  BRLD_MULTI_START     =       165;
    const  BRLD_MULTI_STOP      =       169;
}

?>