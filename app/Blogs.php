<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;

use Carbon\Carbon; 

use Illuminate\Database\Eloquent\SoftDeletes;

class Blogs extends Model {

    use SoftDeletes;

    /**
    * The attributes that should be mutated to dates.
    *
    * @var array
    */
    protected $dates = ['deleted_at'];

    protected $table    = 'blogs';
    
    protected $fillable = [
          'title',
          'date_posted',
          'content',
          'blogcategories_id',
          'meta_keyword',
          'meta_description',
          'photo_main',
          'description'
    ];
    

    public static function boot()
    {
        parent::boot();

        Blogs::observe(new UserActionsObserver);
    }
    
    public function blogcategories()
    {
        return $this->hasOne('App\BlogCategories', 'id', 'blogcategories_id');
    }


    
    /**
     * Set attribute to date format
     * @param $input
     */
    public function setDatePostedAttribute($input)
    {
        if($input != '') {
            $this->attributes['date_posted'] = Carbon::createFromFormat(config('quickadmin.date_format'), $input)->format('Y-m-d');
        }else{
            $this->attributes['date_posted'] = '';
        }
    }

    /**
     * Get attribute from date format
     * @param $input
     *
     * @return string
     */
    public function getDatePostedAttribute($input)
    {
        if($input != '0000-00-00') {
            return Carbon::createFromFormat('Y-m-d', $input)->format(config('quickadmin.date_format'));
        }else{
            return '';
        }
    }


    
}