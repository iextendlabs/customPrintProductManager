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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('drive_link')->nullable();
            $table->string('sku')->nullable();
            $table->string('daraz')->nullable();
            $table->string('decorguys')->nullable();
            $table->string('carstickers')->nullable();
            $table->string('image')->nullable();
            $table->string('artcut_file')->nullable();
            $table->string('other_artcut_file')->nullable();
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
        Schema::dropIfExists('products');
    }
};
