<?php

namespace App\Models\backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchasebill extends Model
{
    use HasFactory;
    protected $table = 'product_purchase_bill';
    protected $primaryKey = 'id';


    protected $fillable = ['product_name', 'quantity' , 'amount',  'hsn_code', 'p_part_no', 'p_custom_port_no', 'product_unit', 'gst_percent', 'total_amount'];
}
