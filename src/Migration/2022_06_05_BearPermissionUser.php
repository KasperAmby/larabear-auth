<?php

use GuardsmanPanda\Larabear\Infrastructure\Database\Service\BearMigrationService;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create(table: 'bear_permission_user', callback: static function (Blueprint $table): void {
            if (DB::getPdo()->getAttribute(PDO::ATTR_DRIVER_NAME) === 'pgsql') {
                $table->text(column: 'permission_slug');
            } else {
                $table->string(column: 'permission_slug');
            }
            BearMigrationService::buildUserReferencingColumn(table: $table, columnName: 'user_id', nullable: false);
            $table->timestampTz(column: 'created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->primary(columns: ['permission_slug', 'user_id']);
            $table->foreign('permission_slug')->references('permission_slug')->on('bear_permission');
        });
    }

    public function down(): void {
        Schema::dropIfExists('bear_permission_user');
    }
};
