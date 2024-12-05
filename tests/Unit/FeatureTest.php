<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class FeatureTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->get('/saludo');

        $response->assertStatus(200);
        $response->assertSee('Hola Mundo');
    }
}
