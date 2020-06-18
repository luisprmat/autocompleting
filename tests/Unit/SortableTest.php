<?php

namespace Tests\Unit;

use App\Sortable;
use PHPUnit\Framework\TestCase;

class SortableTest extends TestCase
{
    protected $sortable;

    protected function setUp(): void
    {
        parent::setUp();

        $this->sortable = new Sortable('http://localhost/demo');
    }

    /** @test */
    public function builds_a_url_with_sortable_data()
    {
        $this->assertSame(
            'http://localhost/demo?sort=name',
            $this->sortable->url('name')
        );
    }

    /** @test */
    public function appends_query_data_to_the_url()
    {
        $this->sortable->appends(['a' => 'parameter', 'and' => 'another-parameter']);

        $this->assertSame(
            'http://localhost/demo?a=parameter&and=another-parameter&sort=name',
            $this->sortable->url('name')
        );
    }

    /** @test */
    public function builds_a_url_with_desc_order_if_the_current_column_matches_the_given_one_and_the_current_direction_is_asc()
    {
        $this->sortable->setCurrentOrder('name');

        $this->assertSame(
            'http://localhost/demo?sort=-name',
            $this->sortable->url('name')
        );
    }

    /** @test */
    public function returns_a_css_class_to_indicate_that_the_column_is_sortable()
    {
        $this->assertSame(
            'fas fa-sort text-black-50 fa-fw',
            $this->sortable->classes('name')
        );
    }

    /** @test */
    public function returns_css_classes_to_indicate_that_the_column_is_sorted_in_asc_order()
    {
        $this->sortable->setCurrentOrder('name');

        $this->assertSame(
            'fas fa-sort-up fa-fw',
            $this->sortable->classes('name')
        );
    }

    /** @test */
    public function returns_css_classes_to_indicate_that_the_column_is_sorted_in_desc_order()
    {
        $this->sortable->setCurrentOrder('-name');

        $this->assertSame(
            'fas fa-sort-down fa-fw',
            $this->sortable->classes('name')
        );
    }
}
