<?php

namespace App\Models\backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    protected $table = 'vehicle';
    protected $primaryKey = 'vehicle_id';
    protected $fillable = ['vehicle_make_id', 'vehicle_model_id', 'vehicle_no', 'chassis_no', 'serial_no', 'cab_no', 'loco_no'];

    public function make()
    {
        return $this->hasOne(VehicleMake::class, 'vehicle_make_id','vehicle_make_id');
    }

    public function model()
    {
        return $this->hasOne(Vehiclemodel::class, 'vehicle_model_id','vehicle_model_id');
    }
}
