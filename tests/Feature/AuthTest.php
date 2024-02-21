<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;

use Firebase\JWT\JWT;
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
        $response = $this->post('/api/login', $input);

        $response->assertStatus(data_get($expectedResult, 'status_code'));
        $response->assertJsonPath('status', data_get($expectedResult, 'status'));
        if ($response->getStatusCode() == 200) {
            $response->assertJsonStructure(['status', 'token']);
            $token = $response->json('token');
            $jwt = JWT::decode($token, (new \Firebase\JWT\Key(config('jwt.key'), config('jwt.algorithm'))));

            $this->assertEquals([
                'login' => data_get($input, 'login'),
                'context' => data_get($input, 'context'),
            ], (array) $jwt);
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
                    'context' => 'BAR',
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
                    'context' => 'BAZ',
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
                    'context' => 'FOO',
                ],
            ],
        ];

    }
}
