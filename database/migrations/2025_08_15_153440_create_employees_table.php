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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            
            // Foreign key ke tabel users
            $table->foreignId('employee_id')
                ->constrained('users')
                ->onDelete('cascade');

            // Foreign key ke tabel departements
            $table->foreignId('departement_id')
                ->constrained('departements')
                ->onDelete('cascade');

            $table->string('address')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
