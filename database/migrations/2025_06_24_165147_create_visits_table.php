<?php

use App\Models\Tenant;
use App\Models\User;
use App\Models\Visitor;
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
        Schema::create('visits', function (Blueprint $table) {
            $table->id();
            $table->string('name');
    
            $table->timestamps();

            $table->foreignIdFor(Tenant::class);
            $table->foreignIdFor(User::class);
            $table->foreignIdFor(Visitor::class);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visits');
    }
};
