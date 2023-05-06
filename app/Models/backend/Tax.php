<?php

namespace App\Models\backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tax extends Model
{
    use HasFactory;
    protected $table = 'tax';
    protected $primaryKey = 'gst_id';
    protected $fillable = ['gst_name', 'gst_value'];

}
