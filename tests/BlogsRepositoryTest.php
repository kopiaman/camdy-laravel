<?php

use App\Models\Blogs;
use App\Repositories\BlogsRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class BlogsRepositoryTest extends TestCase
{
    use MakeBlogsTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var BlogsRepository
     */
    protected $blogsRepo;

    public function setUp()
    {
        parent::setUp();
        $this->blogsRepo = App::make(BlogsRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateBlogs()
    {
        $blogs = $this->fakeBlogsData();
        $createdBlogs = $this->blogsRepo->create($blogs);
        $createdBlogs = $createdBlogs->toArray();
        $this->assertArrayHasKey('id', $createdBlogs);
        $this->assertNotNull($createdBlogs['id'], 'Created Blogs must have id specified');
        $this->assertNotNull(Blogs::find($createdBlogs['id']), 'Blogs with given id must be in DB');
        $this->assertModelData($blogs, $createdBlogs);
    }

    /**
     * @test read
     */
    public function testReadBlogs()
    {
        $blogs = $this->makeBlogs();
        $dbBlogs = $this->blogsRepo->find($blogs->id);
        $dbBlogs = $dbBlogs->toArray();
        $this->assertModelData($blogs->toArray(), $dbBlogs);
    }

    /**
     * @test update
     */
    public function testUpdateBlogs()
    {
        $blogs = $this->makeBlogs();
        $fakeBlogs = $this->fakeBlogsData();
        $updatedBlogs = $this->blogsRepo->update($fakeBlogs, $blogs->id);
        $this->assertModelData($fakeBlogs, $updatedBlogs->toArray());
        $dbBlogs = $this->blogsRepo->find($blogs->id);
        $this->assertModelData($fakeBlogs, $dbBlogs->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteBlogs()
    {
        $blogs = $this->makeBlogs();
        $resp = $this->blogsRepo->delete($blogs->id);
        $this->assertTrue($resp);
        $this->assertNull(Blogs::find($blogs->id), 'Blogs should not exist in DB');
    }
}
