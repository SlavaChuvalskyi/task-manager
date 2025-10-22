<?php

use App\Enums\TaskStatus;
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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id()->primary();
            $table->mediumText('title');
            $table->text('description')->nullable(false);

            // ENUM for status
            $table->enum('status', array_column(TaskStatus::cases(), 'value'))
                ->default(TaskStatus::NEW->value);

            $table->foreignIdFor(\App\Models\User::class, "assign_user_id")->nullable()->constrained()->onDelete('cascade');
            $table->foreignIdFor(\App\Models\Project::class)->nullable(false)->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
