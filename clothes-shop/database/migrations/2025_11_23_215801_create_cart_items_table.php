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
        Schema::create('cart_items', function (Blueprint $table) {
            $table->id('cart_item_id');
            $table->unsignedBigInteger('cart_id');
            $table->unsignedBigInteger('variant_id');
            $table->integer('qty');
            $table->timestamps();

            //  Constraints
            /**
             *  cart_id foreign key constraint
             */

            $table->foreign('cart_id')->references('cart_id')
            ->on('carts')
            ->onUpdate('cascade')
            ->onDelete('cascade');


            /**
             *  variant_id foreign key constraint
             */

            $table->foreign('variant_id')->references('variant_id')
            ->on('product_variants')
            ->onUpdate('cascade')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cart_items');
    }
};
