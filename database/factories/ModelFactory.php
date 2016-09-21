<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});
$factory->define(App\BlogCategories::class, function (Faker\Generator $faker) {
    return [
        'name' =>  $faker->name ,
        'position' => $faker->randomNumber() ,
    ];
});

$factory->define(App\Blogs::class, function (Faker\Generator $faker) {
    return [
        'title' =>  $faker->word ,
        'date_posted' =>  $faker->date() ,
        'content' =>  $faker->text ,
        'blogcategories_id' =>  factory(App\BlogCategories::class)->create()->id,
        'meta_keyword' =>  $faker->word ,
        'meta_description' =>  $faker->word ,
        'photo_main' =>  $faker->word ,
        'description' =>  $faker->text ,
        'slug' =>  $faker->text ,
    ];
});

$factory->define(App\FaqCategories::class, function (Faker\Generator $faker) {
    return [
        'name' =>  $faker->name ,
        'position' => $faker->randomNumber() ,
    ];
});

$factory->define(App\Faqs::class, function (Faker\Generator $faker) {
    return [
        'question' =>  $faker->word ,
        'answer' =>  $faker->word ,
        'faqcategories_id' =>  factory(App\FaqCategories::class)->create()->id,
        'position' =>  $faker->word ,
        'attachment' =>  $faker->word ,
    ];
});

$factory->define(App\Pages::class, function (Faker\Generator $faker) {
    return [
        'title' =>  $faker->word ,
        'content' =>  $faker->text ,
        'url_route' =>  $faker->word ,
        'meta_keyword' =>  $faker->word ,
        'meta_description' =>  $faker->word ,
        'attachment' =>  $faker->word ,
    ];
});


