<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostTmpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_tmps', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('reason', 255);
            $table->string('rows', 255)->default("-1");
            $table->integer('soPostId')->unsigned()->unique();
            $table->boolean('imported')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post_tmps');
    }
}
