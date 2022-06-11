<?php

use GuardsmanPanda\Larabear\Infrastructure\Database\Service\BearMigrationService;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create(table: 'bear_user_access_token', callback: static function (Blueprint $table) {
            $config = Config::get(key: 'bear.user_table');
            if ($config === null) {
                throw new RuntimeException(message: 'bear.user_table is not configured, run "php artisan bear" to fix this problem.');
            }

            if (DB::getPdo()->getAttribute(PDO::ATTR_DRIVER_NAME) === 'pgsql') {
                $table->uuid(column: 'id')->primary()->default(DB::raw('gen_random_uuid()'));
            } else {
                $table->uuid(column: 'id')->primary()->default(DB::raw('uuid()'));
            }
            BearMigrationService::buildUserReferencingColumn(
                table: $table,
                columnName: 'user_id',
                userTableName: $config['name'],
                userTableColumnName: $config['column'],
                columnType: $config['primary_key_type'],
            );
            $table->timestampTz(column: 'expires_at');
            $table->timestampTz(column: 'invalid_at');
            if (DB::getPdo()->getAttribute(PDO::ATTR_DRIVER_NAME) === 'pgsql') {
                $table->text(column: 'hashed_access_token')->index();
            } else {
                $table->string(column: 'hashed_access_token')->index();
            }
            $table->timestampTz(column: 'created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
        });
    }

    public function down(): void {
        Schema::dropIfExists('bear_user_access_token');
    }
};
