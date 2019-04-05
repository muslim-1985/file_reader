<?php

namespace App\Http\Controllers;

use App\Document;

class AppController extends Controller
{
    public function index()
    {
        $documents = Document::paginate(15);
        return view('welcome', compact('documents'));
    }
}
