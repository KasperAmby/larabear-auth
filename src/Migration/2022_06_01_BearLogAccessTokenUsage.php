<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::dropIfExists('bear_access_token_log');
        Schema::create(table: 'bear_log_access_token_usage', callback: static function (Blueprint $table) {
            $table->id();
            $table->ipAddress(column: 'request_ip');
            $table->text(column: 'request_country_code')->nullable();
            $table->text(column: 'request_http_method');
            $table->text(column: 'request_http_path');
            $table->integer(column: 'response_status_code');
            $table->integer(column: 'response_time_in_milliseconds');
            $table->uuid(column: 'access_token_app_id')->nullable();
            $table->uuid(column: 'access_token_user_id')->nullable();
            $table->boolean(column: 'is_processed')->default(false);
            $table->timestampTz(column: 'created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->foreign('access_token_app_id')->references('id')->on('bear_access_token_app');
            $table->foreign('access_token_user_id')->references('id')->on('bear_access_token_user');
        });
    }

    public function down(): void {
        Schema::dropIfExists('bear_log_access_token_usage');
    }
};
