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
        Schema::table('countries', function (Blueprint $table) {
            $table->integer('facebook_daily_budget')->default(0);
            $table->integer('google_daily_budget')->default(0);
            $table->string('google_budget_currency')->nullable();
            $table->string('facebook_budget_currency')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('countries', function (Blueprint $table) {
            $table->dropColumn('facebook_daily_budget');
            $table->dropColumn('google_daily_budget');
            $table->dropColumn('google_budget_currency');
            $table->dropColumn('facebook_budget_currency');
        });
    }
};
