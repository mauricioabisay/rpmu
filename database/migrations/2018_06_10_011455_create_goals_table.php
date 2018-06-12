<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goals', function (Blueprint $table) {
            $table->increments('id');
            
            $table->string('title');
            $table->mediumText('description');
            $table->boolean('achieve')->default(false);
            
            $table->timestamps();

            $table->unsignedInteger('research_id');
            $table->foreign('research_id')
                ->references('id')->on('researches')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('goals');
    }
}
