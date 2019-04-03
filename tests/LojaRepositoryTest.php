<?php

use App\Models\Loja;
use App\Repositories\LojaRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class LojaRepositoryTest extends TestCase
{
    use MakeLojaTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var LojaRepository
     */
    protected $lojaRepo;

    public function setUp()
    {
        parent::setUp();
        $this->lojaRepo = App::make(LojaRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateLoja()
    {
        $loja = $this->fakeLojaData();
        $createdLoja = $this->lojaRepo->create($loja);
        $createdLoja = $createdLoja->toArray();
        $this->assertArrayHasKey('id', $createdLoja);
        $this->assertNotNull($createdLoja['id'], 'Created Loja must have id specified');
        $this->assertNotNull(Loja::find($createdLoja['id']), 'Loja with given id must be in DB');
        $this->assertModelData($loja, $createdLoja);
    }

    /**
     * @test read
     */
    public function testReadLoja()
    {
        $loja = $this->makeLoja();
        $dbLoja = $this->lojaRepo->find($loja->id);
        $dbLoja = $dbLoja->toArray();
        $this->assertModelData($loja->toArray(), $dbLoja);
    }

    /**
     * @test update
     */
    public function testUpdateLoja()
    {
        $loja = $this->makeLoja();
        $fakeLoja = $this->fakeLojaData();
        $updatedLoja = $this->lojaRepo->update($fakeLoja, $loja->id);
        $this->assertModelData($fakeLoja, $updatedLoja->toArray());
        $dbLoja = $this->lojaRepo->find($loja->id);
        $this->assertModelData($fakeLoja, $dbLoja->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteLoja()
    {
        $loja = $this->makeLoja();
        $resp = $this->lojaRepo->delete($loja->id);
        $this->assertTrue($resp);
        $this->assertNull(Loja::find($loja->id), 'Loja should not exist in DB');
    }
}
