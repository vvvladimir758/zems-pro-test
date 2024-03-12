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
        Schema::table('tasks_time_spent', function (Blueprint $table) {
            $table->dateTime('start')->nullable();
            $table->dateTime('stop')->nullable();
            $table->string('type')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tasks_time_spent', function (Blueprint $table) {
            $table->dropColumn('start');
            $table->dropColumn('stop');
            $table->dropColumn('type');
        });
    }
};
