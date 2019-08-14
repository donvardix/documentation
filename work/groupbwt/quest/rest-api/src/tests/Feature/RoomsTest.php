<?php

namespace Tests\Feature;

use App\Models\Parser;
use App\Models\Room;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class RoomsTest extends TestCase
{
    protected $dataRoom = [
        "name" => "Апартаменты с 1 спальней",
        "image" => "full/a7c684a65dc42e7266bed772fe9101935768f121.jpg",
        "price" => "UAH 1 960",
        "occupancy" => "Вместимость: 1 - 4 гостя",
        "hotel_id" => "1"
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
        }
    }

    protected function createAuthorizedUser()
    {
        Role::create(['name' => 'user']);
        $user = factory(User::class, 'user')->create();
        Parser::create([
            'hotel_id' => 1,
            'user_id' => 1
        ]);
        return $user->api_token;
    }

    public function testGetRoomsUnauthorized()
    {
        $response = $this->json('GET', 'api/rooms')->assertStatus(401);
        $this->checkStatus($response);
        $this->checkMeta($response);
    }

    public function testGetRoomsAuthorized()
    {
        $token = $this->createAuthorizedUser();
        Room::create($this->dataRoom);
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->json('GET', 'api/rooms')->assertStatus(200);
        $this->checkStatus($response, 1);
        $this->checkMeta($response);
    }

    public function testGetRoomUnauthorized()
    {
        $response = $this->json('GET', 'api/rooms/1')->assertStatus(401);
        $this->checkStatus($response);
        $this->checkMeta($response);
    }

    public function testGetRoomAuthorized()
    {
        $token = $this->createAuthorizedUser();
        Room::create($this->dataRoom);
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->json('GET', 'api/rooms/1')->assertStatus(200);
        $this->checkStatus($response, 1);
        $this->checkMeta($response);
    }
}
