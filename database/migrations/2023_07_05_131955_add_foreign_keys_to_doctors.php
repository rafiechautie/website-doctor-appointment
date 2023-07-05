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
        Schema::table('doctors', function (Blueprint $table) {
            //
            $table->foreign('specialist_id', 'fk_doctors_to_specialist')
                ->references('id')->on('specialist')->onDelete('CASCADE')
                ->onUpdate('CASCADE');
            $table->foreign('user_id', 'fk_doctors_to_users')
                ->references('id')->on('users')->onDelete('CASCADE')
                ->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('doctors', function (Blueprint $table) {
            //
            $table->dropForeign('fk_doctors_to_specialist');
            $table->dropForeign('fk_doctors_to_users');
        });
    }
};
