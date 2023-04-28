<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class InsertionTest extends TestCase
{

    use RefreshDatabase;
    /**
     * A basic feature test example.
     */

    //test register
    public function test_can_be_register(): void
    {
        $this->withoutExceptionHandling();
        $response = $this->post('api/register', [
            'name' => 'resna',
            'email' => 'resna12@gmail.com',
            'password' => '12345678',
        ]);

        $response->assertStatus(200);
    }

}
