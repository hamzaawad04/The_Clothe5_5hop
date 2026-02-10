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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id('order_item_id');
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('variant_id');
            $table->decimal('unit_price', 10, 2);
            $table->integer('qty');
            $table->decimal('line_total', 10, 2);
            $table->timestamps();

            //  Constraint


            /**
             *  Foreign Key (order_id)
             */

            $table->foreign('order_id')->references('order_id')
            ->on('orders')
            ->onUpdate('cascade')
            ->onDelete('restrict');


            /**
             *  Foreign Key (product_id)
             */

            $table->foreign('product_id')->references('product_id')
            ->on('products')
            ->onUpdate('cascade')
            ->onDelete('restrict');


            /**
             *  Foreign Key (variant_id)
             */

            $table->foreign('variant_id')->references('product_variant_id')
            ->on('product_variants')
            ->onUpdate('cascade')
            ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
