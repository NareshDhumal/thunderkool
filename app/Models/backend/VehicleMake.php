<?php

namespace App\Models\backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleMake extends Model
{
    use HasFactory;
    protected $table = 'vehicle_make';
    protected $primaryKey = 'vehicle_make_id';
    protected $fillable = ['vehicle_make_name'];
}
