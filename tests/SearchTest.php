<?php

use PHPUnit\Framework\TestCase;

use BillClark\PhpDocSearch\Search;

class SearchTest extends TestCase
{
    /** @test */
    public function a_query_returns_correct_result()
    {
        $phpDocSearch = new Search();

        $algoliaData = $phpDocSearch->search('parsekit_compile_string');

        $this->assertEquals($phpDocSearch->getTitle($algoliaData), 'parsekit_compile_string');
    }
}