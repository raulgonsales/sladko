<?php

namespace App;

use App\Services\CartService;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use App\Session as SessionModel;

class Cart
{
    /**
     * All items in cart.
     *
     * @var null
     */
    protected $products = null;

    /**
     * Total quantity of items.
     *
     * @var int
     */
    protected $totalQuantity = 0;

    /**
     * Total price of items.
     *
     * @var int
     */
    protected $totalPrice = 0;

    /**
     * Delivery price.
     *
     * @var int
     */
    protected $deliveryMethod = null;

    /**
     * Session model instance.
     *
     * @var
     */
    protected $databaseSession;

    /**
     * User sessionID
     *
     * @var string
     */
    protected $sessionId;

    /**
     * Cart service instance
     *
     * @var
     */
    protected $cartService;

    /**
     * Cart constructor.
     *
     * @param $oldCart
     */
    public function __construct($oldCart)
    {
        if($oldCart) {
            $this->products = $oldCart->products;
            $this->totalPrice = $oldCart->totalPrice;
            $this->totalQuantity = $oldCart->totalQuantity;
            $this->deliveryMethod = $oldCart->deliveryMethod;
        }

        $this->sessionId = Session::getId();
        $this->cartService = new CartService();
    }

    /**
     * Gets all user`s cart products by sessionID from database
     *
     * @param $sessionId
     */
    public function getUserCart($sessionId) {

    }

    /**
     * Adds product to cart.
     *
     * @param $product
     * @param $id
     * @internal param $item
     */
    public function add($product, $id) {
        $storedProduct = [
            'quantity' => 0,
            'totalProductsPrice' => $product->price,
            'totalProductsGroupNettoPrice' => $this->cartService->calcNettoPrice($product->price),
            'product' => $product
        ];

        if($this->products && array_key_exists($id, $this->products)) {
            $storedProduct = $this->products[$id];
        }

        $storedProduct['quantity']++;
        $storedProduct['totalProductsPrice'] = $this->cartService->calcGroupProductPrice(
            $product->price,
            $storedProduct['quantity']
        );
        $storedProduct['totalProductsGroupNettoPrice'] = $this->cartService->calcNettoPrice(
            $storedProduct['totalProductsPrice']
        );
        $this->products[$id] = $storedProduct;
        $this->totalQuantity++;
        $this->totalPrice += $product->price;

        try {
            $userSession = $this->updateUserDatabaseSession();

            $this->updateSessionProductQuantity($userSession, $product, $storedProduct['quantity']);
        } catch (QueryException $e) {
            Log::emergency($e->getMessage());
        }
    }

    /**
     * Deletes product from cart.
     *
     * @param $product
     * @param $id
     * @internal param $item
     */
    public function delete($product, $id) {
        $storedProduct = [
            'quantity' => 0,
            'totalProductsPrice' => $product->price,
            'totalProductsGroupNettoPrice' => $this->cartService->calcNettoPrice($product->price),
            'product' => $product
        ];

        if($this->products && array_key_exists($id, $this->products)) {
            $storedProduct = $this->products[$id];
        }

        $storedProduct['quantity']--;
        $storedProduct['totalProductsPrice'] = $this->cartService->calcGroupProductPrice(
            $product->price,
            $storedProduct['quantity']
        );
        $storedProduct['totalProductsGroupNettoPrice'] = $this->cartService->calcNettoPrice(
            $storedProduct['totalProductsPrice']
        );
        $this->products[$id] = $storedProduct;
        $this->totalQuantity--;
        $this->totalPrice -= $product->price;

        try {
            $userSession = $this->updateUserDatabaseSession();

            $this->updateSessionProductQuantity($userSession, $product, $storedProduct['quantity']);
        } catch (QueryException $e) {
            Log::emergency($e->getMessage());
        }
    }

    /**
     * Changes product quantity.
     *
     * @param $product
     * @param $id
     * @param $newQuantity
     */
    public function change($product, $id, $newQuantity) {
        $storedProduct = [
            'quantity' => 0,
            'totalProductsPrice' => $product->price,
            'totalProductsGroupNettoPrice' => $this->cartService->calcNettoPrice($product->price),
            'product' => $product
        ];

        if($this->products && array_key_exists($id, $this->products)) {
            $storedProduct = $this->products[$id];
        }

        $storedProduct['quantity'] = $newQuantity;
        $storedProduct['totalProductsPrice'] = $this->cartService->calcGroupProductPrice(
            $product->price,
            $storedProduct['quantity']
        );
        $storedProduct['totalProductsGroupNettoPrice'] = $this->cartService->calcNettoPrice(
            $storedProduct['totalProductsPrice']
        );

        $this->products[$id] = $storedProduct;
        $this->recalculateProductQuantity();
        $this->recalculateTotalPrice();

        try {
            $userSession = $this->updateUserDatabaseSession();

            $this->updateSessionProductQuantity($userSession, $product, $storedProduct['quantity']);
        } catch (QueryException $e) {
            Log::emergency($e->getMessage());
        }
    }

    /**
     * Deletes product row from cart.
     *
     * @param $id
     * @internal param $product
     */
    public function deleteRow($id) {
        unset($this->products[$id]);
        $this->recalculateTotalPrice();
        $this->recalculateProductQuantity();
    }

    /**
     * Recalculates total product quantity.
     */
    public function recalculateProductQuantity() {
        $this->totalQuantity = 0;
        foreach ($this->products as $product) {
            $this->totalQuantity += $product['quantity'];
        }
    }

    /**
     * Recalculates total cart price.
     */
    public function recalculateTotalPrice() {
        $this->totalPrice = 0;
        foreach ($this->products as $product) {
            $this->totalPrice += $product['totalProductsPrice'];
        }

        if ($this->deliveryMethod) {
            $this->totalPrice += $this->deliveryMethod->price;
        }
    }

    /**
     * Create or update user session in database
     *
     * @return mixed
     */
    public function updateUserDatabaseSession() {
        return SessionModel::updateOrCreate(
            ['session_id' => $this->sessionId],
            ['expiry_date' => today()]
        );
    }

    /**
     * @param $session Session model instance
     * @param $product Product model instance
     * @param $quantity new quantity of product
     */
    public function updateSessionProductQuantity($session, $product, $quantity) {
        $session->products()->syncWithoutDetaching([
            $product->id => [
                'quantity' => $quantity
            ]
        ]);
    }

    /**
     * Actualize product prices in cart
     */
    public function actualizeProductsPrice() {

    }

    /**
     * Loads product by Id from cart
     *
     * @param $id
     * @return mixed
     */
    public function getCartProduct($id) {
        return $this->products[$id] ? $this->products[$id] : null;
    }

    public function setDeliveryMethod($method) {
        $this->deliveryMethod = $method;
        $this->recalculateTotalPrice();
    }

    /**
     * Getter
     *
     * @param $property
     * @return bool|int
     */
    public function get($property) {
        switch ($property) {
            case 'totalQuantity':
                return $this->totalQuantity;
                break;
            case 'totalPrice':
                return $this->totalPrice;
                break;
            case 'products':
                return $this->products;
                break;
            case 'deliveryMethod':
                return $this->deliveryMethod;
                break;
        }

        return false;
    }
}
