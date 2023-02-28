<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\QuizQuestion;

class QuizAnswer extends Model
{
    protected $table = 'quiz_answers';
    use HasFactory;

    public function question(){
        return $this->belongsTo(QuizQuestion::class);
    }
}
