<?php

use Faker\Factory as Faker;
use App\Models\Blogs;
use App\Repositories\BlogsRepository;

trait MakeBlogsTrait
{
    /**
     * Create fake instance of Blogs and save it in database
     *
     * @param array $blogsFields
     * @return Blogs
     */
    public function makeBlogs($blogsFields = [])
    {
        /** @var BlogsRepository $blogsRepo */
        $blogsRepo = App::make(BlogsRepository::class);
        $theme = $this->fakeBlogsData($blogsFields);
        return $blogsRepo->create($theme);
    }

    /**
     * Get fake instance of Blogs
     *
     * @param array $blogsFields
     * @return Blogs
     */
    public function fakeBlogs($blogsFields = [])
    {
        return new Blogs($this->fakeBlogsData($blogsFields));
    }

    /**
     * Get fake data of Blogs
     *
     * @param array $postFields
     * @return array
     */
    public function fakeBlogsData($blogsFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $blogsFields);
    }
}
