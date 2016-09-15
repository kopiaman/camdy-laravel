<?php

namespace App\Repositories;

use App\Models\Blogs;
use InfyOm\Generator\Common\BaseRepository;

class BlogsRepository extends BaseRepository
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
        return Blogs::class;
    }
}
