<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAllergenItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('allergen_item', function (Blueprint $table) {
            $table->bigInteger('allergen_id')->unsigned();
            $table->bigInteger('item_id')->unsigned();
            $table->primary(['allergen_id', 'item_id']);
            $table->timestamps();
            //外部キー制約
            $table->foreign('allergen_id')
                ->references('id')
                ->on('allergens')
                ->onDelete('cascade');
            $table->foreign('item_id')
                ->references('id')
                ->on('items')
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
        Schema::dropIfExists('allergen_item');
    }
}
