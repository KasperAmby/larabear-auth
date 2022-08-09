<?php

use GuardsmanPanda\Larabear\Infrastructure\Database\Service\BearDBService;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create(table: 'bear_oauth2_client', callback: static function (Blueprint $table) {
            if (BearDBService::defaultConnectionDriver() === 'pgsql') {
                $table->uuid(column: 'id')->primary();
                $table->text(column: 'oauth2_client_slug');
                $table->text(column: 'oauth2_client_description');
                $table->text(column: 'oauth2_client_type');
                $table->text(column: 'oauth2_client_id');
                $table->text(column: 'api_base_uri')->nullable();
                $table->text(column: 'oauth2_client_scope')->nullable();
                $table->text(column: 'oauth2_authorize_uri');
                $table->text(column: 'oauth2_token_uri');
                $table->text(column: 'encrypted_oauth2_client_secret');
            } else {
                $table->uuid(column: 'id')->primary();
                $table->string(column: 'oauth2_client_slug');
                $table->string(column: 'oauth2_client_description');
                $table->string(column: 'oauth2_client_type');
                $table->string(column: 'oauth2_client_id');
                $table->string(column: 'api_base_uri')->nullable();
                $table->string(column: 'oauth2_client_scope')->nullable();
                $table->string(column: 'oauth2_authorize_uri');
                $table->string(column: 'oauth2_token_uri');
                $table->string(column: 'encrypted_oauth2_client_secret');
            }
            $table->timestampTz(column: 'oauth2_client_access_token_expires_at')->nullable();
            $table->text(column: 'encrypted_oauth2_client_access_token')->nullable();
            $table->timestampTz(column: 'created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestampTz(column: 'updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));
        });
    }

    public function down(): void {
        Schema::dropIfExists('bear_oauth2_client');
    }
};
