<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpenseRecord extends Model
{
    use HasFactory;
    protected $fillable = [
        'e_r_remark','e_r_amount','e_r_ac_from','e_r_for','e_r_status','e_r_tnx_id','e_r_date','admin'
    ];
}
