<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIssuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('issues', function (Blueprint $table) {
            $table->id();
            $table->text('description');
            $table->text('os');
            $table->text('version');
            $table->text('steps_to_reproduce');
            $table->text('extra_infos')->nullable();
            $table->text('user_discord_id')->nullable();
            $table->text('github_link')->nullable();
            $table->unsignedBigInteger('status_id');
            $table->foreign('status_id')->references('id')->on('issue_statuses');
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('issue_categories');
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
        Schema::dropIfExists('issues');
    }
}
