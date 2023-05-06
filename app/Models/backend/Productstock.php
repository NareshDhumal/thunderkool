<?php

namespace App\Models\backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Productstock extends Model
{
    use HasFactory;
    protected $table = 'Product';
    
    protected $primaryKey = 'product_id';
}
