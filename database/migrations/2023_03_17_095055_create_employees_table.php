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
            $table->integer('department_id');
            $table->string('full_name');
            $table->string('photo');
            $table->string('address');
            $table->string('mobile');
            $table->string('email')->nullable(); // Add the 'email' column
            $table->string('status');
            $table->timestamps();
        });
        
    }

    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
