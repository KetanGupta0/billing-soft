<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseItem extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'purchase_items';
    protected $primaryKey = 'p_i_id';
    protected $fillable = ['p_i_p_h_id','p_i_item_id','p_i_qty','p_i_rate','p_i_total'];
}
