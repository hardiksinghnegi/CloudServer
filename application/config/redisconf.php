<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------
| REDIS/MODAL CONFIGURATION
| -------------------------------------------------------------------
| This file contains list of all the functions in redis_helper and their activation value in boolean.
| If the value is set to TRUE the Redis cache would be used if the information queried exists in the cache.
| If the value is set to FALSE for a particular function, the queried information will always be retrieved from the database.
*/

$config['getControlList'] = TRUE;

$config['getAssessment'] = TRUE;