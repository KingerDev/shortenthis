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
        Schema::create('url_clicks', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(\App\Models\Url::class, 'url_id')
                ->constrained('urls')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->string('user_agent')->nullable();

            $table->enum('type', ['qr', 'click']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('url_clicks');
    }
};
