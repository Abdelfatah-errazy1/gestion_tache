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
        Schema::create('taches', function (Blueprint $table) {
            $table->id();
            $table->string('titre',100);
            $table->text('description');
            $table->date('date_debut');
            $table->date('date_fin');
            $table->date('date_effective');
            $table->enum('priorite',[1,2,3,4,5]);
            $table->enum('statut',[1,2,3,4,5]);
            $table->integer('progress')->default(0);
            $table->foreignId('created_by')->references('id')->on('users')->cascadeOnDelete();
            $table->unsignedBigInteger('project_id')->nullable();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->unsignedBigInteger('assigned_to')->nullable();

            $table->foreign('project_id')->references('id')->on('projects')->onDelete('set null');
            $table->foreign('category_id')->references('id')->on('task_categories')->onDelete('set null');
            $table->foreign('assigned_to')->references('id')->on('users')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('taches');
    }
};
