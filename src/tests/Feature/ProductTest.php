<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * Test if we can create a product.
     *
     * @return void
     */
    public function testCanCreate()
    {
        $data = [
            'sku' => 'sku',
            'attributes' => ['sku' => 'sku', 'key' => 'value']
        ];

        $response = $this->post('/api/products/create', $data);

        $response->assertStatus(201);

    }

    public function testCanView()
    {

        $response = $this->get('api/products');

        $response->assertStatus(200);

    }
}
