<?php

require __DIR__ . '/vendor/autoload.php';

$query = $argv[1] ?? '';

$search = new \BillClark\PhpDocSearch\Search();

echo $search->search($query);
