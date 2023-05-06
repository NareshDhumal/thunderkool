<?php

namespace App\Models\backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customers extends Model
{
    use HasFactory;

    protected $table = 'customers';
    protected $primaryKey = 'customer_id';


    protected $fillable = ['customer_name', 'address', 'mobile_no', 'email', 'pin_code', 'state', 'c_gst_no', 'c_bank_name', 'c_branch_name', 'c_bank_ifsc', 'c_account_no', 'c_pan_no'];
}