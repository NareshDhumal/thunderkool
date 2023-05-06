<?php

namespace App\Models\backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\Console\Helper\Table;

class Questions extends Model
{
    use HasFactory;

    protected $table = 'questions';
    protected $primaryKey = 'question_id';


    protected $fillable = [
        'question_id', 'question' , 'type' ,'option_1' , 'option_2', 'option_3' , 'option_4' ];

}
