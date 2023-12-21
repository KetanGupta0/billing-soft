<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $table = 'transactions';
    protected $primaryKey = 't_id';
    protected $fillable = [
        't_ac_id',
        't_type',
        't_amount',
        't_final_amount',
        't_remarks',
        't_date'
    ];
}
