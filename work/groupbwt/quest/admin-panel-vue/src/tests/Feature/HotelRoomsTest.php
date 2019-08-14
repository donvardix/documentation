<?php

namespace Tests\Feature;

use App\Models\Hotel;
use App\Models\Parser;
use App\Models\Room;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class HotelRoomsTest extends TestCase
{
    protected $dataHotel = [
        "name" => "Отель «ЗОЛОТАЯ АРКА»",
        "description" => "Отель «ЗОЛОТАЯ АРКА» находится в Запорожье. В номерах с кондиционером предоставляется бесплатный Wi-Fi.",
        "address" => "вул. 8 Березня 45",
        "city" => "Запорожье",
        "postcode" => "69081",
        "country" => "Украина",
        "rating" => "7.5",
        "image" => "full/6c356897d6ec03623aa66ccb08b6da7782fc448b.jpg",
        "url_hotel" => "https://www.booking.com/hotel/ua/zolotaia-arka.ru.html"
    ];

    protected $dataRoom = [
        "name" => "Отель «ЗОЛОТАЯ АРКА»",
        "image" => "Отель «ЗОЛОТАЯ АРКА» находится в Запорожье. В номерах с кондиционером предоставляется бесплатный Wi-Fi.",
        "price" => "вул. 8 Березня 45",
        "occupancy" => "Запорожье",
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
        Parser::create([
            'hotel_id' => 1,
            'user_id' => 1
        ]);
        return $user->api_token;
    }

    public function testGetHotelRoomsUnauthorized()
    {
        $response = $this->json('GET', 'api/hotels/1/rooms')->assertStatus(401);
        $this->checkStatus($response);
        $this->checkMeta($response);
    }

    public function testGetHotelRoomsAuthorized()
    {
        $token = $this->createAuthorizedUser();
        Hotel::create($this->dataHotel);
        Room::create($this->dataRoom);
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->json('GET', 'api/hotels/1/rooms')->assertStatus(200);
        $this->checkStatus($response, 1);
        $this->checkMeta($response);
    }

    public function testGetHotelRoomsAuthorizedNotFound()
    {
        $token = $this->createAuthorizedUser();
        Hotel::create($this->dataHotel);
        Room::create($this->dataRoom);
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->json('GET', 'api/hotels/2/rooms')->assertStatus(404);
        $this->checkStatus($response);
        $this->checkMeta($response);
    }

    public function testGetHotelRoomUnauthorized()
    {
        $response = $this->json('GET', 'api/hotels/1/rooms/1')->assertStatus(401);
        $this->checkStatus($response);
        $this->checkMeta($response);
    }

    public function testGetHotelRoomAuthorized()
    {
        $token = $this->createAuthorizedUser();
        Hotel::create($this->dataHotel);
        Room::create($this->dataRoom);
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->json('GET', 'api/hotels/1/rooms/1')->assertStatus(200);
        $this->checkStatus($response, 1);
        $this->checkMeta($response);
    }

    public function testGetHotelRoomAuthorizedNotFound()
    {
        $token = $this->createAuthorizedUser();
        Hotel::create($this->dataHotel);
        Room::create($this->dataRoom);
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->json('GET', 'api/hotels/1/rooms/2')->assertStatus(404);
        $this->checkStatus($response);
        $this->checkMeta($response);
    }
}
