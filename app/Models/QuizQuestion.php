<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Quiz;
use App\Models\QuizAnswer;

class QuizQuestion extends Model
{
    protected $table = 'quiz_questions';
    use HasFactory;

    public function quiz(){
        return $this->belongsTo(Quiz::class);
    }

    public function answers(){
        return $this->hasMany(QuizAnswer::class, 'question_id');
    }


}
