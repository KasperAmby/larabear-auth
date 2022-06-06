<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        $config = Config::get(key: 'bear.user_table');
        if ($config === null) {
            throw new RuntimeException(message: 'bear.user_table is not configured, run "php artisan bear" to fix this problem.');
        }

        Schema::create(table: 'bear_user_permission', callback: static function (Blueprint $table) use ($config): void {
            if ($config['primary_key_type'] === 'uuid') {
                $table->uuid(column: 'user_id')->nullable();
            } else if ($config['primary_key_type'] === 'biginteger') {
                $table->bigInteger(column: 'user_id')->unsigned()->nullable();
            } else if ($config['primary_key_type'] === 'integer') {
                $table->integer(column: 'user_id')->unsigned()->nullable();
            } else {
                $table->text(column: 'user_id')->nullable();
            }
            if (DB::getPdo()->getAttribute(PDO::ATTR_DRIVER_NAME) === 'pgsql') {
                $table->text(column: 'permission_slug');
            } else {
                $table->string(column: 'permission_slug');
            }
            $table->timestampTz(column: 'created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->primary(columns: ['user_id', 'permission_slug']);
            $table->foreign('user_id')->references($config['primary_key_column'])->on($config['table_name']);
            $table->foreign('permission_slug')->references('permission_slug')->on('bear_permission');
        });
    }

    public function down(): void {
        Schema::dropIfExists('bear_user_permission');
    }
};
