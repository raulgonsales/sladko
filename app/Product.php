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
     * Gets new products to main page
     *
     * @param $limit
     * @return mixed
     */
    public function getNewProducts($limit) {
        return $this->orderBy('created_at')->take($limit)->get();
    }
}
