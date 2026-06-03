<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('blogs', function (Blueprint $table) {
            $table->string('status')->default('published')->after('reads');
            $table->timestamp('published_at')->nullable()->after('status');
        });

        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('location')->nullable();
            $table->dateTime('event_date');
            $table->string('image')->nullable();
            $table->boolean('is_published')->default(true);
            $table->timestamps();
        });

        Schema::table('gallery_items', function (Blueprint $table) {
            $table->foreignId('event_id')->nullable()->after('is_published')->constrained()->nullOnDelete();
        });

        Schema::table('contact_messages', function (Blueprint $table) {
            $table->text('admin_reply')->nullable()->after('status');
            $table->timestamp('replied_at')->nullable()->after('admin_reply');
        });
    }

    public function down(): void
    {
        Schema::table('contact_messages', function (Blueprint $table) {
            $table->dropColumn(['admin_reply', 'replied_at']);
        });

        Schema::table('gallery_items', function (Blueprint $table) {
            $table->dropConstrainedForeignId('event_id');
        });

        Schema::dropIfExists('events');

        Schema::table('blogs', function (Blueprint $table) {
            $table->dropColumn(['status', 'published_at']);
        });
    }
};
