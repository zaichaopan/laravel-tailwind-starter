<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $question = [
            'question' => 'Who exactly are you?',
            'answer' => 'My name is <strong>Jeffrey way</strong>, and I have been part of the Laravel community since the early days of version 3.'
        ];

        return view('home', compact('question'));
    }
}
