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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('status_id')->constrained();
            $table->string('category_id');
            $table->string('tag_id');
            $table->string('title');
            $table->string('url_slug');
            $table->string('summary')->nullable();
            $table->longText('description');
            $table->text('featured_image')->nullable();
            $table->boolean('is_featured')->default(0);
            $table->string('meta_title');
            $table->string('meta_description');
            $table->string('meta_keywords')->nullable();
            $table->dateTime('published_at')->nullable();
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->bigInteger('views');
            $table->boolean('is_comment')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
