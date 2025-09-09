<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // database/migrations/xxxx_drop_academic_fields_from_pendaftars_table.php
public function up()
{
    Schema::table('pendaftars', function (Blueprint $table) {
        $table->dropColumn(['fakultas', 'jurusan', 'semester', 'ipk']);
    });
}

public function down()
{
    Schema::table('pendaftars', function (Blueprint $table) {
        $table->string('fakultas');
        $table->string('jurusan');
        $table->integer('semester');
        $table->decimal('ipk', 3, 2);
    });
}
};
