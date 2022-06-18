<?php

use GuardsmanPanda\Larabear\Infrastructure\Database\Service\BearMigrationService;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create(table: 'bear_user_role', callback: static function (Blueprint $table): void {
            BearMigrationService::buildUserReferencingColumn(table: $table, columnName: 'user_id', nullable: false);
            if (DB::getPdo()->getAttribute(PDO::ATTR_DRIVER_NAME) === 'pgsql') {
                $table->text(column: 'role_slug');
            } else {
                $table->string(column: 'role_slug');
            }
            $table->timestampTz(column: 'created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->primary(columns: ['user_id', 'role_slug']);
            $table->foreign('role_slug')->references('role_slug')->on('bear_role');
        });
    }

    public function down(): void {
        Schema::dropIfExists('bear_user_role');
    }
};
