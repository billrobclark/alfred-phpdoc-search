<?php

use Alfred\Workflows\Workflow;
use AlgoliaSearch\Client as Algolia;

require __DIR__ . '/vendor/autoload.php';

$query = $argv[1];

$workflow = new Workflow;
$algoliaClient = new Algolia('A6XQ78SBYL', '6b55caa922558f0094b3aba94b293d0c');

$index = $algoliaClient->initIndex('php-docs');