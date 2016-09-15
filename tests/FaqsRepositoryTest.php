<?php

use App\Models\Faqs;
use App\Repositories\FaqsRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class FaqsRepositoryTest extends TestCase
{
    use MakeFaqsTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var FaqsRepository
     */
    protected $faqsRepo;

    public function setUp()
    {
        parent::setUp();
        $this->faqsRepo = App::make(FaqsRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateFaqs()
    {
        $faqs = $this->fakeFaqsData();
        $createdFaqs = $this->faqsRepo->create($faqs);
        $createdFaqs = $createdFaqs->toArray();
        $this->assertArrayHasKey('id', $createdFaqs);
        $this->assertNotNull($createdFaqs['id'], 'Created Faqs must have id specified');
        $this->assertNotNull(Faqs::find($createdFaqs['id']), 'Faqs with given id must be in DB');
        $this->assertModelData($faqs, $createdFaqs);
    }

    /**
     * @test read
     */
    public function testReadFaqs()
    {
        $faqs = $this->makeFaqs();
        $dbFaqs = $this->faqsRepo->find($faqs->id);
        $dbFaqs = $dbFaqs->toArray();
        $this->assertModelData($faqs->toArray(), $dbFaqs);
    }

    /**
     * @test update
     */
    public function testUpdateFaqs()
    {
        $faqs = $this->makeFaqs();
        $fakeFaqs = $this->fakeFaqsData();
        $updatedFaqs = $this->faqsRepo->update($fakeFaqs, $faqs->id);
        $this->assertModelData($fakeFaqs, $updatedFaqs->toArray());
        $dbFaqs = $this->faqsRepo->find($faqs->id);
        $this->assertModelData($fakeFaqs, $dbFaqs->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteFaqs()
    {
        $faqs = $this->makeFaqs();
        $resp = $this->faqsRepo->delete($faqs->id);
        $this->assertTrue($resp);
        $this->assertNull(Faqs::find($faqs->id), 'Faqs should not exist in DB');
    }
}
