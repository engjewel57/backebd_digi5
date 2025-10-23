<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class AuthBaseModel extends Authenticatable
{
   use HasFactory, Notifiable;

   public const STATUS_ACTIVE = -1;
   public const STATUS_INACTIVE = 1;
   public const STATUS_PENDING = 0;
   public function creater()
   {
    return $this->morphTo();
   }

   public function updater()
   {
    return $this->morphTo();
   }

   public function deleter()
   {
    return $this->morphTo();
   }

   public function created_by()
   {
    return $this->belongsTo(Admin::class, 'created_by');
   }

   public function updated_by()
   {
    return $this->belongsTo(Admin::class, 'updated_by');
   }

   public function deleted_by()
   {
    return $this->belongsTo(Admin::class, 'deleted_by');
   }
}
