<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Product;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;

class AjaxCartController extends AjaxController
{
    /**
     * Product model.
     *
     * @var
     */
    protected $product;

    /**
     * AjaxCartController constructor.
     *
     * @param Product $product
     * @internal param CartService $cartService
     */
    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    /**
     * Add product to cart.
     *
     * @param Request $request
     * @return bool|\Illuminate\Http\JsonResponse
     */
    public function addProduct(Request $request) {
        if (!$request->ajax()) {
            return false;
        }

        try {
            $product = $this->product->getProductInfo($request->productId, [
                'id',
                'name',
                'price'
            ]);
        } catch (QueryException$e) {
            Log::emergency("Cannot add product to cart");
            return Response::json([]);
        }

        $oldCart = Session::has('cart') ? Session::get('cart') : null;

        $cart = new Cart($oldCart);
        $cart->add($product[0], $product[0]->id );

        $request->session()->put('cart', $cart);

        return Response::json([
            'totalQuantity' => $cart->get('totalQuantity'),
            'totalPrice' => $cart->get('totalPrice')
        ]);
    }
}
