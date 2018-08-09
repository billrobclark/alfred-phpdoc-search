<?php

use Alfred\Workflows\Workflow;
use AlgoliaSearch\Client as Algolia;

require __DIR__ . '/vendor/autoload.php';

$query = $argv[1];

$workflow = new Workflow;
$algoliaClient = new Algolia('A6XQ78SBYL', '6b55caa922558f0094b3aba94b293d0c');

$index = $algoliaClient->initIndex('php-docs');

$search = $index->search($query);
$results = $search['hits'];

foreach ($results as $hit) {
    $title = strip_tags(html_entity_decode($hit['_highlightResult']['title']['value'], ENT_QUOTES, 'UTF-8'));

    $workflow->result()
        ->uid($hit['objectID'])
        ->title($title)
        ->autocomplete($title)
        ->subtitle($hit['subtext'])
        ->arg($hit['link'])
        ->quicklookurl($hit['link'])
        ->valid(true);
}

echo $workflow->output();