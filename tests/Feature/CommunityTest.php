<?php

namespace Tests\Feature;

use App\Models\Community;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class CommunityTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_can_fetch_all_communities()
    {
        $this->withoutExceptionHandling();

        Sanctum::actingAs(
            User::factory()->create(),
            ['*']
        );
        $response = $this->get('/api/communities');
        $response->assertStatus(200);
    }

    public function test_can_fetch_single_comunities()
    {
        $this->withoutExceptionHandling();

        Sanctum::actingAs(
            User::factory()->create(),
            ['*']
        );

        Community::factory()->create();
        $response = $this->get('/api/communities/1');
        $response->assertStatus(200);
    }

    public function test_name_of_community_is_required()
    {
        Sanctum::actingAs(
            User::factory()->create(),
            ['*']
        );

        $data = [

            "title" => '',
            "body"  => "testComunityBody"
        ];
        $response = $this->postJson(
            '/api/communities',
            $data,
            ['Content-Type' => 'application/vnd.api+json']
        );
        $response->assertStatus(500);
    }

    public function test_can_create_comunity()
    {
        Sanctum::actingAs(
            User::factory()->create(),
            ['*']
        );

        $data = [

            "title" => "testComunity",
            "body"  => "testComunityBody"
        ];
        $response = $this->postJson(
            '/api/communities',
            $data,
            ['Content-Type' => 'application/vnd.api+json']
        );
        $response->assertStatus(201);
    }

    public function test_guests_cannot_create_comunity()
    {$data=[

        "title" => "testComunity",
        "body"=> "testComunity"
    ];
    $response = $this->postJson('/api/communities',$data,
        ['Content-Type' => 'application/vnd.api+json']);
        $response->assertUnauthorized();
    }

    public function test_can_update_communities(){

        Sanctum::actingAs(
            User::factory()->create(),['*']
        );

        $comunidad=Community::factory()->create();
        $data=[

            "title" => "testComunityupdate",
            "body"  => "testComunityBody"
        ];

        $response = $this->patchJson(route('communities.update',$comunidad),$data,
        ['Content-Type' => 'application/vnd.api+json']);


        $response->assertStatus(200);

    }


    public function test_can_delete_community()
    {
        $community = Community::factory()->create();
        $community->delete();
        $this->assertDatabaseMissing('communities', ['id' => $community->id]);
    }


    public function test_can_returns_a_json_api_error_object_when_a_comunidad_is_not_found()
    {
        Sanctum::actingAs(
            User::factory()->create(),['*']
        );
        $response = $this->getJson(route('communities.show', 999));

        $response->assertJsonStructure();
    }
}
