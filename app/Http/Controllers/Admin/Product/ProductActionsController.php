<?php

namespace App\Http\Controllers\Admin\Product;

use Illuminate\Support\Arr;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
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

    /**
     * Summary of deleteProductImage
     * @param int $productId
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteProductImage(int $productId, int $id): RedirectResponse
    {
        $deleteImage = ProductImage::where('id', "=", $id)
            ->where('product_id', '=', $productId)
            ->firstOrFail();
        $imageExists = Storage::disk('public')
            ->exists(DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'product' . DIRECTORY_SEPARATOR . $deleteImage->basename);
        if (!$imageExists) {
            return redirect()->route('edit-product')
                ->with('error', 'Some thing wrong but image not deleted');
        }
        Storage::disk('public')
            ->delete(DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'product' . DIRECTORY_SEPARATOR . $deleteImage->basename);
        $deleteImage->forceDelete();
        return redirect()->route('edit-product', $productId)
            ->with('info', 'Image successfully deleted');
    }

    public function deleteProduct()
    {
        //
    }
}
