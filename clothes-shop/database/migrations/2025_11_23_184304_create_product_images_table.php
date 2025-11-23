<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('product_images', function (Blueprint $table) {
            $table->unsignedBigInteger('product_id');
            $table->string('url');
            $table->boolean('is_primary');
            $table->timestamps();

            //  Constraints
            $table->foreign('product_id')->references('product_id')
            ->on('products')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            //  Define composite key
            $table->primary(['product_id', 'url']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_images');
    }
};
