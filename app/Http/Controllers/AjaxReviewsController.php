<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Review;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\View;

class AjaxReviewsController extends AjaxController
{
    private $reviewViewName = 'includes.reviews';

    /**
     * Get reviews from database
     *
     * @param $request
     * @return mixed
     */
    public function getLimitedReviews($request) {
        return $this->isFirstlyLoadedReviews($request)
            ? Review::getReviews($request->limit, false)
            : Review::getReviews($request->limit, $request->startedDate);
    }

    /**
     * Checks if reviews were loaded firstly (Haven`t clicked on more reviews button)
     *
     * @param $request
     * @return bool
     */
    public function isFirstlyLoadedReviews($request) {
        return !!($request->startedDate === 'false');
    }

    /**
     * Render reviews view from reviews data
     *
     * @param $reviewPortion
     * @return string
     */
    public function renderReviewsView($reviewPortion) {
        return View::make($this->reviewViewName, [
            'reviews' => (isset($reviewPortion) && !empty($reviewPortion)) ? $reviewPortion : false
        ])->render();
    }

    /**
     * Gets last review`s date
     *
     * @param $reviewPortion
     * @return mixed
     */
    public function getLastReviewDate($reviewPortion) {
        return $reviewPortion[count($reviewPortion) - 1]['created_at'];
    }

    /**
     * Loads reviews from database and render reviews view
     *
     * @param Request $request
     * @return bool|\Illuminate\Http\JsonResponse
     */
    public function loadReviews(Request $request) {
        if ($request->ajax()) {
            $reviewPortion = $this->getLimitedReviews($request);

            if (count($reviewPortion)) {
                return Response::json([
                    'html' => $this->renderReviewsView($reviewPortion),
                    'lastItemDate' => $this->getLastReviewDate($reviewPortion)
                ]);
            } else {
                return Response::json(false);
            }
        }

        return false;
    }
}
