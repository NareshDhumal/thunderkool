<?php

namespace App\Models\backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Purchasebill extends Model
{
    use HasFactory;
    // use SoftDeletes;
    protected $table = 'product_purchase_bill';
    protected $primaryKey = 'id';


    protected $fillable = ['product_name', 'quantity' , 'amount',  'hsn_code', 'p_part_no', 'p_custom_port_no', 'product_unit' ,'stock','total_amount', 'supplier_id', 'company_id','rate', 'type', 'total_amount', 'total_init_amount' , 'total_quantity', 'row_total_gst', 'discount' ,'igst', 'sgst', 'cgst', 'igst_percent' ,'cgst_percent', 'sgst_percent', 'igst_total', 'sgst_total' ,'cgst_total', 'invoice_no','financial_year','orignal_amount'];

    public function company()
    {
        return $this->hasOne(Company::class, 'company_id','company_id');
    }

    public function supplier()
    {
        return $this->hasOne(Supplier::class, 'supplier_id','supplier_id');
    }

    // public function supplier()
    // {
    //     return $this->hasOne(Supplier::class, 'supplier_id','supplier_id');
    // }
}
