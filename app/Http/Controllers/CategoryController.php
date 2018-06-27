<?php

namespace App\Http\Controllers;

use App\Category;
use App\Services\BreadcrumbService;
use Illuminate\Http\Request;
use function Sodium\add;

class CategoryController extends Controller
{
    /**
     * Product model
     *
     * @var Category
     */
    protected $category;

    /**
     * Breadcrumb service.
     *
     * @var BreadcrumbService
     */
    protected $breadcrumbService;

    /**
     * CategoryController constructor.
     *
     * @param Category $category
     * @param BreadcrumbService $breadcrumbService
     */
    public function __construct(Category $category, BreadcrumbService $breadcrumbService)
    {
        $this->category = $category;
        $this->breadcrumbService = $breadcrumbService;
    }

    /**
     * Sets init data to category view
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request) {
        $category = $this->category->getCategoryProducts($request->id)[0];

        $currentCategory = [
            'id' => $category->id,
            'name' => $category->name,
            'description' => $category->description
        ];
        $retData['breadcrumb'] = $this->breadcrumbService->make($category->ancestors, $currentCategory);
        $retData['products'] = $category->products;

        foreach ($category->descendants as $descendant) {
            foreach ($descendant->products as $product) {
                $retData['products']->push($product);
            }
        }

        $retData['title'] = $category->name;

        return view('category', $retData);
    }
}
