<?php

namespace App\Http\Controllers\Admin\Product;

use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Jobs\Admin\Product\ProductStoreJob;
use App\Jobs\Admin\Product\ProductUpdateJob;
use App\Http\Requests\Admin\Product\ProductInfoRequest;
use App\Http\Requests\Admin\Product\ProductEditingRequest;

class ProductActionsController extends Controller
{

    /**
     * Summary of insertProduct
     * @param \App\Http\Requests\Admin\Product\ProductInfoRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function insertProduct(ProductInfoRequest $request): RedirectResponse
    {
        ProductStoreJob::dispatch($request->validated());
        return redirect()->route('products-list')
            ->with('success', 'Product successfully created');
    }

    /**
     * Summary of updateProduct
     * @param \App\Http\Requests\Admin\Product\ProductEditingRequest $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateProduct(ProductEditingRequest $request, int $id): RedirectResponse
    {
        $images = $request->validated('images');
        $validated = Arr::except($request->validated(), ['images']);
        $imagesData = [];
        if ($request->hasFile('images')) {
            foreach ($images as $image) {
                $path = $image->store('tmp', 'public');
                $imagesData[] = [
                    'name'          => $image->getClientOriginalName(),
                    'basename'      => basename($path),
                    'extension'     => $image->getClientOriginalExtension(),
                    'path'          => $path,
                    'size'          => $image->getSize(),
                ];
            }
        }
        ProductUpdateJob::dispatch($validated, $id, $imagesData);
        return redirect()
            ->route('products-list')
            ->with('success', 'Product successfully updated');
    }

    public function deleteProduct()
    {
        //
    }
}
