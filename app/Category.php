<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

class Category extends Model
{
    use NodeTrait;

    /**
     * Relationship with Product model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function products() {
        return $this->belongsToMany('App\Product');
    }

    /**
     * Gets all products from category tree.
     *
     * @param $id
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getCategoryProducts($id) {
        return $this->with(['ancestors', 'descendants' => function($q) {
            $q->with(['products' => function($q1) {
                $q1->with(['images' => function($q2) {
                    $q2->where('product_preview', '=', 1)->take(1);
                }]);
            }]);
        }, 'products' => function($q) {
            $q->with(['images' => function($q1) {
                $q1->where('product_preview', '=', 1)->take(1);
            }]);
        }])->where('id', '=', $id)->get();
    }
}
