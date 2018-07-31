<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Delivery;
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


    /**
     * Delivery model.
     *
     * @var
     */
    protected $delivery;

    protected $cartBlockViewNames = [
        'cartProducts' => 'includes.cart.cart-product-table',
        'cartForm' => 'includes.cart.cart-form'
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
     * @param Delivery $delivery
     * @param CartService $cartService
     * @internal param CartService $cartService
     */
    public function __construct(Product $product, Delivery $delivery, CartService $cartService)
    {
        $this->product = $product;
        $this->delivery = $delivery;
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

        $retData = [];

        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);

        try {
            $product = $this->product->getProductInfo($request->productId, [
                'id',
                'name',
                'price',
                'nettoPrice'
            ]);
        } catch (QueryException $e) {
            Log::emergency("Cannot add product to cart");
            return Response::json([]);
        }

        $cart->add($product[0], $product[0]->id);

        $request->session()->put('cart', $cart);

        $retData['totalQuantity'] = $cart->get('totalQuantity');
        $retData['totalPrice'] = $cart->get('totalPrice');
        $retData['totalDPH'] = $this->cartService->getTotalDPH($cart->get('totalPrice'));
        $retData['totalNettoPrice'] = $this->cartService->calcNettoPrice($cart->get('totalPrice'));

        if (($cartProduct = $cart->getCartProduct($request->productId))) {
            $retData['totalProductsGroupPrice'] = $cartProduct['totalProductsPrice'];
            $retData['totalProductsGroupNettoPrice'] = $cartProduct['totalProductsGroupNettoPrice'];
            $retData['totalProductsGroupQuantity'] = $cartProduct['quantity'];
        }

        return Response::json([
            'cartData' => $retData
        ]);
    }

    /**
     * Delete product from cart.
     *
     * @param Request $request
     * @return bool|\Illuminate\Http\JsonResponse
     */
    public function deleteProduct(Request $request) {
        if (!$request->ajax()) {
            return false;
        }

        $retData = [];

        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);

        try {
            $product = $this->product->getProductInfo($request->productId, [
                'id',
                'name',
                'price',
                'nettoPrice'
            ]);
        } catch (QueryException $e) {
            Log::emergency("Cannot add product to cart");
            return Response::json([]);
        }

        $cart->delete($product[0], $product[0]->id);

        $request->session()->put('cart', $cart);

        $retData['totalQuantity'] = $cart->get('totalQuantity');
        $retData['totalPrice'] = $cart->get('totalPrice');
        $retData['totalNettoPrice'] = $this->cartService->calcNettoPrice($cart->get('totalPrice'));
        $retData['totalDPH'] = $this->cartService->getTotalDPH($cart->get('totalPrice'));

        if (($cartProduct = $cart->getCartProduct($request->productId))) {
            $retData['totalProductsGroupPrice'] = $cartProduct['totalProductsPrice'];
            $retData['totalProductsGroupNettoPrice'] = $cartProduct['totalProductsGroupNettoPrice'];
            $retData['totalProductsGroupQuantity'] = $cartProduct['quantity'];
        }

        return Response::json([
            'cartData' => $retData
        ]);
    }

    /**
     * Changes product quantity in cart.
     *
     * @param Request $request
     * @return bool|\Illuminate\Http\JsonResponse
     */
    public function changeProductQuantity(Request $request) {
        if (!$request->ajax()) {
            return false;
        }

        $retData = [];

        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);

        try {
            $product = $this->product->getProductInfo($request->productId, [
                'id',
                'name',
                'price',
                'nettoPrice'
            ]);
        } catch (QueryException $e) {
            Log::emergency("Cannot add product to cart");
            return Response::json([]);
        }

        $cart->change($product[0], $product[0]->id, $request->newQuantity);

        $request->session()->put('cart', $cart);

        $retData['totalQuantity'] = $cart->get('totalQuantity');
        $retData['totalPrice'] = $cart->get('totalPrice');
        $retData['totalNettoPrice'] = $this->cartService->calcNettoPrice($cart->get('totalPrice'));
        $retData['totalDPH'] = $this->cartService->getTotalDPH($cart->get('totalPrice'));

        if (($cartProduct = $cart->getCartProduct($request->productId))) {
            $retData['totalProductsGroupPrice'] = $cartProduct['totalProductsPrice'];
            $retData['totalProductsGroupNettoPrice'] = $cartProduct['totalProductsGroupNettoPrice'];
            $retData['totalProductsGroupQuantity'] = $cartProduct['quantity'];
        }

        return Response::json([
            'cartData' => $retData
        ]);
    }

    /**
     * Deletes product row from cart
     *
     * @param Request $request
     * @return bool|\Illuminate\Http\JsonResponse
     */
    public function deleteProductRow(Request $request) {
        if (!$request->ajax()) {
            return false;
        }

        $retData = [];

        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);

        try {
            $product = $this->product->getProductInfo($request->productId, [
                'id',
                'name',
                'price',
                'nettoPrice'
            ]);
        } catch (QueryException $e) {
            Log::emergency("Cannot add product to cart");
            return Response::json([]);
        }

        $cart->deleteRow($product[0]->id);

        $request->session()->put('cart', $cart);

        $retData['totalQuantity'] = $cart->get('totalQuantity');
        $retData['totalPrice'] = $cart->get('totalPrice');
        $retData['totalNettoPrice'] = $this->cartService->calcNettoPrice($cart->get('totalPrice'));
        $retData['totalDPH'] = $this->cartService->getTotalDPH($cart->get('totalPrice'));

        return Response::json([
            'cartData' => $retData
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
        $cart = new Cart(Session::get('cart'));

        $retData['cartProducts'] = $cart->get('products');
        $retData['deliveryMethods'] = $this->delivery->getActiveDeliveryMethods();
        if ($deliveryMethod = $cart->get('deliveryMethod')) {
            $retData['deliveryPrice'] = $deliveryMethod->price;
            $retData['chosenDeliveryMethod'] = $deliveryMethod->id;
        } else {
            $retData['deliveryPrice'] = 0;
        }

        $retData['totalPrice'] = $cart->get('totalPrice');
        $retData['totalQuantity'] = $cart->get('totalQuantity');
        $retData['totalDPH'] = $this->cartService->getTotalDPH($cart->get('totalPrice'));
        $retData['totalNettoPrice'] = $this->cartService->calcNettoPrice($cart->get('totalPrice'));

        return Response::json([
            'success' => true,
            'html' => view($this->cartBlockViewNames['cartProducts'], $retData)->render()
        ]);
    }

    /**
     * Loads cart form
     */
    public function loadCartOrderFormBlock() {
        Log::emergency(1);
        $retData = [];

        $cart = new Cart(Session::get('cart'));

        return Response::json([
            'success' => true,
            'html' => view($this->cartBlockViewNames['cartForm'], $retData)->render()
        ]);
    }

    /**
     * Submits form in the cart.
     *
     * @param Request $request
     */
    public function submitForm(Request $request) {

    }

    /**
     * Sets delivery method.
     *
     * @param Request $request
     */
    public function setDeliveryMethod(Request $request) {
        if (!$request->ajax()) {
            return false;
        }

        $retData = [];

        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);

        try {
            $method = $this->delivery->getChosenDeliveryMethod($request->methodId);
        } catch (QueryException $e) {
            Log::emergency("Cannot set delivery method");
            return Response::json([]);
        }

        $cart->setDeliveryMethod($method[0]);

        $request->session()->put('cart', $cart);

        $retData['totalQuantity'] = $cart->get('totalQuantity');
        $retData['totalPrice'] = $cart->get('totalPrice');
        $retData['totalNettoPrice'] = $this->cartService->calcNettoPrice($cart->get('totalPrice'));
        $retData['totalDPH'] = $this->cartService->getTotalDPH($cart->get('totalPrice'));

        if ($deliveryMethod = $cart->get('deliveryMethod')) {
            $retData['deliveryPrice'] = $deliveryMethod->price;
        } else {
            $retData['deliveryPrice'] = 0;
        }

        return Response::json([
            'cartData' => $retData
        ]);
    }
}
