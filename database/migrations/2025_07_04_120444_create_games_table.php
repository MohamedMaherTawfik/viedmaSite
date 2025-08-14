<?php

use App\Models\gamesCategorey;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();
            $table->string('title')->unique();
            $table->string('description');
            $table->double('price');
            $table->double('discount')->default(0);
            $table->string('release_date')->nullable();
            $table->string('developer_name')->nullable();
            $table->string('cover_image');
            $table->string('platform')->nullable();
            $table->string('trailer_url')->nullable();
            $table->integer('stock')->default(0);
            $table->boolean('is_active')->default(false);
            $table->string('slug');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('games');
    }
};
