<?php

namespace App\Models\backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quentity extends Model
{
    use HasFactory;
    protected $table = 'quentity';
    protected $primaryKey =  'qty_id';

    protected $fillable = ['qty', 'product_part_no'];





    public function product()
    {

        return $this->hasMany(Company::class, 'product_part_no', 'product_part_no');

       
    }
}
