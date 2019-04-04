<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class LojaApiTest extends TestCase
{
    use MakeLojaTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateLoja()
    {
        $loja = $this->fakeLojaData();
        $this->json('POST', '/api/v1/lojas', $loja);

        $this->assertApiResponse($loja);
    }

    /**
     * @test
     */
    public function testReadLoja()
    {
        $loja = $this->makeLoja();
        $this->json('GET', '/api/v1/lojas/'.$loja->id);

        $this->assertApiResponse($loja->toArray());
    }

    /**
     * @test
     */
    public function testUpdateLoja()
    {
        $loja = $this->makeLoja();
        $editedLoja = $this->fakeLojaData();

        $this->json('PUT', '/api/v1/lojas/'.$loja->id, $editedLoja);

        $this->assertApiResponse($editedLoja);
    }

    /**
     * @test
     */
    public function testDeleteLoja()
    {
        $loja = $this->makeLoja();
        $this->json('DELETE', '/api/v1/lojas/'.$loja->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/lojas/'.$loja->id);

        $this->assertResponseStatus(404);
    }
}
