<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;

use Firebase\JWT\JWT;
use Tests\TestCase;

class MoviesListTest extends TestCase
{
    /**
     * @dataProvider moviesListDataProvider
     *
     * @return void
     */
    public function test_the_titles_returns_the_correct_response($expectedResult, $input): void
    {
        $response = $this->get('/api/titles', $input);

        $response->assertStatus(200);
        $response->assertJson($expectedResult);
    }


    function moviesListDataProvider(): array
    {
        return [
            [
                [
                    "Army of Darkness",
                    "Attack of the 50 Foot Woman",
                    "Dog Day Afternoon",
                    "Star Wars: Episode IV - A New Hope",
                    "The Devil and Miss Jones",
                    "The Fish That Saved Pittsburgh",
                    "The Kentucky Fried Movie",
                    "The Public Enemy"
                ],
                [],
            ]
        ];

    }
}
