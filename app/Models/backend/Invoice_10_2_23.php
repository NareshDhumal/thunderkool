<?php

namespace App\Models\backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'invoice';
    protected $primaryKey = 'invoice_id';


    protected $fillable = ['invoice_id ', 'invoice_no', 'date_of_issue', 'customer_id', 'company_id', 'vehicle_make_id', 'vehicle_model_id', 'manual_invoice', 'vehicle', 'vehicle_number', 'km', 'payment_method', 'free_of_charge', 'gst_flag ', 'bank_name', 'cheque_no', 'e_transaction_ref', 'base_amount', 'discount', 'total_igst_percent', 'total_sgst_percent', 'total_cgst_percent', 'total_amount', 'amt_in_words', 'remark', 'created_at', 'updated_at', 'deleted_at'];

    public function productsInvoice()
    {
        return $this->hasMany(ProductInvoice::class, 'invoice_id')->orderBy('product_invoice_id', 'ASC');
    }
}
