<?php

namespace App\Http\Controllers\Admin\Brand;

use App\Models\Brand;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BrandController extends Controller
{
    public function brandList()
    {
        $data['header_title'] = 'Brands';
        $data['brands'] = Brand::getBrands();
        return view('admin.brand.list', $data);
    }

    public function addBrand()
    {
        $data['header_title'] = 'Add Brand';
        return view('admin.brand.add', $data);
    }

    public function editBrand(int $id)
    {
        $data['header_title'] = 'Edit Brand';
        $data['brand'] = Brand::getBrand($id);
        return view('admin.brand.edit', $data);
    }
}
