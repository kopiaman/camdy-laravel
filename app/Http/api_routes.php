<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where all API routes are defined.
|
*/











Route::resource('blogs', 'BlogsAPIController');

Route::resource('faqs', 'FaqsAPIController');

Route::resource('blogCategories', 'BlogCategoriesAPIController');