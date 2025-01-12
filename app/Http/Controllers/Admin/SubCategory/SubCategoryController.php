<?php

namespace App\Http\Controllers\Admin\SubCategory;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;

class SubCategoryController extends Controller
{
    /**
     * Summary of subCategoryList
     * @return \Illuminate\Support\Facades\View
     */
    public function subCategoryList(): View
    {
        $data['header_title'] = 'SubCategory';
        $data['subCategories'] = SubCategory::getSubCategories();
        return view('admin.sub-category.list', $data);
    }

    public function addSubCategory(): View
    {
        $data['header_title'] = 'Add SubCategory';
        $data['categories'] = Category::active()->get();
        return view('admin.sub-category.add', $data);
    }

    public function editSubCategory(int $id): View
    {
        $data['header_title']   = 'Edit SubCategory';
        $data['categories']     = Category::active()->get();
        $data['sub_category']   = SubCategory::getSubCategory($id);
        return view('admin.sub-category.edit', $data);
    }
}
