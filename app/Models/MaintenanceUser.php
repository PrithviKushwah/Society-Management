<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaintenanceUser extends Model
{
    use HasFactory;
    protected $table = 'maintenance';
    protected $fillable = [
        'uuid',
        'month',
        'price',
        'year',
        'type',
        'total_cost',
        'comment',
        'create_by',
        'create_for'
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'create_for', 'id');
    }
    public function admin()
    {
        return $this->belongsTo(Admin::class, 'create_by', 'id');
    }
}

