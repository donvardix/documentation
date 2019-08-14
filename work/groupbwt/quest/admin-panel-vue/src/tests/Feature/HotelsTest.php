<?php

namespace Tests\Feature;

use App\Models\Hotel;
use App\Models\Parser;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class HotelsTest extends TestCase
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

    protected function createAuthorizedUser($response = null)
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

    public function testGetHotelsUnauthorized()
    {
        $response = $this->json('GET', 'api/hotels')->assertStatus(401);
        $this->checkStatus($response);
        $this->checkMeta($response);
    }

    public function testGetHotelsAuthorized()
    {
        $token = $this->createAuthorizedUser();

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->json('GET', 'api/hotels')->assertStatus(200);
        $this->checkStatus($response, 1);
        $this->checkMeta($response);
    }

    public function testGetHotelUnauthorized()
    {
        $response = $this->json('GET', 'api/hotels/1')->assertStatus(401);
        $this->checkStatus($response);
        $this->checkMeta($response);
    }

    public function testGetHotelAuthorized()
    {
        $token = $this->createAuthorizedUser();
        Hotel::create($this->dataHotel);

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->json('GET', 'api/hotels/1')->assertStatus(200);
        $this->checkStatus($response, 1);
        $this->checkMeta($response);
    }

    public function testGetHotelDefunctAuthorized()
    {
        $token = $this->createAuthorizedUser();
        Hotel::create($this->dataHotel);

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->json('GET', 'api/hotels/2')->assertStatus(404);
        $this->checkStatus($response);
        $this->checkMeta($response);
    }

    public function testPostHotelUnauthorized()
    {
        $response = $this->json('POST', 'api/hotels')->assertStatus(401);
        $this->checkStatus($response);
        $this->checkMeta($response);
    }

    public function testSendNullPostHotelAuthorized()
    {
        $token = $this->createAuthorizedUser();

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->json('POST', 'api/hotels')->assertStatus(422)
            ->assertJsonStructure([
                'meta' => [
                    'errors' => [
                        'name',
                        'description',
                        'address',
                        'city',
                        'postcode',
                        'country',
                        'rating',
                        'image',
                        'url_hotel'
                    ]
                ]
            ]);
        $this->checkStatus($response);
        $this->checkMeta($response);
    }

    public function testPostHotelAuthorized()
    {
        $token = $this->createAuthorizedUser();
        $request = $this->dataHotel;

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->json('POST', 'api/hotels', $request)->assertStatus(201);
        $this->checkStatus($response, 1);
        $this->checkMeta($response);
    }

    public function testPutHotelUnauthorized()
    {
        $dataHotelPut = ["_method" => "PUT"];

        $response = $this->json('POST', 'api/hotels/1', $dataHotelPut)->assertStatus(401);
        $this->checkStatus($response);
        $this->checkMeta($response);
    }

    public function testPutHotelAuthorized()
    {
        $token = $this->createAuthorizedUser();
        Hotel::create($this->dataHotel);
        $request = $this->dataHotel;
        $dataHotelPut = ["_method" => "PUT"];
        $request = array_merge($request, $dataHotelPut);

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->json('POST', 'api/hotels/1', $request)->assertStatus(200);
        $this->checkStatus($response, 1);
        $this->checkMeta($response);
    }

    public function testDeleteHotelUnauthorized()
    {
        $response = $this->json('DELETE', 'api/hotels/1')->assertStatus(401);
        $this->checkStatus($response);
        $this->checkMeta($response);
    }

    public function testDeleteHotelAuthorized()
    {
        $token = $this->createAuthorizedUser();
        Hotel::create($this->dataHotel);

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->json('DELETE', 'api/hotels/1')->assertStatus(200);
        $this->checkStatus($response, 1);
        $this->checkMeta($response);
    }
}
