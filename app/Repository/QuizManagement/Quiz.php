<?php

namespace App\Repository\QuizManagement;

use Illuminate\Http\Request;
use App\Models\Quiz as Quizz;
use App\Models\QuizQuestion;
use App\Models\QuizAnswer;

class Quiz implements QuizManagementInterface{

    public function store(Request $request){
        $quiz = new Quizz;
        $quiz->title = $request->title;
        $quiz->description = $request->description;
        $quiz->save();
        foreach($request->questions as $question){
            $newQuestion = new QuizQuestion;
            $newQuestion->question = $question['title'];
            $newQuestion->quiz_id = $quiz->id;
            $newQuestion->save();
            foreach($question['answers'] as $answer){
                $newAnswer = new QuizAnswer;
                $newAnswer->answer = $answer['title'];
                $newAnswer->correct = $answer['isRight'];
                $newAnswer->question_id = $newQuestion->id;
                $newAnswer->save();
            }
        }
        if(! $quiz){
            $response["success"] = false;
            $response["message"] = "Data not saved";
        } else {
            $response["success"] = true;
            $response["message"] = "Data has been saved successfully";
            $response["data"] = $quiz;
        }

        return $response;
    }

    public function loadQuiz($id){
        $quiz = Quizz::where('id', $id)->with('questions.answers')->get();
        
        if($quiz->isEmpty()){
            $response["success"] = false;
            $response["message"] = "Unable to load quiz";
        } else {
            $response["success"] = true;
            $response["message"] = "Data found successfully";
            $response["data"] = $quiz;
        }

        return $response;
    }
}