<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class UserModel extends Authenticatable
{
    use HasFactory;

    protected $table = 'm_user';
    protected $primaryKey = 'user_id';
    protected $fillable = [
        'username', 
        'password', 
        'nama', 
        'role', 
        'remember_token',
        'created_at', 
        'updated_at'
    ];

    protected $hidden = ['password'];
    protected $casts = ['password' => 'hashed'];

    // Jika ingin menggunakan username sebagai field login
    public function getAuthIdentifierName()
    {
        return 'username';
    }
}