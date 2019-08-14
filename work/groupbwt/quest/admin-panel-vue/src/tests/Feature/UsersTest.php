<?php

namespace Tests\Feature;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class UsersTest extends TestCase
{
    protected $dataUser = [
        'name' => 'New',
        'email' => 'new@gmail.com',
        'password' => '12345678',
    ];

    protected function checkStatus($response, $status=0)
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
            case 403:
            case 404:
                $this->assertArrayHasKey('message', $metaData);
                $this->assertIsString($metaData['message']);
                break;
            case 422:
                $this->assertArrayHasKey('errors', $metaData);
                $this->assertIsArray($metaData['errors']);
                break;
        }
    }

    protected function createAuthorizedUser()
    {
        Role::create(['name' => 'user']);
        $user = factory(User::class, 'user')->create();
        $user->assignRole('user');
        return $user->api_token;
    }

    protected function createAuthorizedAdmin()
    {
        Role::create(['name' => 'admin']);
        $admin = factory(User::class, 'user')->create();
        $admin->assignRole('admin');
        return $admin->api_token;
    }

    public function testGetUsersUnauthorized()
    {
        $response = $this->json('GET', 'api/users')->assertStatus(401);
        $this->checkStatus($response);
        $this->checkMeta($response);
    }

    public function testGetUsersNotAdmin()
    {
        $token = $this->createAuthorizedUser();
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->json('GET', 'api/users')->assertStatus(403);
        $this->checkStatus($response);
        $this->checkMeta($response);
    }

    public function testGetUsersAdmin()
    {
        $token = $this->createAuthorizedAdmin();
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->json('GET', 'api/users')->assertStatus(200);
        $this->checkStatus($response, 1);
        $this->checkMeta($response);
    }

    public function testGetUserUnauthorized()
    {
        $response = $this->json('GET', 'api/users/1')->assertStatus(401);
        $this->checkStatus($response);
        $this->checkMeta($response);
    }

    public function testGetUserNotAdmin()
    {
        $token = $this->createAuthorizedUser();
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->json('GET', 'api/users/1')->assertStatus(403);
        $this->checkStatus($response);
        $this->checkMeta($response);
    }

    public function testGetUserAdmin()
    {
        $token = $this->createAuthorizedAdmin();
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->json('GET', 'api/users/1')->assertStatus(200);
        $this->checkStatus($response, 1);
        $this->checkMeta($response);
    }

    public function testPostUserUnauthorized()
    {
        $response = $this->json('POST', 'api/users', $this->dataUser)->assertStatus(401);
        $this->checkStatus($response);
        $this->checkMeta($response);
    }

    public function testPostUserNotAdmin()
    {
        $token = $this->createAuthorizedUser();
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->json('POST', 'api/users', $this->dataUser)->assertStatus(403);
        $this->checkStatus($response);
        $this->checkMeta($response);
    }

    public function testPostUserAdmin()
    {
        $token = $this->createAuthorizedAdmin();
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->json('POST', 'api/users', $this->dataUser)->assertStatus(201);
        $this->checkStatus($response, 1);
        $this->checkMeta($response);
    }

    public function testPutUserUnauthorized()
    {
        $request = $this->dataUser;
        $dataHotelPut = ["_method" => "PUT"];
        $request = array_merge($request, $dataHotelPut);
        $response = $this->json('POST', 'api/users/2', $request)->assertStatus(401);
        $this->checkStatus($response);
        $this->checkMeta($response);
    }

    public function testPutUserNotAdmin()
    {
        $token = $this->createAuthorizedUser();
        User::create($this->dataUser);
        $request = $this->dataUser;
        $dataHotelPut = ["_method" => "PUT"];
        $request = array_merge($request, $dataHotelPut);
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->json('POST', 'api/users/2', $request)->assertStatus(403);
        $this->checkStatus($response);
        $this->checkMeta($response);
    }

    public function testPutUserAdmin()
    {
        $token = $this->createAuthorizedAdmin();
        User::create($this->dataUser);
        $request = $this->dataUser;
        $dataHotelPut = ["_method" => "PUT"];
        $request = array_merge($request, $dataHotelPut);
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->json('POST', 'api/users/2', $request)->assertStatus(200);
        $this->checkStatus($response, 1);
        $this->checkMeta($response);
    }
}
