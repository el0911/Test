<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RecurentTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response =  $this->json('GET', '/recurent/AUTH_4sx5ri1xf1/customer@email.com/5000', [])
        ->assertJson([
            'status' => "Success",
        ]);

        $this->assertEquals(200, $response->status());

        // $response = $this->json('GET', '/recurent/483939/emial/1000', [])
        // ->assertJson([
        //     'status' => "error",
        // ]);

        // $this->assertEquals(400, $response->status());
    }
}
