<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class AlterUsersRoleAddGestor extends Migration
{
    public function up()
    {
        // Altera o enum, incluindo 'gestor'
        DB::statement("
            ALTER TABLE `users`
            MODIFY `role` ENUM('normal','gestor','admin')
            NOT NULL DEFAULT 'normal'
        ");
    }

    public function down()
    {
        // Volta ao enum só com 'normal' e 'admin'
        DB::statement("
            ALTER TABLE `users`
            MODIFY `role` ENUM('normal','admin')
            NOT NULL DEFAULT 'normal'
        ");
    }
}

