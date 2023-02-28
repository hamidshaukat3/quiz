<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repository\QuizManagement\QuizManagementInterface;


class QuizController extends BaseController
{
    public $repositoryObj;

    public function __construct(QuizManagementInterface $quizObj){
        $this->repositoryObj = $quizObj;
    }

    public function store(Request $request){
        $response = $this->repositoryObj->store($request);

        if(! $response["success"]){
           return $this->sendError('Unable to store quiz.', ['error' => $response["message"]]);
        }

        return $this->sendResponse($response["data"], $response["message"]);
    }

    public function loadQuiz($id){
        $response = $this->repositoryObj->loadQuiz($id);

        if(! $response["success"]){
            return $this->sendError('Unable to load Quiz.', ['error' => $response["message"]]);
        }

        return $this->sendResponse($response["data"], $response["message"]);
    }
    
}
