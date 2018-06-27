<?php

namespace App\Http\Controllers;

use App\Review;
use App\Product;

class MainController extends Controller
{
    /**
     * Product model
     *
     * @var Product
     */
    protected $product;

    /**
     * MainController constructor.
     *
     * @param Product $product
     */
    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    /**
     * Sets init data to main view
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index() {
        $retData['products'] = $this->product->getNewProducts(8);

        return view('main', $retData);
    }
}
