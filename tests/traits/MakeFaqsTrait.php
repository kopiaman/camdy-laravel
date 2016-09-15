<?php

use Faker\Factory as Faker;
use App\Models\Faqs;
use App\Repositories\FaqsRepository;

trait MakeFaqsTrait
{
    /**
     * Create fake instance of Faqs and save it in database
     *
     * @param array $faqsFields
     * @return Faqs
     */
    public function makeFaqs($faqsFields = [])
    {
        /** @var FaqsRepository $faqsRepo */
        $faqsRepo = App::make(FaqsRepository::class);
        $theme = $this->fakeFaqsData($faqsFields);
        return $faqsRepo->create($theme);
    }

    /**
     * Get fake instance of Faqs
     *
     * @param array $faqsFields
     * @return Faqs
     */
    public function fakeFaqs($faqsFields = [])
    {
        return new Faqs($this->fakeFaqsData($faqsFields));
    }

    /**
     * Get fake data of Faqs
     *
     * @param array $postFields
     * @return array
     */
    public function fakeFaqsData($faqsFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $faqsFields);
    }
}
