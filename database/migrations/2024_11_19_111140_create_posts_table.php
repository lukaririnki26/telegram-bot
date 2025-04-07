<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sys_posts', function (Blueprint $table) {
            $table->id();
            $table->string('lang')->default('en');
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('excerpt')->nullable();
            $table->text('content')->nullable();
            $table->json('metadata')->nullable();
            $table->json('settings')->nullable();
            $table->timestamp('start_publish')->nullable();
            $table->timestamp('end_publish')->nullable();
            $table->enum('record_visibility', ['PUBLIC', 'READONLY', 'PROTECTED', 'PRIVATE', 'MEMBER_ONLY']);
            $table->string('record_type')->default('post');
            $table->unsignedBigInteger('record_left')->nullable();
            $table->unsignedBigInteger('record_right')->nullable();
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->recordStatus();
            $table->softDeletes();
            $table->userStamps();
            $table->timestamps();

            $table->primary(['id', 'lang']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sys_posts');
    }
};
