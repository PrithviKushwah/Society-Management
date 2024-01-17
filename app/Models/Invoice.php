<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    protected $table = 'invoices';
    public $fillable = [
        'created_for',
        'created_by',
        'maintainance_id',
        'payment_method',
        'paid_amount',
        'remaining_amount',
        'comment'
    ];
}
