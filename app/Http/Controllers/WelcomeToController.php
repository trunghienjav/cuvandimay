<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WelcomeToController extends Controller
{
    public function form()
    {
        return view('form');
    }
    public function post(Request $rq)
    {
        $a = $rq->get('a');
        return view('show', [
            'a' =>$a
        ]);
    }
}
