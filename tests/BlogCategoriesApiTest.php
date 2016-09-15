<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class BlogCategoriesApiTest extends TestCase
{
    use MakeBlogCategoriesTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateBlogCategories()
    {
        $blogCategories = $this->fakeBlogCategoriesData();
        $this->json('POST', '/api/v1/blogCategories', $blogCategories);

        $this->assertApiResponse($blogCategories);
    }

    /**
     * @test
     */
    public function testReadBlogCategories()
    {
        $blogCategories = $this->makeBlogCategories();
        $this->json('GET', '/api/v1/blogCategories/'.$blogCategories->id);

        $this->assertApiResponse($blogCategories->toArray());
    }

    /**
     * @test
     */
    public function testUpdateBlogCategories()
    {
        $blogCategories = $this->makeBlogCategories();
        $editedBlogCategories = $this->fakeBlogCategoriesData();

        $this->json('PUT', '/api/v1/blogCategories/'.$blogCategories->id, $editedBlogCategories);

        $this->assertApiResponse($editedBlogCategories);
    }

    /**
     * @test
     */
    public function testDeleteBlogCategories()
    {
        $blogCategories = $this->makeBlogCategories();
        $this->json('DELETE', '/api/v1/blogCategories/'.$blogCategories->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/blogCategories/'.$blogCategories->id);

        $this->assertResponseStatus(404);
    }
}
