<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;
    protected $table = 'accounts';
    protected $primaryKey = 'ac_id';
    protected $fillable = [
        'ac_name',
        'ac_balance',
        'admin'
    ];
}
