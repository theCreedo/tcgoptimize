<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('tcgplayer_username')->nullable()->after('email');
            $table->string('discord_username')->nullable()->after('tcgplayer_username');
            $table->enum('preferred_currency', ['USD', 'CAD', 'EUR', 'GBP'])->default('USD')->after('discord_username');
            $table->string('timezone', 50)->default('UTC')->after('preferred_currency');
            $table->boolean('email_notifications')->default(true)->after('timezone');
            $table->enum('seller_level', ['casual', 'semi_pro', 'professional'])->default('casual')->after('email_notifications');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'tcgplayer_username',
                'discord_username',
                'preferred_currency',
                'timezone',
                'email_notifications',
                'seller_level'
            ]);
        });
    }
};
