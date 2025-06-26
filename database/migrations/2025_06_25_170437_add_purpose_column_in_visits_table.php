<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('visits', function (Blueprint $table) {
            $table->text("purpose");
            $table->string("time_in");
            $table->string("time_out");
            $table->dropColumn("name");
        });
        // le fait que le terminal t'ai envoyé à la ligne te permet d'écrire tranquilement
        // make time out column nullable and change its type to timestamp in visits table
        // lui-même se chargera de mettre les _
    }

    public function down(): void
    {
        Schema::table('visits', function (Blueprint $table) {
            $table->dropColumn("purpose");
            $table->dropColumn("time_in");
            $table->dropColumn("time_out");
            $table->string("name")->nullable();
        });
    }
};
