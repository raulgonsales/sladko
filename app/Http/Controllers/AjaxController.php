<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Review;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\View;

class AjaxController extends Controller
{
    public function loadReviews(Request $request) {
        if ($request->ajax()) {
            if($request->startedDate === 'false') {
                $reviewPortion = Review::getReviews($request->limit, false);
            } else {
                $reviewPortion = Review::getReviews($request->limit, $request->startedDate);
            }

            $html = View::make('includes.reviews', [
                'reviews' => isset($reviewPortion) ? $reviewPortion : false
            ])->render();

            if (count($reviewPortion)) {
                return Response::json([
                    'html' => $html,
                    'lastItemDate' => $reviewPortion[count($reviewPortion) - 1]['created_at']
                ]);
            } else {
                return Response::json(false);
            }
        }

        return false;
    }
}
