<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResearchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('researches', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug');
            $table->unique('slug');

            $table->string('title');
            $table->mediumText('abstract');
            
            $table->enum('status', ['created', 'started', 'completed'])->default('created');
            $table->mediumText('subject');
            
            $table->longText('description');
            $table->text('extra_info');
            
            $table->dateTime('completed_at')->nullable(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('researches');
    }
}
