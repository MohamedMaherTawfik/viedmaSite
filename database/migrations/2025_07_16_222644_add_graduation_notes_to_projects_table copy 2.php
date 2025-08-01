<?php

use App\Models\assignment_submission;
use App\Models\graduationNotes;
use App\Models\graduationProject;
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
        Schema::table('graduation_notes', function (Blueprint $table) {
            $table->foreignIdFor(User::class, 'uploaded_teacher_id')->nullable()->constrained()->cascadeOnDelete();
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
