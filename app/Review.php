<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Review extends Model
{
    protected $fillable = ['name', 'created_at'];

    public function scopeGetReviews($query, $limit, $date) {
        if($date) {
            $join = $query->where('created_at', '<', $date)->orderBy('created_at', 'desc')->take($limit)->get();
        } else {
            $join = $query->take($limit)->orderBy('created_at', 'desc')->get();
        }
        return $join;
    }
}
