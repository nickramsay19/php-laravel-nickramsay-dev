<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void {
        Schema::table('posts', function (Blueprint $table) {
            $table->boolean('is_listed')->default(true);
        });
    }

    public function down(): void {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropIfExists('is_listed');
        });
    }
};
