<?php

namespace App\Repositories;

use App\Models\BlogCategories;
use InfyOm\Generator\Common\BaseRepository;

class BlogCategoriesRepository extends BaseRepository
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
        return BlogCategories::class;
    }
}
