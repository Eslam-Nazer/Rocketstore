<?php

namespace App\Http\Controllers\Admin\Product;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Jobs\Admin\Product\ProductStoreJob;
use App\Jobs\Admin\Product\ProductUpdateJob;
use App\Http\Requests\Admin\Product\ProductInfoRequest;
use App\Http\Requests\Admin\Product\ProductEditingRequest;

class ProductActionsController extends Controller
{

    public function insertProduct(ProductInfoRequest $request)
    {
        ProductStoreJob::dispatch($request->validated());
        return redirect()->route('products-list')
            ->with('success', 'Product successfully created');
    }

    public function updateProduct(ProductEditingRequest $request, int $id)
    {
        ProductUpdateJob::dispatch($request->validated(), $id);
        return redirect()
            ->route('products-list')
            ->with('success', 'Product successfully updated');
    }

    public function deleteProduct()
    {
        //
    }
}
