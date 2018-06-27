<?php
namespace App\Services;


use App\Category;

class BreadcrumbService
{
    /**
     * Makes breadcrumb from ancestors array.
     *
     * @param $ancestors
     * @param null $additionalItems
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function make($ancestors, $additionalItems = null) {
        //skip root category element
        if($ancestors[0] instanceof Category) {
            unset($ancestors[0]);
        }

        $ancestors = $ancestors->toArray();

        if($additionalItems && !empty($additionalItems)) {
            array_push($ancestors, $additionalItems);
        }

        $retData['items'] = $ancestors;

        return view('includes.breadcrumb', $retData);
    }
}