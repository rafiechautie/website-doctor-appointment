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
        Schema::table('appointments', function (Blueprint $table) {
            //
            $table->foreign('doctor_id', 'fk_appointments_to_doctors')
                ->references('id')->on('doctors')->onDelete('CASCADE')
                ->onUpdate('CASCADE');
            $table->foreign('user_id', 'fk_appointments_to_users')
                ->references('id')->on('users')->onDelete('CASCADE')
                ->onUpdate('CASCADE');
            $table->foreign('consultation_id', 'fk_appointments_to_consultations')
                ->references('id')->on('consultations')->onDelete('CASCADE')
                ->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('appointments', function (Blueprint $table) {
            //
            $table->dropForeign('fk_appointments_to_doctors');
            $table->dropForeign('fk_appointments_to_users');
            $table->dropForeign('fk_appointments_to_consultations');
        });
    }
};
