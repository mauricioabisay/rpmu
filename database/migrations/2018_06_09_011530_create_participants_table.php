<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParticipantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('participants', function (Blueprint $table) {
            $table->unsignedInteger('id');
            $table->primary('id');
            
            $table->string('name');
            $table->mediumText('bio');
            $table->string('link');

            $table->timestamps();

            $table->unsignedInteger('user_id')->default(0);
            $table->string('faculty_slug')->default('');            

            $table->string('degree_slug')->default('');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('participants');
    }
}
