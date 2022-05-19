<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
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
            $table->float('price');
            $table->float('discount')->default(0);
            $table->boolean('interface')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('product_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id');
            $table->string('name')->nullable();
            $table->text('description')->nullable();

            $table->string('locale')->index();
            $table->unique(['product_id', 'locale']);
            $table->foreign('product_id')->references('id')->on('products')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_translations');
        Schema::dropIfExists('products');
    }
}
