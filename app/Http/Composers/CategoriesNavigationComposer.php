<?php
namespace App\Http\Composers;

use App\Category;
use Illuminate\Contracts\View\View;

class CategoriesNavigationComposer
{
    /**
     * Category model instance.
     *
     * @var Category
     */
    protected $category;

    /**
     * CategoriesNavigationComposer constructor.
     *
     * @param Category $category
     */
    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    /**
     * Compose view.
     *
     * @param View $view
     */
    public function compose(View $view) {
        $categories = $this->category->get()->toTree();
        $view->with('categories', $categories[0]->children);
    }
}