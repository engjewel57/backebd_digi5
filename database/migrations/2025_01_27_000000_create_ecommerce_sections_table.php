<?php
// database/migrations/2025_01_27_000000_create_ecommerce_sections_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ecommerce_hero_sections', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('subtitle');
            $table->text('description');
            $table->string('cta1_text');
            $table->string('cta2_text');
            $table->json('stats');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('ecommerce_features', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->string('icon');
            $table->string('gradient');
            $table->string('icon_bg');
            $table->integer('display_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('ecommerce_process_steps', function (Blueprint $table) {
            $table->id();
            $table->string('step_number');
            $table->string('title');
            $table->text('description');
            $table->string('gradient');
            $table->string('icon_bg');
            $table->integer('display_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('ecommerce_demo_projects', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->string('image_url');
            $table->string('gradient');
            $table->integer('display_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('ecommerce_clients', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('domain');
            $table->integer('display_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ecommerce_clients');
        Schema::dropIfExists('ecommerce_demo_projects');
        Schema::dropIfExists('ecommerce_process_steps');
        Schema::dropIfExists('ecommerce_features');
        Schema::dropIfExists('ecommerce_hero_sections');
    }
};