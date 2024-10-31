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
        Schema::create('complains', function (Blueprint $table) {
            $table->id('complain_id');
            $table->foreignId('user_id')->constrained('users', 'user_id');
            $table->foreignId('vehicle_id')->constrained('vehicles', 'vehicle_id');
            $table->text('complain_desc');
            $table->enum('complain_status', ['accepted', 'rejected', 'pending']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('complains');
    }
};
