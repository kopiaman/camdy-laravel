<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;


use Illuminate\Database\Eloquent\SoftDeletes;

class FaqCategories extends Model {

    use SoftDeletes;

    /**
    * The attributes that should be mutated to dates.
    *
    * @var array
    */
    protected $dates = ['deleted_at'];

    protected $table    = 'faqcategories';
    
    protected $fillable = [
          'name',
          'position'
    ];
    

    public static function boot()
    {
        parent::boot();

        FaqCategories::observe(new UserActionsObserver);
    }
    
    
    
    
}