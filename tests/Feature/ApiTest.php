<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ApiTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testGetKitab()
    {
        $response = $this->json("GET","api/getKitab");
        $response->assertStatus(200);

        $data = $response->original;
        $this->assertTrue($data->count() == 66);
    }

    public function testGetFirman()
    {
        $response = $this->json("GET", "api/getFirman/KEJADIAN/1/1");
        $response->assertStatus(200);
        $data = collect($response->original->toArray());
        $this->assertTrue($data->count() == 5);
    }
}
