<?php

namespace App\Repositories;

use App\Models\Faqs;
use InfyOm\Generator\Common\BaseRepository;

class FaqsRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Faqs::class;
    }
}
