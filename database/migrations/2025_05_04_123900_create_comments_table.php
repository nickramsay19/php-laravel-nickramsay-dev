<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Models\Post;
use App\Models\Comment;
use App\Models\User;

return new class extends Migration {

    public function up(): void {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignIdFor(Post::class);
            $table->foreignIdFor(Comment::class, 'reference_id')->nullable();
            $table->foreignIdFor(User::class, 'author_id');
            $table->longText('body');
        });
    }

    public function down(): void {
        Schema::dropIfExists('comments');
    }
};
