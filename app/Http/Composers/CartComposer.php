<?php

namespace App\Http\Composers;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Session;

class CartComposer
{
    /**
     * Compose view.
     *
     * @param View $view
     * @return View
     */
    public function compose(View $view) {
        $retData['totalQuantity'] = 0;
        $retData['totalPrice'] = 0;

        if($oldCart = Session::get('cart')) {
            $retData['totalQuantity'] = $oldCart->get('totalQuantity');
            $retData['totalPrice'] = $oldCart->get('totalPrice');
        }

        return $view->with('cart', $retData);
    }
}