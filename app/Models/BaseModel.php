<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
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
