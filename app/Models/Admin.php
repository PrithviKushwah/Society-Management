<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;

class Admin extends Model implements \Illuminate\Contracts\Auth\Authenticatable
{
    use Authenticatable;
    protected $table = 'admins';
    use HasFactory;
    protected $fillable = [
        'uuid',
        'name',
        'email',
        'password',
        'phone',
        'role'
    ];
}
