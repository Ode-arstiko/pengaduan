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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            // penerima notifikasi
            $table->foreignId('user_id')
                  ->constrained('users')
                  ->cascadeOnDelete();

            // notifikasi terkait laporan (boleh null)
            $table->foreignId('report_id')
                  ->nullable()
                  ->constrained('reports')
                  ->nullOnDelete();

            // pengirim notifikasi (boleh null)
            $table->foreignId('sender_id')
                  ->nullable()
                  ->constrained('users')
                  ->nullOnDelete();

            $table->string('title', 200);
            $table->text('message');
            $table->timestamp('created_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
