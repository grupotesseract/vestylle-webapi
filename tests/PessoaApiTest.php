<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PessoaApiTest extends TestCase
{
    use MakePessoaTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreatePessoa()
    {
        $pessoa = $this->fakePessoaData();
        $this->json('POST', '/api/v1/pessoas', $pessoa);

        $this->assertApiResponse($pessoa);
    }

    /**
     * @test
     */
    public function testReadPessoa()
    {
        $pessoa = $this->makePessoa();
        $this->json('GET', '/api/v1/pessoas/'.$pessoa->id);

        $this->assertApiResponse($pessoa->toArray());
    }

    /**
     * @test
     */
    public function testUpdatePessoa()
    {
        $pessoa = $this->makePessoa();
        $editedPessoa = $this->fakePessoaData();

        $this->json('PUT', '/api/v1/pessoas/'.$pessoa->id, $editedPessoa);

        $this->assertApiResponse($editedPessoa);
    }

    /**
     * @test
     */
    public function testDeletePessoa()
    {
        $pessoa = $this->makePessoa();
        $this->json('DELETE', '/api/v1/pessoas/'.$pessoa->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/pessoas/'.$pessoa->id);

        $this->assertResponseStatus(404);
    }
}
