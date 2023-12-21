<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PartyModel extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'parties';
    protected $primaryKey = 'p_id';
    protected $fillable = ['p_name', 'p_add','p_fmob', 'p_smob','p_gst', 'p_state','p_desc', 'p_dues','p_type'];
}
