<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->timestamp('admin_seen_at')->nullable()->after('email_sent_at');
            $table->timestamp('user_seen_at')->nullable()->after('admin_seen_at');
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['admin_seen_at', 'user_seen_at']);
        });
    }
};
