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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->integer('position')->nullable();
            $table->string('title');
            $table->longText('description')->nullable();
            $table->string('image')->nullable(); // Optional image path

            // Enum status: To Do, In Progress, Done
            $table->enum('status', ['to_do', 'in_progress', 'completed'])->default('to_do');
            $table->enum('priority', ['low', 'medium', 'high'])->default('medium');

            // Dates
            $table->date('assigned_date')->nullable();
            $table->date('completed_date')->nullable();

            // Foreign keys (created_by = who created, assigned_to = who will do it)
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade');
            $table->foreignId('assigned_to')->nullable()->constrained('users')->onDelete('set null');
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
