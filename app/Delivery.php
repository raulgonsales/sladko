<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    protected $table = 'delivery_methods';

    public $timestamps = false;

    public function getActiveDeliveryMethods() {
        return $this->where('active', '=', 1)->get();
    }

    public function getChosenDeliveryMethod($id) {
        return $this->where('id', '=', $id)->get();
    }
}
