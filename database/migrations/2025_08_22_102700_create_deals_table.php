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
        Schema::create('deals', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->text('short_description')->nullable();
            $table->decimal('original_price', 10, 2);
            $table->decimal('deal_price', 10, 2);
            $table->integer('discount_percentage')->nullable();
            $table->string('image')->nullable();
            $table->string('category')->default('general');
            $table->datetime('start_date');
            $table->datetime('end_date');
            $table->enum('status', ['active', 'inactive', 'expired'])->default('active');
            $table->string('merchant_name')->nullable();
            $table->string('merchant_website')->nullable();
            $table->text('terms_conditions')->nullable();
            $table->integer('view_count')->default(0);
            $table->boolean('featured')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deals');
    }
};
