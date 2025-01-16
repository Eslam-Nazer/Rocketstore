<?php

namespace App\Http\Controllers\Admin\Product;

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
        $product = Product::getProduct($id);
        $data['header_title'] = 'Edit product';
        $data['product'] = $product;
        $data['getSubCategories'] = SubCategory::active(['category_id' => $product->category_id])->get();
        $data['categories'] = Category::active()->get();
        $data['brands'] = Brand::active()->get();
        $data['colors'] = Color::active()->get();
        return view('admin.product.edit', $data);
    }
}
