<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminModel extends Model
{
    use HasFactory;

    protected $table = 'admin';
    protected $primaryKey = 'a_id';
    protected $fillable = ['a_name', 'a_add', 'a_gst', 'a_fmob', 'a_smob', 'a_email', 'a_alert'];
}
