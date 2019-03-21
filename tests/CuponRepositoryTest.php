<?php

use App\Models\Cupon;
use App\Repositories\CuponRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CuponRepositoryTest extends TestCase
{
    use MakeCuponTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var CuponRepository
     */
    protected $cuponRepo;

    public function setUp()
    {
        parent::setUp();
        $this->cuponRepo = App::make(CuponRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateCupon()
    {
        $cupon = $this->fakeCuponData();
        $createdCupon = $this->cuponRepo->create($cupon);
        $createdCupon = $createdCupon->toArray();
        $this->assertArrayHasKey('id', $createdCupon);
        $this->assertNotNull($createdCupon['id'], 'Created Cupon must have id specified');
        $this->assertNotNull(Cupon::find($createdCupon['id']), 'Cupon with given id must be in DB');
        $this->assertModelData($cupon, $createdCupon);
    }

    /**
     * @test read
     */
    public function testReadCupon()
    {
        $cupon = $this->makeCupon();
        $dbCupon = $this->cuponRepo->find($cupon->id);
        $dbCupon = $dbCupon->toArray();
        $this->assertModelData($cupon->toArray(), $dbCupon);
    }

    /**
     * @test update
     */
    public function testUpdateCupon()
    {
        $cupon = $this->makeCupon();
        $fakeCupon = $this->fakeCuponData();
        $updatedCupon = $this->cuponRepo->update($fakeCupon, $cupon->id);
        $this->assertModelData($fakeCupon, $updatedCupon->toArray());
        $dbCupon = $this->cuponRepo->find($cupon->id);
        $this->assertModelData($fakeCupon, $dbCupon->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteCupon()
    {
        $cupon = $this->makeCupon();
        $resp = $this->cuponRepo->delete($cupon->id);
        $this->assertTrue($resp);
        $this->assertNull(Cupon::find($cupon->id), 'Cupon should not exist in DB');
    }
}
