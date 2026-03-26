<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'phone')) {
                $table->string('phone', 20)->nullable()->unique()->after('name');
            }

            if (!Schema::hasColumn('users', 'promo_code')) {
                $table->string('promo_code')->nullable()->after('password');
            }

            if (!Schema::hasColumn('users', 'type')) {
                $table->string('type')->nullable()->after('promo_code');
            }
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $columns = [];

            if (Schema::hasColumn('users', 'type')) {
                $columns[] = 'type';
            }

            if (Schema::hasColumn('users', 'promo_code')) {
                $columns[] = 'promo_code';
            }

            if (Schema::hasColumn('users', 'phone')) {
                $columns[] = 'phone';
            }

            if ($columns !== []) {
                $table->dropColumn($columns);
            }
        });
    }
};
