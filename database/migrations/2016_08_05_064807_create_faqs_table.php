<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class CreateFaqsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Model::unguard();
        Schema::create('faqs',function(Blueprint $table){
            $table->increments("id");
            $table->string("question");
            $table->string("answer");
            $table->integer("faqcategories_id")->references("id")->on("faqcategories");
            $table->string("position")->nullable();
            $table->string("attachment")->nullable();
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
        Schema::drop('faqs');
    }

}