<?php

namespace App\Models\backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    use HasFactory;

    protected $table = 'state';
    protected $primaryKey = 'state_id';
    protected $fillable = ['state_name', 'pincode'];
}
