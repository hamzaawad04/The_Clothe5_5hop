<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reviews', function (Blueprint $table) {

            $table->bigIncrements('review_id');

            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('user_id');

            $table->unsignedTinyInteger('rating');
            $table->text('review_text')->nullable();

            $table->timestamps();

            $table->unique(['user_id','product_id']);

            $table->foreign('product_id')
                ->references('product_id')
                ->on('products')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('user_id')
                ->references('user_id')
                ->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
