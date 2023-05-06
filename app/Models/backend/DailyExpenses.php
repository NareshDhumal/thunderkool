<?php

namespace App\Models\backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DailyExpenses extends Model
{
    use HasFactory;

    use SoftDeletes;
    protected $table = 'dailyexpenses';
    protected $primaryKey = 'dailyexpenses_id';

    protected $fillable = ['employee_name','expenses_name','amount_paid','payment_mode','payment_no_or_mode','dated','bank_name','company_id'];
}
