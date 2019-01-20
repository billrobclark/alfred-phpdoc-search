<?php

namespace BillClark\PhpDocSearch;

use Alfred\Workflows\Workflow;
use AlgoliaSearch\Client as Algolia;

class Search
{
    /**
     * @var Workflow
     */
    private $workflow;

    /**
     * @var Algolia
     */
    private $algoliaClient;

    /**
     * Search constructor.
     * @throws \AlgoliaSearch\AlgoliaException
     */
    public function __construct()
    {
        $this->workflow = new Workflow();
        $this->algoliaClient = new Algolia('A6XQ78SBYL', '6b55caa922558f0094b3aba94b293d0c');
        $this->index = $this->algoliaClient->initIndex('php-docs');
    }

    /**
     * @param $query
     * @return string
     * @throws \AlgoliaSearch\AlgoliaException
     */
    public function search($query)
    {
        $search = $this->index->search($query);

        $results = $search['hits'];

        foreach ($results as $hit) {
            $title = strip_tags(html_entity_decode($hit['_highlightResult']['title']['value'], ENT_QUOTES, 'UTF-8'));

            $link = preg_replace('/en/', $_ENV['language'] ?? 'en', $hit['link']);

            $this->workflow->result()
                ->uid($hit['objectID'])
                ->title($title)
                ->autocomplete($title)
                ->subtitle($hit['subtext'])
                ->arg($link)
                ->quicklookurl($link)
                ->valid(true);
        }

        return $this->workflow->output();
    }

    /**
     * @param $data
     * @return mixed
     */
    public function getTitle($data)
    {
        $parsedData = json_decode($data);

        return $parsedData->items[0]->title;
    }
}