<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StateModel extends Model
{
    use HasFactory;

    protected $table = 'state';
    protected $primaryKey = 's_id';
    protected $fillable = ['s_name', 's_name_h'];
}
