<?php

namespace App\Models\backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;
    protected $table = 'supplier';
    protected $primaryKey = 'supplier_id';
    protected $fillable = ['s_name', 's_email', 's_mobile_no', 's_address', 's_gstno', 's_pin_code', 's_state', 's_pin_code', 's_bank_name', 's_branch_name', 's_account_no', 's_bank_ifsc', 's_pan_no'];
}
