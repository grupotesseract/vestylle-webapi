<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CuponApiTest extends TestCase
{
    use MakeCuponTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateCupon()
    {
        $cupon = $this->fakeCuponData();
        $this->json('POST', '/api/v1/cupons', $cupon);

        $this->assertApiResponse($cupon);
    }

    /**
     * @test
     */
    public function testReadCupon()
    {
        $cupon = $this->makeCupon();
        $this->json('GET', '/api/v1/cupons/'.$cupon->id);

        $this->assertApiResponse($cupon->toArray());
    }

    /**
     * @test
     */
    public function testUpdateCupon()
    {
        $cupon = $this->makeCupon();
        $editedCupon = $this->fakeCuponData();

        $this->json('PUT', '/api/v1/cupons/'.$cupon->id, $editedCupon);

        $this->assertApiResponse($editedCupon);
    }

    /**
     * @test
     */
    public function testDeleteCupon()
    {
        $cupon = $this->makeCupon();
        $this->json('DELETE', '/api/v1/cupons/'.$cupon->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/cupons/'.$cupon->id);

        $this->assertResponseStatus(404);
    }
}
