<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SlabModel extends Model
{
    use HasFactory;

    protected $table = 'slab';
    protected $primaryKey = 'sl_id';
    protected $fillable = ['sl_name', 'sl_per', 'admin'];
}
