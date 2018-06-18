<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ResearchParticipant extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('research_participant', function (Blueprint $table) {
            $table->unsignedInteger('research_id');
            $table->unsignedInteger('participant_id');
            $table->primary(['research_id', 'participant_id']);
            $table->enum('role', ['leader', 'researcher', 'student'])->default('student');
            $table->mediumText('assigment');

            $table->timestamps();

            $table->foreign('research_id')
                ->references('id')->on('researches')
                ->onDelete('cascade');
            $table->foreign('participant_id')
                ->references('id')->on('participants')
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
        Schema::dropIfExists('research_participant');
    }
}
