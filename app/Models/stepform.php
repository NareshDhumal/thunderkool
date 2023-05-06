<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\Console\Helper\Table;

class Questions extends Model
{
    use HasFactory;

    protected $table = 'questions';
    protected $primaryKey = 'question_id';


    protected $fillable = [
        'question_id', 'question' , 'type'
   ];

}
