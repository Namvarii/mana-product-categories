<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->unsignedTinyInteger('level')->default(0);
            $table->unsignedBigInteger('parent_id')->nullable()->default(null);
            $table->foreign('parent_id')->references('id')->on('categories')
                ->onUpdate('cascade')->onDelete('set null');
            $table->string('slug');
            $table->string('title');
            $table->text('desc');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
