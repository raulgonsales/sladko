<?php

namespace App\Http\Controllers;

class MainController extends Controller
{
    public function showMainPage() {
        return view('main');
    }
}
