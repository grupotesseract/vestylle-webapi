<?php

use App\Models\Oferta;
use App\Repositories\OfertaRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class OfertaRepositoryTest extends TestCase
{
    use MakeOfertaTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var OfertaRepository
     */
    protected $ofertaRepo;

    public function setUp()
    {
        parent::setUp();
        $this->ofertaRepo = App::make(OfertaRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateOferta()
    {
        $oferta = $this->fakeOfertaData();
        $createdOferta = $this->ofertaRepo->create($oferta);
        $createdOferta = $createdOferta->toArray();
        $this->assertArrayHasKey('id', $createdOferta);
        $this->assertNotNull($createdOferta['id'], 'Created Oferta must have id specified');
        $this->assertNotNull(Oferta::find($createdOferta['id']), 'Oferta with given id must be in DB');
        $this->assertModelData($oferta, $createdOferta);
    }

    /**
     * @test read
     */
    public function testReadOferta()
    {
        $oferta = $this->makeOferta();
        $dbOferta = $this->ofertaRepo->find($oferta->id);
        $dbOferta = $dbOferta->toArray();
        $this->assertModelData($oferta->toArray(), $dbOferta);
    }

    /**
     * @test update
     */
    public function testUpdateOferta()
    {
        $oferta = $this->makeOferta();
        $fakeOferta = $this->fakeOfertaData();
        $updatedOferta = $this->ofertaRepo->update($fakeOferta, $oferta->id);
        $this->assertModelData($fakeOferta, $updatedOferta->toArray());
        $dbOferta = $this->ofertaRepo->find($oferta->id);
        $this->assertModelData($fakeOferta, $dbOferta->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteOferta()
    {
        $oferta = $this->makeOferta();
        $resp = $this->ofertaRepo->delete($oferta->id);
        $this->assertTrue($resp);
        $this->assertNull(Oferta::find($oferta->id), 'Oferta should not exist in DB');
    }
}
