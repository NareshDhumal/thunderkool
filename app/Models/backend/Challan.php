<?php

namespace App\Models\backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Challan extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'challan';
    protected $primaryKey = 'challan_id';


    protected $fillable = ['challan_id ', 'challan_no', 'date_of_issue', 'customer_id', 'company_id', 'vehicle_make_id', 'vehicle_model_id', 'manual_invoice', 'vehicle', 'vehicle_number', 'km', 'payment_method', 'free_of_charge', 'gst_flag ', 'bank_name', 'cheque_no', 'cheque_date', 'e_transaction_ref', 'base_amount', 'discount', 'total_igst_percent', 'total_sgst_percent', 'total_cgst_percent', 'total_amount', 'amt_in_words', 'remark', 'invoice_cum_challan', 'financial_year', 'created_at', 'updated_at', 'deleted_at'];

    public function productsChallan()
    {
        return $this->hasMany(ProductChallan::class, 'challan_id')->orderBy('product_challan_id', 'ASC');
    }
}
