<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnitModel extends Model
{
    use HasFactory;

    protected $table = 'units';
    protected $primaryKey = 'u_id';
    protected $fillable = ['u_name', 'u_status'];
}
