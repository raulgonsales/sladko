<?php
namespace App\Services;


use Illuminate\Support\Facades\Log;

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
    public function getTotalPriceWithoutDPH($price) {
        return $price - $this->getTotalDPH($price);
    }
}