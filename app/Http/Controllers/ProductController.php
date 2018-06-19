<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Services\ProductImageService;

class ProductController extends Controller
{
    /**
     * Product model.
     *
     * @var Product
     */
    protected $product;

    /**
     * Fields to get from database for product page
     *
     * @var array
     */
    protected $productFields = [
        'id',
        'name',
        'price',
        'description'
    ];

    /**
     * Service to work with images.
     *
     * @var ProductImageService
     */
    protected $productImageService;

    /**
     * ProductController constructor.
     *
     * @param Product $product
     * @param ProductImageService $productImageService
     */
    public function __construct(Product $product, ProductImageService $productImageService)
    {
        $this->product = $product;
        $this->productImageService = $productImageService;
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
            $product = $this->product->getProductInfo($request->id, $this->productFields)[0];
            $retData['product'] = $product;
            $retData['images'] = $this->productImageService->getProductImagesWithThumbnails($product->images);
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
