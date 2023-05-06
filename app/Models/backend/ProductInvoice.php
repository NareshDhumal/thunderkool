<?php

namespace App\Models\backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductInvoice extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'product_invoice';
    protected $primaryKey = 'product_invoice_id';


    protected $fillable = ['product_invoice_id', 'invoice_id', 'product_description', 'product_id', 'hsn_code', 'p_unit', 'rate', 'quantity', 'cgst_percent', 'cgst_amount', 'sgst_percent', 'sgst_amount', 'igst_percent', 'igst_amount', 'product_amount', 'discount', 'product_total_amount', 'created_at', 'updated_at', 'deleted_at'];

    public function invoice()
    {
        return $this->belongsTo(Invoice::class, 'invoice_id');
    }
}
