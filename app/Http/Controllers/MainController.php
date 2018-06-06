<?php

namespace App\Http\Controllers;

use App\Review;

class MainController extends Controller
{

    public function showMainPage() {
        return view('main');
    }
}
