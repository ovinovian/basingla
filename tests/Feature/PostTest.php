<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/post');

        $response->assertStatus(200);
    }

    public function test_result(): void
    {
        $test = 'Ovi';
        $response = $this->get('/post');

        $response->assertContent($test);
    }
}
