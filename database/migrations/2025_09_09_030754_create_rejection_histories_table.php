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
        Schema::create('rejection_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pendaftar_id')->constrained()->onDelete('cascade');
            $table->text('rejection_reason');
            $table->boolean('can_resubmit');
            $table->string('rejected_by')->nullable(); // admin email/name
            $table->timestamp('rejected_at');
            $table->timestamps();

            $table->index(['pendaftar_id', 'rejected_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rejection_histories');
    }
};
