<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('yoga_classes', 'instructor')) {
            Schema::table('yoga_classes', function (Blueprint $table) {
                $table->string('instructor', 100)->nullable()->after('description');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('yoga_classes', 'instructor')) {
            Schema::table('yoga_classes', function (Blueprint $table) {
                $table->dropColumn('instructor');
            });
        }
    }
};
