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
        Schema::create('complain_responses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('complain_id')->constrained('complains', 'complain_id');
            $table->text('response');
            $table->date('response_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('complain_responses');
    }
};
