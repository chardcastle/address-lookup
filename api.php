#!/usr/bin/php
<?php

/**
 * Error reporting
 */
ini_set('display_errors', 'on');
error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);

/**
 * Class bootstraping
 */

require_once __DIR__ . '/vendor/autoload.php';
// require_once __DIR__ . '/lib/DataSource.php';
// require_once __DIR__ . '/lib/Result.php';

use Hardcastle\Map\DataSource;

if ($argc != 2 || in_array($argv[1], array('--help', '-help', '-h', '-?'))):


echo <<<OUTPUT

  Address look up

  Usage:
  \$php $argv[0] <address>

  Where <address> is a single line of address.

  With the --help, -help, -h,
  or -? options, you can get this help.

OUTPUT;

else:
	$map = new DataSource;
	$map->search(urlencode($argv[1]));

  if ($map->hasResult())
  {
    
    $result = $map->getResult();
    $result->save();
    echo "Search results for: '$argv[1]'\n";  
    echo "An address with the postcode of '{$result->getPostCode()}' was found and saved to the CSV file\n";
  } else {
    echo "No results were returned for your search term: $argv[1] \n";  
  }

endif;

exit;
