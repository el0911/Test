<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PurchaseTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
    
       $response =  $this->json('GET', '/buyme/841452673', [])
        ->assertJson([
            'status' => "Success",
        ]);

        $this->assertEquals(200, $response->status());

        $response = $this->json('GET', '/buyme/843Y4893HRK', [])
        ->assertJson([
            'status' => "error",
        ]);

        $this->assertEquals(400, $response->status());

    }
}
