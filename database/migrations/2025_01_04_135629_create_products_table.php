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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title')
                ->nullable();
            $table->string('slug')
                ->nullable();
            $table->double('price')->default(0);
            $table->double('old_price')->default(0);
            $table->text('short_description')
                ->nullable();
            $table->longText('description')
                ->nullable();
            $table->text('additional_information')
                ->nullable();
            $table->text('shipping_returns')
                ->nullable();
            $table->enum('status', ["0", "1"])
                ->comment('[0]: Active, [1]: Inactive')
                ->default('0');
            $table->unsignedBigInteger('sub_category_id')
                ->nullable();
            $table->foreign('sub_category_id')
                ->references('id')
                ->on('sub_categories')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->unsignedBigInteger('category_id')
                ->nullable();
            $table->foreign('category_id')
                ->references('id')
                ->on('categories')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->unsignedBigInteger('created_by');
            $table->foreign('created_by')
                ->references('id')
                ->on('users')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['sub_category_id']);
            $table->dropForeign(['category_id']);
            $table->dropForeign(['created_by']);
        });
        Schema::dropIfExists('products');
    }
};
