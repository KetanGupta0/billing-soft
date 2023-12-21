<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesHistory extends Model
{
    use HasFactory;
    protected $table = 'sales_history';
    protected $primaryKey = 's_h_id';
    protected $fillable = [
        's_h_otp',
        's_h_customer_id',
        's_h_bill_no',
        's_h_bill_date',
        's_h_customer_type',
        's_h_bill_type',
        's_h_bill_desc',
        's_h_paid',
        's_h_pre',
        's_h_grand',
        's_h_total',
        's_h_dis',
        's_h_other',
        's_h_due',
        's_h_status',
        's_h_deleted_by',
        's_h_deleted_at',
    ];
}
