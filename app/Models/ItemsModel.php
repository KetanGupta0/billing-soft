<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemsModel extends Model
{
    use HasFactory;

    // public $timestamps = false;
    protected $table = 'items';
    protected $primaryKey = 'item_id';
    protected $fillable = ['item_hsn', 'item_name', 'item_name_local', 'item_location', 'item_desc', 'item_base_unit', 'item_conversion_rate', 'item_sub_unit', 'item_gst', 'item_purchase_rate', 'item_purchase_tax_type', 'item_sale_tax_type', 'item_gst_slab', 'item_stock_whole', 'item_stock_retail', 'item_min_stock', 'item_sale_rate_whole_base', 'item_sale_rate_whole_sub', 'item_sale_rate_retail_base', 'item_sale_rate_retail_sub', 'item_mfg_date', 'item_exp_date', 'item_exp_alert_time', 'item_mrp', 'item_disc_whole', 'item_disc_retail', 'adminid'];
}
