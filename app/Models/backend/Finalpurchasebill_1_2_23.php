<?php

namespace App\Models\backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Finalpurchasebill extends Model
{
    use HasFactory;


    protected $table = 'final_shipment_purchase_order';
    protected $primaryKey = 'id';


    protected $fillable = ['supplier_id', 'company_id', 'supplier_bill_no', 'dated', 'payment_mode', 'cheque_no', 'electronic_payment_ref', 'bank_name', 'cheque_date', 'flag', 'gst_flag', 'type', 'amount_words', 'invoice_no'];

    public function company()
    {
        return $this->hasOne(Company::class, 'company_id','company_id');
    }

    public function supplier()
    {
        return $this->hasOne(Supplier::class, 'supplier_id','supplier_id');
    }

    public function Product_details(){
        return $this->hasMany(Purchasebill::class, 'invoice_no','invoice_no');
    }
}
