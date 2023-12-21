<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesItems extends Model
{
    use HasFactory;
    protected $table = 'sales_items';
    protected $primaryKey = 's_i_id';
    protected $fillable = [
        's_i_s_h_id',
        's_i_item_id',
        's_i_qty',
        's_i_rate',
        's_i_total',
        's_i_status',
        's_i_unit',
        's_i_item_name',
        's_i_unit_new',
        's_i_tax',
        's_i_discount'
    ];
}
