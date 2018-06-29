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
            $table->string('slug')->unique();
            $table->mediumText('bio');
            $table->string('link');

            $table->timestamps();

            $table->unsignedInteger('user_id')->nullable();

            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade');

            $table->string('degree_slug')->nullable();

            $table->foreign('degree_slug')
                ->references('slug')->on('degrees')
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
        Schema::dropIfExists('participants');
    }
}
