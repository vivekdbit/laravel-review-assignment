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
        Schema::create('episode_reviews', function (Blueprint $table) {
            $table->id();
            $table->string('title',50)->nullable(false);
            $table->text('review')->nullable(false);
            $table->tinyInteger('rating')->default(0);
            $table->foreignId('user_id')->constrained('users');
            $table->bigInteger('episode_id')->nullable(false);
            $table->enum('status', ['ACTIVE','INACTIVE','DECLINE'])->default('INACTIVE');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        
    }
};
