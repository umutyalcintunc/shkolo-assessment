<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('buttons', function (Blueprint $table) {
            $table->id();
            $table->string('label'); // Button label
            $table->string('color')->nullable(); // Button color (e.g., red-500)
            $table->string('link')->nullable(); // Button hyperlink
            $table->foreignId('user_id') // Link button to a user
            ->constrained()
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('buttons');
    }

};
