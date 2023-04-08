<?php

namespace BillClark\PhpDocSearch;

use Alfred\Workflows\Workflow;
use Algolia\AlgoliaSearch\SearchClient;
use Algolia\AlgoliaSearch\SearchIndex;

class Search
{
    /**
     * The Alfred PHP Workflow instance.
     */
    private Workflow $workflow;

    /**
     * The Algolia search client.
     */
    private SearchClient $algoliaClient;

    /**
     * The Algolia search index.
     */
    private SearchIndex $index;

    /**
     * Search constructor.
     */
    public function __construct()
    {
        $this->workflow = new Workflow();
        $this->algoliaClient = SearchClient::create('A6XQ78SBYL', '6b55caa922558f0094b3aba94b293d0c');
        $this->index = $this->algoliaClient->initIndex('php-docs');
    }

    /**
     * Execute a search against the Algolia index.
     *
     * @param string $query The search query.
     *
     * @return string A JSON-encoded set of results.
     *
     * @throws \Algolia\AlgoliaSearch\Exceptions\AlgoliaException
     */
    public function search(string $query): string
    {
        $search = $this->index->search($query);

        $results = $search['hits'] ?? [];

        foreach ($results as $hit) {
            $title = strip_tags(html_entity_decode($hit['_highlightResult']['title']['value'], ENT_QUOTES, 'UTF-8'));

            $link = preg_replace('/en/', $_ENV['language'] ?? 'en', $hit['link']);

            $this->workflow->item()
                ->uid($hit['objectID'])
                ->title($title)
                ->autocomplete($title)
                ->subtitle($hit['subtext'])
                ->arg($link)
                ->quickLookUrl($link)
                ->valid(true);
        }

        return $this->workflow->output(false);
    }
}
