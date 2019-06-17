<?php

use App\Models\FaleConosco;
use App\Repositories\FaleConoscoRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class FaleConoscoRepositoryTest extends TestCase
{
    use MakeFaleConoscoTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var FaleConoscoRepository
     */
    protected $faleConoscoRepo;

    public function setUp()
    {
        parent::setUp();
        $this->faleConoscoRepo = App::make(FaleConoscoRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateFaleConosco()
    {
        $faleConosco = $this->fakeFaleConoscoData();
        $createdFaleConosco = $this->faleConoscoRepo->create($faleConosco);
        $createdFaleConosco = $createdFaleConosco->toArray();
        $this->assertArrayHasKey('id', $createdFaleConosco);
        $this->assertNotNull($createdFaleConosco['id'], 'Created FaleConosco must have id specified');
        $this->assertNotNull(FaleConosco::find($createdFaleConosco['id']), 'FaleConosco with given id must be in DB');
        $this->assertModelData($faleConosco, $createdFaleConosco);
    }

    /**
     * @test read
     */
    public function testReadFaleConosco()
    {
        $faleConosco = $this->makeFaleConosco();
        $dbFaleConosco = $this->faleConoscoRepo->find($faleConosco->id);
        $dbFaleConosco = $dbFaleConosco->toArray();
        $this->assertModelData($faleConosco->toArray(), $dbFaleConosco);
    }

    /**
     * @test update
     */
    public function testUpdateFaleConosco()
    {
        $faleConosco = $this->makeFaleConosco();
        $fakeFaleConosco = $this->fakeFaleConoscoData();
        $updatedFaleConosco = $this->faleConoscoRepo->update($fakeFaleConosco, $faleConosco->id);
        $this->assertModelData($fakeFaleConosco, $updatedFaleConosco->toArray());
        $dbFaleConosco = $this->faleConoscoRepo->find($faleConosco->id);
        $this->assertModelData($fakeFaleConosco, $dbFaleConosco->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteFaleConosco()
    {
        $faleConosco = $this->makeFaleConosco();
        $resp = $this->faleConoscoRepo->delete($faleConosco->id);
        $this->assertTrue($resp);
        $this->assertNull(FaleConosco::find($faleConosco->id), 'FaleConosco should not exist in DB');
    }
}
