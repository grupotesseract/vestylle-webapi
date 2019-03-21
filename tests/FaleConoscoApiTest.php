<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class FaleConoscoApiTest extends TestCase
{
    use MakeFaleConoscoTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateFaleConosco()
    {
        $faleConosco = $this->fakeFaleConoscoData();
        $this->json('POST', '/api/v1/faleConoscos', $faleConosco);

        $this->assertApiResponse($faleConosco);
    }

    /**
     * @test
     */
    public function testReadFaleConosco()
    {
        $faleConosco = $this->makeFaleConosco();
        $this->json('GET', '/api/v1/faleConoscos/'.$faleConosco->id);

        $this->assertApiResponse($faleConosco->toArray());
    }

    /**
     * @test
     */
    public function testUpdateFaleConosco()
    {
        $faleConosco = $this->makeFaleConosco();
        $editedFaleConosco = $this->fakeFaleConoscoData();

        $this->json('PUT', '/api/v1/faleConoscos/'.$faleConosco->id, $editedFaleConosco);

        $this->assertApiResponse($editedFaleConosco);
    }

    /**
     * @test
     */
    public function testDeleteFaleConosco()
    {
        $faleConosco = $this->makeFaleConosco();
        $this->json('DELETE', '/api/v1/faleConoscos/'.$faleConosco->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/faleConoscos/'.$faleConosco->id);

        $this->assertResponseStatus(404);
    }
}
