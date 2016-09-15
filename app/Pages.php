<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;


use Illuminate\Database\Eloquent\SoftDeletes;

class Pages extends Model {

    use SoftDeletes;

    /**
    * The attributes that should be mutated to dates.
    *
    * @var array
    */
    protected $dates = ['deleted_at'];

    protected $table    = 'pages';
    
    protected $fillable = [
          'title',
          'content',
          'url_route',
          'meta_keyword',
          'meta_description',
          'attachment'
    ];
    

    public static function boot()
    {
        parent::boot();

        Pages::observe(new UserActionsObserver);
    }
    
    
    
    
}