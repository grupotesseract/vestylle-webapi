<?php

use App\Models\Pessoa;
use App\Repositories\PessoaRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PessoaRepositoryTest extends TestCase
{
    use MakePessoaTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var PessoaRepository
     */
    protected $pessoaRepo;

    public function setUp()
    {
        parent::setUp();
        $this->pessoaRepo = App::make(PessoaRepository::class);
    }

    /**
     * @test create
     */
    public function testCreatePessoa()
    {
        $pessoa = $this->fakePessoaData();
        $createdPessoa = $this->pessoaRepo->create($pessoa);
        $createdPessoa = $createdPessoa->toArray();
        $this->assertArrayHasKey('id', $createdPessoa);
        $this->assertNotNull($createdPessoa['id'], 'Created Pessoa must have id specified');
        $this->assertNotNull(Pessoa::find($createdPessoa['id']), 'Pessoa with given id must be in DB');
        $this->assertModelData($pessoa, $createdPessoa);
    }

    /**
     * @test read
     */
    public function testReadPessoa()
    {
        $pessoa = $this->makePessoa();
        $dbPessoa = $this->pessoaRepo->find($pessoa->id);
        $dbPessoa = $dbPessoa->toArray();
        $this->assertModelData($pessoa->toArray(), $dbPessoa);
    }

    /**
     * @test update
     */
    public function testUpdatePessoa()
    {
        $pessoa = $this->makePessoa();
        $fakePessoa = $this->fakePessoaData();
        $updatedPessoa = $this->pessoaRepo->update($fakePessoa, $pessoa->id);
        $this->assertModelData($fakePessoa, $updatedPessoa->toArray());
        $dbPessoa = $this->pessoaRepo->find($pessoa->id);
        $this->assertModelData($fakePessoa, $dbPessoa->toArray());
    }

    /**
     * @test delete
     */
    public function testDeletePessoa()
    {
        $pessoa = $this->makePessoa();
        $resp = $this->pessoaRepo->delete($pessoa->id);
        $this->assertTrue($resp);
        $this->assertNull(Pessoa::find($pessoa->id), 'Pessoa should not exist in DB');
    }
}
