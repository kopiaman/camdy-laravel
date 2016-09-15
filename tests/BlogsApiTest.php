<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class BlogsApiTest extends TestCase
{
    use MakeBlogsTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateBlogs()
    {
        $blogs = $this->fakeBlogsData();
        $this->json('POST', '/api/v1/blogs', $blogs);

        $this->assertApiResponse($blogs);
    }

    /**
     * @test
     */
    public function testReadBlogs()
    {
        $blogs = $this->makeBlogs();
        $this->json('GET', '/api/v1/blogs/'.$blogs->id);

        $this->assertApiResponse($blogs->toArray());
    }

    /**
     * @test
     */
    public function testUpdateBlogs()
    {
        $blogs = $this->makeBlogs();
        $editedBlogs = $this->fakeBlogsData();

        $this->json('PUT', '/api/v1/blogs/'.$blogs->id, $editedBlogs);

        $this->assertApiResponse($editedBlogs);
    }

    /**
     * @test
     */
    public function testDeleteBlogs()
    {
        $blogs = $this->makeBlogs();
        $this->json('DELETE', '/api/v1/blogs/'.$blogs->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/blogs/'.$blogs->id);

        $this->assertResponseStatus(404);
    }
}
