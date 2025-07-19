<?php

use App\Models\graduationNotes;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('graduation_notes', function (Blueprint $table) {
            $table->foreignIdFor(graduationNotes::class)
                ->nullable()
                ->constrained('graduation_notes')
                ->nullOnDelete()
                ->after('some_column'); // Replace 'some_column' with the actual column after which you want to add the foreign key
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('graduation_notes', function (Blueprint $table) {
            //
        });
    }
};
