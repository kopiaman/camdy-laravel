<?php

use App\Models\BlogCategories;
use App\Repositories\BlogCategoriesRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class BlogCategoriesRepositoryTest extends TestCase
{
    use MakeBlogCategoriesTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var BlogCategoriesRepository
     */
    protected $blogCategoriesRepo;

    public function setUp()
    {
        parent::setUp();
        $this->blogCategoriesRepo = App::make(BlogCategoriesRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateBlogCategories()
    {
        $blogCategories = $this->fakeBlogCategoriesData();
        $createdBlogCategories = $this->blogCategoriesRepo->create($blogCategories);
        $createdBlogCategories = $createdBlogCategories->toArray();
        $this->assertArrayHasKey('id', $createdBlogCategories);
        $this->assertNotNull($createdBlogCategories['id'], 'Created BlogCategories must have id specified');
        $this->assertNotNull(BlogCategories::find($createdBlogCategories['id']), 'BlogCategories with given id must be in DB');
        $this->assertModelData($blogCategories, $createdBlogCategories);
    }

    /**
     * @test read
     */
    public function testReadBlogCategories()
    {
        $blogCategories = $this->makeBlogCategories();
        $dbBlogCategories = $this->blogCategoriesRepo->find($blogCategories->id);
        $dbBlogCategories = $dbBlogCategories->toArray();
        $this->assertModelData($blogCategories->toArray(), $dbBlogCategories);
    }

    /**
     * @test update
     */
    public function testUpdateBlogCategories()
    {
        $blogCategories = $this->makeBlogCategories();
        $fakeBlogCategories = $this->fakeBlogCategoriesData();
        $updatedBlogCategories = $this->blogCategoriesRepo->update($fakeBlogCategories, $blogCategories->id);
        $this->assertModelData($fakeBlogCategories, $updatedBlogCategories->toArray());
        $dbBlogCategories = $this->blogCategoriesRepo->find($blogCategories->id);
        $this->assertModelData($fakeBlogCategories, $dbBlogCategories->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteBlogCategories()
    {
        $blogCategories = $this->makeBlogCategories();
        $resp = $this->blogCategoriesRepo->delete($blogCategories->id);
        $this->assertTrue($resp);
        $this->assertNull(BlogCategories::find($blogCategories->id), 'BlogCategories should not exist in DB');
    }
}
