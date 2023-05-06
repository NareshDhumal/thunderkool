<?php

namespace App\Models\backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Financialyear extends Model
{
    use HasFactory;

    protected $table = 'financial_year';
    protected $primaryKey = 'financial_year_id';


    protected $fillable = ['financial_year', 'financial_start_year', 'financial_end_year', 'default_flag'];
}
