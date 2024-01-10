<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_data extends Model
{
    use HasFactory;

    protected $table = 'user_data';
    protected $primaryKey = 'user_id';

    protected $fillable = [
        'user_id',
        'father_name',
        'mother_name',
        'date_of_birth',
        'phone_number',
        'alternate_phone_number',
        'tenth_details',
        'twelfth_details',
        'university_details',
        'permanent_address',
        'current_address',
        'industry_experience',
        'tenth_marksheet',
        'twelfth_marksheet',
        'aadhar_card',
        'alternative_govt_id_card',
        'graduation_diploma',
        'post_graduation',
        'experience_certificate',
        'salary_slip',
    ];
}
