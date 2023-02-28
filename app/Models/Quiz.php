<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\QuizQuestion;

class Quiz extends Model
{
    protected $table='quiz';
    use HasFactory;

    public function questions(){
        return $this->hasMany(QuizQuestion::class, 'quiz_id');
    }
}
