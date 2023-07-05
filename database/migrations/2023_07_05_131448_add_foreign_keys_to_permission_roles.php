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
        Schema::table('permission_roles', function (Blueprint $table) {
            //
            $table->foreign('permission_id', 'fk_permission_roles_to_permissions')
                ->references('id')->on('permissions')->onDelete('CASCADE')
                ->onUpdate('CASCADE');
            $table->foreign('role_id', 'fk_permission_roles_to_roles')
                ->references('id')->on('roles')->onDelete('CASCADE')
                ->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('permission_roles', function (Blueprint $table) {
            //
            $table->dropForeign('fk_permission_roles_to_permissions');
            $table->dropForeign('fk_permission_roles_to_roles');
        });
    }
};
