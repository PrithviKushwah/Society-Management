<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyModel extends Model
{
    use HasFactory;
    protected $table = 'properties';
    protected $fillable = [
        'uuid',
        'user_id',
        'block_no',
        'floor_no',
        'flat_no',
        'area',
        'registry',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
