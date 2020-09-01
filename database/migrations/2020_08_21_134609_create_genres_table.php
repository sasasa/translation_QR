<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGenresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('genres', function (Blueprint $table) {
            $table->id();
            // 言語
            $table->string('lang')->index();
            // 名前
            $table->string('genre_name');
            // URLのkey
            $table->string('genre_key');
            // 表示順(降順)
            $table->integer('genre_order')->default(1);
            // 親
            $table->biginteger('parent_id')->nullable()->index();

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
        Schema::dropIfExists('genres');
    }
}
