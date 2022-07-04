<?php

use GuardsmanPanda\Larabear\Infrastructure\Database\Service\BearMigrationService;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create(table: 'bear_oauth2_user', callback: static function (Blueprint $table) {
            if (DB::getPdo()->getAttribute(PDO::ATTR_DRIVER_NAME) === 'pgsql') {
                $table->uuid(column: 'id')->primary();
                $table->text(column: 'oauth2_client_id');
                $table->text(column: 'oauth2_user_identifier');
                $table->text(column: 'oauth2_user_email')->nullable();
                $table->text(column: 'oauth2_user_name')->nullable();
                $table->text(column: 'oauth2_scope');
            } else {
                $table->uuid(column: 'id')->primary();
                $table->string(column: 'oauth2_client_id');
                $table->string(column: 'oauth2_user_identifier');
                $table->string(column: 'oauth2_user_email')->nullable();
                $table->string(column: 'oauth2_user_name')->nullable();
                $table->string(column: 'oauth2_scope');
            }
            BearMigrationService::buildUserReferencingColumn(table: $table, columnName: 'linked_user_id');
            $table->jsonb('oauth2_scope_jsonb');
            $table->timestampTz(column: 'token_refresh_error_at')->nullable();
            $table->text(column: 'token_refresh_error_message')->nullable();
            $table->timestampTz(column: 'user_access_token_expires_at');
            $table->text(column: 'encrypted_user_access_token');
            $table->text(column: 'encrypted_user_refresh_token')->nullable();
            $table->timestampTz(column: 'created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestampTz(column: 'updated_at')->default(DB::raw('CURRENT_TIMESTAMP'))->useCurrentOnUpdate();
        });
    }

    public function down(): void {
        Schema::dropIfExists('bear_oauth2_user');
    }
};
