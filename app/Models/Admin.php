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
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isManager()
    {
        return $this->role === 'Manager';
    }

    public function isBlockManager()
    {
        return $this->role === 'Block Manager';
    }
    protected $fillable = [
        'uuid',
        'name',
        'email',
        'password',
        'phone',
        'role'
    ];
}