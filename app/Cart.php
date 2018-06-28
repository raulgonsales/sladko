<?php

namespace App;

use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Cookie;
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
        }

        $this->sessionId = Session::getId();
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
            'price' => $product->price,
            'product' => $product
        ];

        if($this->products && array_key_exists($id, $this->products)) {
            $storedProduct = $this->products[$id];
        }

        $storedProduct['quantity']++;
        $storedProduct['price'] = $product->price * $storedProduct['quantity'];
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
        }

        return false;
    }
}
