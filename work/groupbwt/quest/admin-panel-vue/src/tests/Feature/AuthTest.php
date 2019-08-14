<?php

namespace Tests\Feature;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class AuthTest extends TestCase
{
    protected $request = [
        'email' => 'user@gmail.com',
        'password' => '12345678'
    ];

    protected function checkStatus($response, $status = 0)
    {
        $content = json_decode($response->content(), true);
        $this->assertArrayHasKey('status', $content);
        $this->assertIsInt($content['status']);
        $this->assertEquals($status, $content['status']);
    }

    protected function checkMeta($response)
    {
        $content = json_decode($response->content(), true);
        $metaData = $content['meta'];
        $this->assertIsArray($metaData);
        $this->assertArrayHasKey('http_code', $metaData);
        $this->assertIsInt($metaData['http_code']);
        switch ($metaData['http_code']) {
            case 200:
            case 201:
                $this->assertArrayHasKey('response', $content);
                $this->assertIsArray($content['response']);
                break;
            case 400:
            case 401:
                $this->assertArrayHasKey('message', $metaData);
                $this->assertIsString($metaData['message']);
                break;
            case 422:
                $this->assertArrayHasKey('errors', $metaData);
                $this->assertIsArray($metaData['errors']);
                break;
        }
    }

    public function testSendNullDataLogin()
    {
        $response = $this->json('POST', 'api/login')
            ->assertStatus(422)
            ->assertJsonStructure([
                'meta' => [
                    'errors' => [
                        'email',
                        'password'
                    ]
                ]
            ]);
        $this->checkStatus($response);
        $this->checkMeta($response);
    }

    public function testSendNullDataRegister()
    {
        $response = $this->json('POST', 'api/register')
            ->assertStatus(422)
            ->assertJsonStructure([
                'meta' => [
                    'errors' => [
                        'name',
                        'email',
                        'password'
                    ]
                ]
            ]);
        $this->checkStatus($response);
        $this->checkMeta($response);
    }

    public function testRegisterSuccessfully()
    {
        Role::create(['name' => 'user']);
        $request = [
            'name' => 'User',
            'email' => 'user@gmail.com',
            'password' => '12345678'
        ];

        $response = $this->json('POST', 'api/register', $request)->assertStatus(201);
        $this->checkStatus($response, 1);
        $this->checkMeta($response);
    }

    public function testFakeLogin()
    {
        $response = $this->json('POST', 'api/login', $this->request)->assertStatus(400);
        $this->checkStatus($response);
        $this->checkMeta($response);
    }

    public function testLoginSuccessfully()
    {
        Role::create(['name' => 'user']);
        factory(User::class, 'user')->create();
        $response = $this->json('POST', 'api/login', $this->request)->assertStatus(200);
        $this->checkStatus($response, 1);
        $this->checkMeta($response);
    }

    public function testLogoutUnauthorized()
    {
        $response = $this->json('GET', 'api/logout')->assertStatus(401);
        $this->checkStatus($response);
        $this->checkMeta($response);
    }

    public function testLogoutAuthorized()
    {
        Role::create(['name' => 'user']);
        $user = factory(User::class, 'user')->create();
        $user->assignRole('user');
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $user->api_token,
        ])->json('GET', 'api/logout')->assertStatus(200);
        $this->checkStatus($response, 1);
        $this->checkMeta($response);
    }
}
