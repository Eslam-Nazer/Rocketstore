<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;

class ProductController extends Controller
{
    /**
     * Summary of categories
     * @param string $slug
     * @return \Illuminate\Contracts\View\View
     */
    public function categories(string $slug = null): View
    {
        if (filled($slug)) {
            $prodcutsCategory = Category::active(['slug', '=', $slug])->firstOrFail();
            return view('home.product.list', compact('prodcutsCategory'));
        }
        abort(404);
    }
}
