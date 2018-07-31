<?php
namespace App\Services;


class CartService
{
    protected $feePercent = 21;

    /**
     * Counts total fee from price.
     *
     * @param $price
     * @return float
     */
    public function getTotalDPH($price) {
        return round($price * $this->feePercent / 100);
    }

    /**
     * Counts total price without fee
     *
     * @param $price
     * @return float
     */
    public function calcNettoPrice($price) {
        return $price - $this->getTotalDPH($price);
    }

    /**
     * Calcs group product price
     *
     * @param $price
     * @param $quantity
     * @return mixed
     */
    public function calcGroupProductPrice($price, $quantity) {
        return $price * $quantity;
    }
}