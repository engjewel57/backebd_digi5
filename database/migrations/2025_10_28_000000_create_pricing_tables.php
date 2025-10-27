<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pricing_plans', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->enum('type', ['monthly', 'annual'])->default('monthly');
            $table->string('subtitle', 255)->nullable();
            $table->decimal('price', 10, 2);
            $table->string('price_unit', 20)->default('BDT');
            $table->string('price_period', 20)->default('/month');
            $table->string('discount_info', 255)->nullable();
            $table->json('features');
            $table->boolean('is_popular')->default(false);
            $table->integer('display_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('extra_services', function (Blueprint $table) {
            $table->id();
            $table->string('title', 100);
            $table->text('description')->nullable();
            $table->decimal('price', 10, 2);
            $table->string('unit', 50)->default('/month');
            $table->boolean('is_active')->default(true);
            $table->integer('display_order')->default(0);
            $table->timestamps();
        });

        Schema::create('plan_comparisons', function (Blueprint $table) {
            $table->id();
            $table->string('feature_name', 100);
            $table->string('starter_value', 100)->nullable();
            $table->string('professional_value', 100)->nullable();
            $table->string('enterprise_value', 100)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('plan_comparisons');
        Schema::dropIfExists('extra_services');
        Schema::dropIfExists('pricing_plans');
    }
};