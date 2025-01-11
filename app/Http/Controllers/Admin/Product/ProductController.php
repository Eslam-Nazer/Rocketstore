<?php

namespace App\Http\Controllers\Admin\Product;

use App\Models\User;
use App\Models\Brand;
use App\Models\Color;
use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use function PHPSTORM_META\type;
use Illuminate\Contracts\View\View;

use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    /**
     * Summary of productList
     * @return \Illuminate\Contracts\View\View
     */
    public function productList(): View
    {
        $data['header_title'] = 'Products';
        $data['products'] = Product::getProducts();
        return view('admin.product.list', $data);
    }

    /**
     * Summary of addProduct
     * @return \Illuminate\Contracts\View\View
     */
    public function addProduct(): View
    {
        $data['header_title'] = 'Add new product';
        return view('admin.product.add', $data);
    }

    public function editProduct(int $id)
    {
        $data['header_title'] = 'Edit product';
        $data['product'] = Product::getProduct($id);
        $data['sub_categories'] = SubCategory::getSubCategories();
        $data['categories'] = Category::getCategories();
        $data['brands'] = Brand::getBrands();
        $data['colors'] = Color::getColors();
        return view('admin.product.edit', $data);
    }
}
