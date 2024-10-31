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
        Schema::create('item_assessments', function (Blueprint $table) {
            $table->id('assessment_id');
            $table->foreignId('vendor_id')->constrained('vendors', 'vendor_id');
            $table->foreignId('item_id')->constrained('items', 'item_id');
            $table->integer('assessment_amount');
            $table->enum('assessment_status', ['accepted', 'rejected', 'pending']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item_assessments');
    }
};
