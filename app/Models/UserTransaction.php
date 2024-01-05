<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserTransaction extends Model
{
    use HasFactory;
    protected $table = 'user_transactions';
    protected $primaryKey = 'tnx_id';
    protected $fillable = ['tnx_user_id', 'tnx_user_type','tnx_date', 'tnx_amount','tnx_type', 'tnx_user_name', 'tnx_final_dues','tnx_account','tnx_remark','tnx_closing_ac_bal','tnx_invoice','tnx_p_s_i_id','tnx_p_amount','admin'];
}
