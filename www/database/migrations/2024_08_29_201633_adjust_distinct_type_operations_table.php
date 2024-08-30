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
        Schema::table('type_operations', function (Blueprint $table) {
            $table->renameColumn('type_id', 'payer_type_id');
            $table->foreignId('payee_type_id')->default(1)->constrained('user_types');
            $table->renameColumn('send', 'enabled');
            $table->dropColumn('receive');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('type_operations', function (Blueprint $table) {
            $table->renameColumn('payer_type_id', 'type_id');
            $table->dropColumn('payee_type_id');
        });
    }
};
