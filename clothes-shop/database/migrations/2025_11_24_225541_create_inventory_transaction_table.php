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
        Schema::create('inventory_transaction', function (Blueprint $table) {
            $table->id('transaction_id');
            $table->unsignedBigInteger('variant_id');
            $table->integer('change_qty');
            $table->enum('reason', ['sale', 'restock', 'return', 'adjustment', 'incoming_order']);
            $table->timestamps();

            //  Constraints

            /**
             *  Foreign Key (variant_id)
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
        Schema::dropIfExists('inventory_transaction');
    }
};
