<?php

namespace App\Models\backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paymentmode extends Model
{
    use HasFactory;
    protected $table = 'payment_mode';
    protected $primaryKey = 'payment_mode_id';
}
