<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseHistory extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'purchase_history';
    protected $primaryKey = 'p_h_id';
    protected $fillable = ['p_h_otp','p_h_party_id','p_h_bill_no', 'p_h_bill_date','p_h_veh_no', 'p_h_del_date','p_h_other', 'p_h_pre','p_h_total','p_h_dis','p_h_grand','p_h_paid','p_h_dues','p_h_desc'];
}
