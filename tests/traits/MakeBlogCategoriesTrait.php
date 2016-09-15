<?php

use Faker\Factory as Faker;
use App\Models\BlogCategories;
use App\Repositories\BlogCategoriesRepository;

trait MakeBlogCategoriesTrait
{
    /**
     * Create fake instance of BlogCategories and save it in database
     *
     * @param array $blogCategoriesFields
     * @return BlogCategories
     */
    public function makeBlogCategories($blogCategoriesFields = [])
    {
        /** @var BlogCategoriesRepository $blogCategoriesRepo */
        $blogCategoriesRepo = App::make(BlogCategoriesRepository::class);
        $theme = $this->fakeBlogCategoriesData($blogCategoriesFields);
        return $blogCategoriesRepo->create($theme);
    }

    /**
     * Get fake instance of BlogCategories
     *
     * @param array $blogCategoriesFields
     * @return BlogCategories
     */
    public function fakeBlogCategories($blogCategoriesFields = [])
    {
        return new BlogCategories($this->fakeBlogCategoriesData($blogCategoriesFields));
    }

    /**
     * Get fake data of BlogCategories
     *
     * @param array $postFields
     * @return array
     */
    public function fakeBlogCategoriesData($blogCategoriesFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $blogCategoriesFields);
    }
}
