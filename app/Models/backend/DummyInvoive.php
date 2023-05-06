<?php

namespace App\Models\backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DummyInvoive extends Model
{
    use HasFactory;
    protected $table = 'dummy_invoice_no';
    protected $primaryKey = 'dummy_invoice_no_id';


    protected $fillable = ['invoice_no'];



    
}
