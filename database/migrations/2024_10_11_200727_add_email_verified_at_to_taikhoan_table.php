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
        Schema::table('taikhoan', function (Blueprint $table) {
            // Thêm trường email_verified_at
            $table->timestamp('email_verified_at')->nullable()->after('password');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('taikhoan', function (Blueprint $table) {
            // Xóa trường email_verified_at
            $table->dropColumn('email_verified_at');
        });
    }
};
