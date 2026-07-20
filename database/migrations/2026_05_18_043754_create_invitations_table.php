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
        Schema::create('invitations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('theme_id')->constrained()->cascadeOnDelete();
            $table->string('slug')->unique();
            
            // Groom (Mempelai Pria)
            $table->string('groom_name');
            $table->string('groom_nickname')->nullable();
            $table->string('groom_father')->nullable();
            $table->string('groom_mother')->nullable();
            $table->string('groom_photo')->nullable();
            
            // Bride (Mempelai Wanita)
            $table->string('bride_name');
            $table->string('bride_nickname')->nullable();
            $table->string('bride_father')->nullable();
            $table->string('bride_mother')->nullable();
            $table->string('bride_photo')->nullable();
            
            // Event Details (Acara)
            $table->date('event_date');
            $table->string('event_time');
            $table->string('event_location');
            $table->text('event_address');
            $table->text('event_map_url')->nullable();
            
            // Background Music
            $table->string('music_url')->nullable();
            
            // Assets / Extra
            $table->json('gallery')->nullable();
            $table->json('story')->nullable();
            $table->json('gift_accounts')->nullable();
            
            // Status & Billing
            $table->string('status')->default('draft'); // 'draft', 'active', 'inactive'
            $table->string('plan')->default('free'); // 'free', 'premium'
            $table->timestamp('active_until')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invitations');
    }
};
