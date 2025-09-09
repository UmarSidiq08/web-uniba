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
        Schema::table('pendaftars', function (Blueprint $table) {
            $table->text('rejection_reason')->nullable()->after('status');
            $table->boolean('can_resubmit')->default(false)->after('rejection_reason');
            $table->timestamp('rejected_at')->nullable()->after('can_resubmit');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pendaftars', function (Blueprint $table) {
            $table->dropColumn(['rejection_reason', 'can_resubmit', 'rejected_at']);
        });
    }
};
