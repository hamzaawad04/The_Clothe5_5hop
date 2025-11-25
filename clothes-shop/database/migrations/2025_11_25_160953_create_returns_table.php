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
        Schema::create('returns', function (Blueprint $table) {
            $table->unsignedBigInteger('order_id');
            $table->enum('status', ['requested', 'approved', 'received', 'refunded']);
            $table->text('reason_text')->nullable();
            $table->timestamps();

            //  Constraints
            
            /**
             *  Primary Key (order_id)
             */

            $table->primary('order_id');


            /**
             *  Foreign Key (order_id)
             */

            $table->foreign('order_id')->references('order_id')
            ->on('orders')
            ->onUpdate('cascade')
            ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('returns');
    }
};
