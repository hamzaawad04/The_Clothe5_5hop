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
        Schema::create('contact_messages', function (Blueprint $table) {
            $table->id('contact_message_id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->text('message');
            $table->enum('status', ['new', 'in_progress', 'closed']);
            $table->timestamps();

            //  Constraints

            /**
             *  Index (idx_contact_messages_user (user_id))
             */

            $table->index(['user_id'], 'idx_contact_messages_user');


            /**
             *  Foreign Key (user_id)
             */

            $table->foreign('user_id')->references('user_id')
            ->on('users')
            ->onUpdate('cascade')
            ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact_messages');
    }
};
