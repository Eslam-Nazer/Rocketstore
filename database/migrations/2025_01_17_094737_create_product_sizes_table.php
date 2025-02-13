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
        Schema::create('product_sizes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id')
                ->nullable();
            $table->foreign('product_id')
                ->references('id')
                ->on('products')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->string('size')
                ->nullable();
            $table->float('price')
                ->default(0.000);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_sizes');
    }
};
