<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;


use Illuminate\Database\Eloquent\SoftDeletes;

class Faqs extends Model {

    use SoftDeletes;

    /**
    * The attributes that should be mutated to dates.
    *
    * @var array
    */
    protected $dates = ['deleted_at'];

    protected $table    = 'faqs';
    
    protected $fillable = [
          'question',
          'answer',
          'faqcategories_id',
          'position',
          'attachment'
    ];
    

    public static function boot()
    {
        parent::boot();

        Faqs::observe(new UserActionsObserver);
    }
    
    public function faqcategories()
    {
        return $this->hasOne('App\FaqCategories', 'id', 'faqcategories_id');
    }


    
    
    
}