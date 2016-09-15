<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class FaqsApiTest extends TestCase
{
    use MakeFaqsTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateFaqs()
    {
        $faqs = $this->fakeFaqsData();
        $this->json('POST', '/api/v1/faqs', $faqs);

        $this->assertApiResponse($faqs);
    }

    /**
     * @test
     */
    public function testReadFaqs()
    {
        $faqs = $this->makeFaqs();
        $this->json('GET', '/api/v1/faqs/'.$faqs->id);

        $this->assertApiResponse($faqs->toArray());
    }

    /**
     * @test
     */
    public function testUpdateFaqs()
    {
        $faqs = $this->makeFaqs();
        $editedFaqs = $this->fakeFaqsData();

        $this->json('PUT', '/api/v1/faqs/'.$faqs->id, $editedFaqs);

        $this->assertApiResponse($editedFaqs);
    }

    /**
     * @test
     */
    public function testDeleteFaqs()
    {
        $faqs = $this->makeFaqs();
        $this->json('DELETE', '/api/v1/faqs/'.$faqs->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/faqs/'.$faqs->id);

        $this->assertResponseStatus(404);
    }
}
