<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $response = $this->get('/');

        $response->assertStatus(200);

        $this->get('/')->assertSee('The app to guide teachers, children and parents on the reading learning journey');

        $this->get('/teacher/login')->assertSee('Teacher Login');
         
    }
}
