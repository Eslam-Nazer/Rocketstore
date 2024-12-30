<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Summary of categoryList
     * @return \Illuminate\Contracts\View\View
     */
    public function categoryList(): View
    {
        $data['header_title'] = 'Category';
        $data['categories'] = Category::getCategories();
        return view('admin.category.list', $data);
    }

    /**
     * Summary of addCategory
     * @return \Illuminate\Contracts\View\View
     */
    public function addCategory(): View
    {
        $data['header_title'] = 'Add Category';
        return view('admin.category.add', $data);
    }

    /**
     * Summary of editCategory
     * @param int $id
     * @return \Illuminate\Contracts\View\View
     */
    public function editCategory(int $id): View
    {
        $data['header_title']   = 'Edit Category';
        $data['category']       = Category::getCategory($id);
        return view('admin.category.edit', $data);
    }
}
