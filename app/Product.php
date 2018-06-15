<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;

class Product extends Model
{
    /**
     * Relationship with Category model
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories() {
        return $this->belongsToMany('App\Category');
    }

    /**
     * Gets new products to main page
     *
     * @param $limit
     * @return mixed
     */
    public function getNewProducts($limit) {
        return $this->orderBy('created_at')->take($limit)->get();
    }

    /**
     * Gets product by id.
     *
     * @param $id
     * @param $fields
     * @return
     */
    public function getProductInfo($id, $fields = false) {
        return !empty($fields) ? $this->getSpecificFields($id, $fields) : $this->getAllFields($id);
    }

    public function getSpecificFields($id, $fields) {
        return $this->select($fields)->where('id', '=', $id)->get();
    }

    public function getAllFields($id) {
        return $this->where('id', '=', $id)->get();
    }
}
