<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class CreateBlogsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Model::unguard();
        Schema::create('blogs',function(Blueprint $table){
            $table->increments("id");
            $table->string("title");
            $table->date("date_posted")->nullable();
            $table->text("content");
            $table->integer("blogcategories_id")->references("id")->on("blogcategories");
            $table->string("meta_keyword")->nullable();
            $table->string("meta_description")->nullable();
            $table->string("photo_main")->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('blogs');
    }

}