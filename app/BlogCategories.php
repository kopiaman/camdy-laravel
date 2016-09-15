<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;


use Illuminate\Database\Eloquent\SoftDeletes;

class BlogCategories extends Model {

    use SoftDeletes;

    /**
    * The attributes that should be mutated to dates.
    *
    * @var array
    */
    protected $dates = ['deleted_at'];

    protected $table    = 'blogcategories';
    
    protected $fillable = [
          'name',
          'position'
    ];
    

    public static function boot()
    {
        parent::boot();

        BlogCategories::observe(new UserActionsObserver);
    }
    
    
    
    
}