<?php

namespace App\Repository\QuizManagement;

use Illuminate\Http\Request;

interface QuizManagementInterface{


    public function store(Request $request);

    public function loadQuiz($id);
}