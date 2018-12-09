<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommunityAwardsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('community_awards', function (Blueprint $table) {
            $table->increments('id');
            $table->string('awardable_type');
            $table->unsignedInteger('awardable_id');
            $table->unsignedInteger('forum_id');
            $table->timestamps();
        });

        Schema::create('mship_account_award', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('account_id');
            $table->unsignedInteger('award_id');
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
        Schema::dropIfExists('community_awards');
        Schema::dropIfExists('mship_account_awards');
    }
}
