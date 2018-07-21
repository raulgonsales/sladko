<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Product;
use App\Services\CartService;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;
use Mockery\Exception;

class AjaxCartController extends AjaxController
{
    /**
     * Product model.
     *
     * @var
     */
    protected $product;

    protected $cartBlockViewNames = [
        'cartProducts' => 'includes.cart.cart-product-table'
    ];

    /**
     * Cart service.
     *
     * @var CartService
     */
    protected $cartService;

    /**
     * AjaxCartController constructor.
     *
     * @param Product $product
     * @param CartService $cartService
     * @internal param CartService $cartService
     */
    public function __construct(Product $product, CartService $cartService)
    {
        $this->product = $product;
        $this->cartService = $cartService;
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
                'price',
                'nettoPrice'
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

    /**
     * Loads cart block by block id.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|void
     */
    public function loadCartBlock(Request $request) {
        if(isset($request->blockId) && $request->ajax()) {
            switch ($request->blockId) {
                case 0:
                    return $this->loadCartProductsBlock();
                    break;
                case 1:
                    return $this->loadCartOrderFormBlock();
                    break;
            }
        }
    }

    /**
     * Loads block with products in cart.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function loadCartProductsBlock() {
        $retData = [];

        if (!$oldCart = Session::get('cart')) {
            $retData['noProducts'] = true;
        }

        $cart = new Cart($oldCart);
        $cart->actualizeProductsPrice();
        $retData['cartProducts'] = $cart->get('products');


        $retData['totalPrice'] = $cart->get('totalPrice');
        $retData['totalQuantity'] = $cart->get('totalQuantity');
        $retData['totalDPH'] = $this->cartService->getTotalDPH($cart->get('totalPrice'));
        $retData['totalPriceWithoutDPH'] = $this->cartService->getTotalPriceWithoutDPH($cart->get('totalPrice'));

        try {
            if (!view()->exists($this->cartBlockViewNames['cartProducts'])) {
                throw new Exception("View " . $this->cartBlockViewNames['cartProducts'] . " does not exist");
            }

            $returnHtml = view($this->cartBlockViewNames['cartProducts'], $retData)->render();
        } catch (Exception $e) {
            Log::emergency($e->getMessage());
            return Response::json(['success' => false]);
        }

        return Response::json([
            'success' => true,
            'html' => $returnHtml
        ]);
    }

    /**
     * Load
     */
    public function loadCartOrderFormBlock() {
        return 1;
    }
}
