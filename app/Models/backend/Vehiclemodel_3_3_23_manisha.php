<?php

namespace App\Models\backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehiclemodel extends Model
{
    use HasFactory;
    protected $table = 'vehicle_model';
    protected $primaryKey = 'vehicle_model_id';
    protected $fillable = ['vehicle_model_name'];
}

