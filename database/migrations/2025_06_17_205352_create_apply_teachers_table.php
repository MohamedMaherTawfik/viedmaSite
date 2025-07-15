<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('apply_teachers', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(user::class)
                ->constrained()
                ->onDelete('cascade');
            $table->string('cv')->nullable();
            $table->string('topic')->nullable();
            $table->string('phone')->nullable();
            $table->string('certificate')->nullable();
            $table->enum('status', ['pending', 'accepted', 'rejected'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('apply_teachers');
    }
};
