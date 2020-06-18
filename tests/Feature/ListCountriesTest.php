<?php

namespace Tests\Feature;

use App\Country;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ListCountriesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function countries_are_ordered_by_name()
    {
        factory(Country::class)->create(['name' => 'Perú']);
        factory(Country::class)->create(['name' => 'Colombia']);
        factory(Country::class)->create(['name' => 'Ecuador']);
        factory(Country::class)->create(['name' => 'Bolivia']);

        $this->get('countries?sort=name')
            ->assertSeeInOrder([
                'Bolivia',
                'Colombia',
                'Ecuador',
                'Perú',
            ])
        ;

        $this->get('countries?sort=-name')
            ->assertSeeInOrder([
                'Perú',
                'Ecuador',
                'Colombia',
                'Bolivia',
            ])
        ;
    }

    /** @test */
    public function countries_are_ordered_by_id()
    {
        factory(Country::class)->create(['name' => 'Perú']);
        factory(Country::class)->create(['name' => 'Colombia']);
        factory(Country::class)->create(['name' => 'Ecuador']);
        factory(Country::class)->create(['name' => 'Bolivia']);

        $this->get('countries?sort=id')
            ->assertSeeInOrder([
                'Perú',
                'Colombia',
                'Ecuador',
                'Bolivia',
            ])
        ;

        $this->get('countries?sort=-id')
            ->assertSeeInOrder([
                'Bolivia',
                'Ecuador',
                'Colombia',
                'Perú',
            ])
        ;
    }

    /** @test */
    public function invalid_order_query_data_is_ignored_and_the_default_order_is_used_instead()
    {
        factory(Country::class)->create([
            'name' => 'Perú',
            'created_at' => now()->subDays(5)
        ]);

        factory(Country::class)->create([
            'name' => 'Colombia',
            'created_at' => now()->subDays(1)
        ]);

        factory(Country::class)->create([
            'name' => 'Ecuador',
            'created_at' => now()->subDays(2)
        ]);

        factory(Country::class)->create([
            'name' => 'Bolivia',
            'created_at' => now()->subDays(4)
        ]);

        $this->get('countries?sort=created_at')
            ->assertOk()
            ->assertSeeInOrder([
                'Perú',
                'Colombia',
                'Ecuador',
                'Bolivia',
            ])
        ;

        // $this->get('countries?sort=invalid')
        //     ->assertOk()
        //     ->assertSeeInOrder([
        //         'Perú',
        //         'Colombia',
        //         'Ecuador',
        //         'Bolivia',
        //     ])
        // ;
    }
}
