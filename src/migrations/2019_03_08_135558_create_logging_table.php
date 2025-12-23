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
        Schema::create('logging', function (Blueprint $table) {
            $table->id();
            $table->string('table', 100);
            $table->unsignedBigInteger('row_id')->nullable();
            $table->text('before')->nullable();
            $table->text('after')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('action', 100);
            $table->timestamps();
            
            $table->index(['table', 'row_id']);
            $table->index('action');
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('logging');
    }
};
