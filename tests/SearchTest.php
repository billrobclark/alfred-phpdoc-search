<?php

use BillClark\PhpDocSearch\Search;
use PHPUnit\Framework\TestCase;

/**
 * Please be aware that these tests hit the Algolia service directly, so internet connectivity
 * is required!
 */
class SearchTest extends TestCase
{
    /**
     * @test
     */
    public function a_query_returns_correct_result(): void
    {
        $search = new Search();
        $results = $search->search('parsekit_compile_string');
        $titles = $this->extractTitles($results);

        $this->assertCount(1, $titles, 'Expected to only find one match.');
        $this->assertSame('parsekit_compile_string', current($titles));
    }

    /**
     * @test
     */
    public function a_query_can_return_multiple_matches(): void
    {
        $search = new Search();
        $results = $search->search('date');
        $titles = $this->extractTitles($results);

        $this->assertGreaterThan(1, $titles, 'Expected to find multiple matches.');
        $this->assertContains('date', $titles, 'The exact match should be present.');

        // Verify that every result includes "date".
        array_walk($titles, fn ($title) => $this->assertStringContainsString('date', $title));
    }

    /**
     * Extract an array of search result titles.
     *
     * @param string $results The JSON-encoded results.
     *
     * @return array<string> An array consisting of only the results' titles.
     */
    private function extractTitles(string $results): array
    {
        $data = json_decode($results);

        if (! isset($data->items)) {
            throw new \RuntimeException('Unable to parse JSON structure.');
        }

        return array_reduce($data->items, function ($titles, $result) {
            $titles[] = $result->title;

            return $titles;
        }, []);
    }
}
