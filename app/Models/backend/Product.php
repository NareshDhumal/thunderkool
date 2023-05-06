<?php

namespace App\Models\backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';
    protected $primaryKey = 'product_id';


    protected $fillable = ['product_name', 'company_id', 'product_rate', 'product_stock', 'grams', 'hsn_code', 'product_part_no', 'product_part_no_custom', 'product_unit', 'gst_percent','group_id','service_id'];
    // protected $fillable = ['product_name', 'company_name','product_code', 'product_rate', 'product_stock', 'product_party', 'hsn_code', 'sac_code', 'tax_percent', 'product_part_no', 'product_part_no_custom', 'product_unit', 'gst_percent','company_id','gst_percent'];


    public function company(){
        return $this->hasOne(Company::class, 'company_id', 'company_id');
    }
    public function Purchasebill(){
        return $this->hasMany(Purchasebill::class,'product_name','product_name');
    }


    public function qty(){

        return $this->hasMany(quentity::class, 'product_part_no','product_part_no');
    
    }
    public function group(){
        return $this->hasOne(Productgroup::class, 'group_id', 'group_id');
    }
}
