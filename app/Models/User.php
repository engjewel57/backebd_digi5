<?php

namespace App\Models;
use App\Models\AuthBaseModel;
// use Illuminate\Contracts\Auth\MustVerifyEmail;


class User extends AuthBaseModel
{
   

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'image',

        'created_id',
        'created_type',
        'updated_id',
        'updated_type',
        'deleted_id',
        'deleted_type',

        'create_at',
        'update_at',
        'delete_at',

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'status' => 'integer',
        ];
    }
}
