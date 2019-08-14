<?php

namespace Tests\Feature;

use App\Jobs\StartParser;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Tests\TestCase;
use Illuminate\Support\Facades\Queue;

class ParserTest extends TestCase
{
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
            case 401:
                $this->assertArrayHasKey('message', $metaData);
                $this->assertIsString($metaData['message']);
                break;
        }
    }

    protected function createAuthorizedUser()
    {
        Role::create(['name' => 'user']);
        $user = $user = factory(User::class, 'user')->create();
        $user->assignRole('user');
        return $user->api_token;
    }

    public function testStartParserUnauthorized()
    {
        $response = $this->json('GET',
            'api/start-parser?city=Запорожье&checkin=15-08-2019&checkout=17-08-2019')->assertStatus(401);
        $this->checkStatus($response);
        $this->checkMeta($response);
    }

    public function testStartParser()
    {
        $this->createAuthorizedUser();
        Queue::fake();
        Queue::assertNotPushed(StartParser::class);
    }
}
