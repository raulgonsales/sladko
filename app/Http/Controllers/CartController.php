<?php

namespace App\Http\Controllers;
class CartController extends Controller
{
    /**
     * Renders cart page.
     */
    public function index() {
        return view('cart');
    }
}
