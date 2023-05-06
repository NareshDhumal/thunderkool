<?php

namespace App\Models\backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
    protected $table = 'company';
    protected $primaryKey = 'company_id';
    protected $fillable = ['company_name', 'company_address', 'bill_gst', 'cm_mobile', 'company_logo', 'company_seal', 'gst_no', 'cm_gst_no', 'cm_bank_name', 'cm_branch_name', 'cm_bank_ifsc', 'cm_account_no', 'cm_pan_no'];
}
