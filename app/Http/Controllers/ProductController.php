<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    /**
     * Product model.
     *
     * @var Product
     */
    protected $product;

    protected $productFields = [
        'name',
        'price',
        'description'
    ];

    /**
     * ProductController constructor.
     *
     * @param Product $product
     */
    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    /**
     * Render product page.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request) {
        $retData['breadcrumb'] = $this->getBreadcrumb();

        try {
            $retData['product'] = $this->product->getProductInfo($request->id, $this->productFields)[0];
        } catch (QueryException $e) {
            Log::emergency("Exception getting product fields from database");
            $retData['product']['error'] = "Any error with current product. Please, try again later.";
        }


        return view('product', $retData);
    }

    /**
     * Gets Breadcrumb for product page.
     */
    public function getBreadcrumb() {
        return 'test';
    }
}
