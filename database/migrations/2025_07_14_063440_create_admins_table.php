<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Http\Traits\AuditColumeTrait;
use App\Models\Admin;
use Illuminate\Database\Eloquent\SoftDeletes;

return new class extends Migration
{
    use AuditColumeTrait , SoftDeletes;
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('image')->nullable();
             $table->tinyInteger('ststus')->default(Admin::STATUS_ACTIVE)->comment(Admin::STATUS_ACTIVE. '=> Active, '.Admin::STATUS_INACTIVE.' => Inactive',Admin::STATUS_PENDING.' => Pending');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();

           $table->softDeletes();
            $this->addAdminAuditColumns($table);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admins');
    }
};
