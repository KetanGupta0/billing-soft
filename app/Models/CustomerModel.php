<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerModel extends Model
{
    use HasFactory;
    protected $table = 'customers';
    protected $primaryKey = 'c_id';
    protected $fillable = [
        'c_name',
        'c_type',
        'c_gst',
        'c_add',
        'c_fmob',
        'c_smob',
        'c_state',
        'c_desc',
        'c_dues',
        'c_status',
        'c_deleted_by'
    ];
}
