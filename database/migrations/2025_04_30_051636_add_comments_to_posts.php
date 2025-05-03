<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Models\Post;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::table('posts', function (Blueprint $table) {
            $table->string('slug')->nullable()->change();
            $table->foreignIdFor(Post::class, 'parent_post_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::table('posts', function (Blueprint $table) {
            $table->string('slug')->nullable(false)->change();
            $table->dropIfExists('parent_post_id');
        });
    }
};
