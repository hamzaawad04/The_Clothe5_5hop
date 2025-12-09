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
        Schema::create('wishlist', function (Blueprint $table) {
            $table->id('wishlist_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('variant_id')->nullable();
            $table->text('note')->nullable();
            $table->timestamps();

            //  Constraints

            /**
             *  Key (idx_wishlist_user_product_variant (user_id, product_id, variant_id)
             */

            $table->index(['user_id', 'product_id', 'variant_id'], 'idx_wishlist_user_product_variant');


            /**
             *  Foreign Key (user_id)
             */

            $table->foreign('user_id')->references('user_id')
            ->on('users')
            ->onUpdate('cascade')
            ->onDelete('cascade');


            /**
             *  Foreign Key (product_id)
             */

            $table->foreign('product_id')->references('product_id')
            ->on('products')
            ->onUpdate('cascade')
            ->onDelete('cascade');


            /**
             *  Foreign Key (variant_id)
             */

            $table->foreign('variant_id')->references('product_variant_id')
            ->on('product_variants')
            ->onUpdate('cascade')
            ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wishlist');
    }
};
