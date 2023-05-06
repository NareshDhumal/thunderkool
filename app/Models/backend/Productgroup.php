<?php

namespace App\Models\backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Productgroup extends Model
{
    use HasFactory;

    protected $table = 'product groups';
    protected $primaryKey = 'group_id';

    protected $fillable = ['group_name'];

   
}
