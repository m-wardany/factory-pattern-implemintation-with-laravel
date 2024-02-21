<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthTest extends TestCase
{
    /**
     * @dataProvider loginDataProvider
     *
     * @return void
     */
    public function test_the_login_returns_the_correct_response($expectedResult, $input): void
    {
        $response = $this->post('/api/login');

        $response->assertStatus(data_get($expectedResult, 'status_code'));
        $response->assertJsonPath('status', data_get($expectedResult, 'status'));
        if ($response->getStatusCode() == 200) {
            $response->assertJsonStructure(['status', 'token']);
        }
    }


    function loginDataProvider(): array
    {
        return [
            'Invalid Login' => [
                [
                    "status_code" => 401,
                    "status" => 'failure'
                ],
                [
                    'login' => 'ABC_123465',
                    'password' => 'foo-bar-baz',
                ],
            ],
            'Invalid Bar Login' => [
                [
                    "status_code" => 401,
                    "status" => 'failure'
                ],
                [
                    'login' => 'Bar_123',
                    'password' => 'foo-bar-baz',
                ],
            ],
            'Valid Bar Login' => [
                [
                    "status_code" => 200,
                    "status" => 'success'
                ],
                [
                    'login' => 'BAR_123',
                    'password' => 'foo-bar-baz',
                ],
            ],
            'Invalid Baz Login' => [
                [
                    "status_code" => 401,
                    "status" => 'failure'
                ],
                [
                    'login' => 'Baz_123',
                    'password' => 'foo-bar-baz',
                ],
            ],
            'Valid Baz Login' => [
                [
                    "status_code" => 200,
                    "status" => 'success'
                ],
                [
                    'login' => 'BAZ_123',
                    'password' => 'foo-bar-baz',
                ],
            ],
            'Invalid FOO Login' => [
                [
                    "status_code" => 401,
                    "status" => 'failure'
                ],
                [
                    'login' => 'Foo_123',
                    'password' => 'foo-bar-baz',
                ],
            ],
            'Valid Foo Login' => [
                [
                    "status_code" => 200,
                    "status" => 'success'
                ],
                [
                    'login' => 'FOO_123',
                    'password' => 'foo-bar-baz',
                ],
            ],
        ];

    }
}
