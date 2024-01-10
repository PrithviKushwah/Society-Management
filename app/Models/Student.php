<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $fillable = [
        'uuid',
        'created_by',
        'application_availability',
        'application_number',
        'year',
        'number',
        'self_image',
        'aadhar_card_front',
        'aadhar_card_back',
        'prtc',
        'caste_certificate',
        'bonafide_nsp',
        'bonafide_college',
        'pre_year_mark',
        'income_certificate',
        'signature',
        'agent_name',
        'agent_mobile',
        'ten_path_year',
        'ten_total_mark',
        'ten_mark',
        'ten_percentage',
        'twelve_path_year',
        'twelve_total_mark',
        'twelve_mark',
        'twelve_percentage',
        'student_name',
        'father_name',
        'mother_name',
        'email_address',
        'dob',
        'gender',
        'phone_number',
        'family_income',
        'state',
        'district',
        'sub_division',
        'cast',
        'city',
        'pincode',
        'address_1',
        'address_2',
        'account_number',
        'IFSC_code',
        'bank_name',
        'branch_name',
        'college_name',
        'course_details',
        'collage_current_year',
        'collage_percentage',
    ];
}
