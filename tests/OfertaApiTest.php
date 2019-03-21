<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class OfertaApiTest extends TestCase
{
    use MakeOfertaTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateOferta()
    {
        $oferta = $this->fakeOfertaData();
        $this->json('POST', '/api/v1/ofertas', $oferta);

        $this->assertApiResponse($oferta);
    }

    /**
     * @test
     */
    public function testReadOferta()
    {
        $oferta = $this->makeOferta();
        $this->json('GET', '/api/v1/ofertas/'.$oferta->id);

        $this->assertApiResponse($oferta->toArray());
    }

    /**
     * @test
     */
    public function testUpdateOferta()
    {
        $oferta = $this->makeOferta();
        $editedOferta = $this->fakeOfertaData();

        $this->json('PUT', '/api/v1/ofertas/'.$oferta->id, $editedOferta);

        $this->assertApiResponse($editedOferta);
    }

    /**
     * @test
     */
    public function testDeleteOferta()
    {
        $oferta = $this->makeOferta();
        $this->json('DELETE', '/api/v1/ofertas/'.$oferta->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/ofertas/'.$oferta->id);

        $this->assertResponseStatus(404);
    }
}
