<?php

namespace App\Models\backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductChallan extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'product_challan';
    protected $primaryKey = 'product_challan_id';


    protected $fillable = ['product_challan_id', 'challan_id', 'product_description', 'product_id', 'hsn_code', 'p_unit', 'rate', 'quantity', 'cgst_percent', 'cgst_amount', 'sgst_percent', 'sgst_amount', 'igst_percent','orignal_amt' ,'igst_amount', 'product_amount', 'discount', 'product_total_amount', 'created_at', 'updated_at', 'deleted_at'];

    public function challan()
    {
        return $this->belongsTo(Challan::class, 'challan_id');
    }
}
