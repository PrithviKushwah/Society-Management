<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailSettingModel extends Model
{
    use HasFactory;
    protected $table = 'email_setting';
    protected $fillable = [
        'uuid',
        'logo',
        'company_name',
        'insta',
        'whatsapp'
    ];
}
