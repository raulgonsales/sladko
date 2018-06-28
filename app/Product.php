<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
     * Relationship with Image model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function images() {
        return $this->belongsToMany('App\Image');
    }

    /**
     * Relationship to Session model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function sessions() {
        return $this->belongsToMany('App\Session');
    }

    /**
     * Gets new products to main page
     *
     * @param $limit
     * @return mixed
     */
    public function getNewProducts($limit) {
        return $this->with(['images' => function ($q) {
            $q->where('product_preview', '=', 1)->take(1);
        }])->orderBy('created_at')->take($limit)->get();
    }

    /**
     * Gets product by id.
     *
     * @param $id
     * @param bool $fields
     * @return mixed
     */
    public function getProductInfo($id, $fields = false) {
        return !empty($fields) ? $this->getSpecificFields($id, $fields) : $this->getAllFields($id);
    }

    /**
     * Gets specified fields from products table.
     *
     * @param $id
     * @param $fields
     * @return mixed
     */
    public function getSpecificFields($id, $fields) {
        return $this->where('id', '=', $id)->select($fields)->get();
    }

    /**
     * Gets all fields from products table
     *
     * @param $id
     * @return mixed
     */
    public function getAllFields($id) {
        return $this->where('id', '=', $id)->get();
    }
}
