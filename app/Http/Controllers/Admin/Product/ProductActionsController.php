<?php

namespace App\Http\Controllers\Admin\Product;

use App\Models\Product;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use App\Models\ProductSize;
use App\Models\ProductColor;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
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
        $validated = $request->validated();
        extract($validated);

        $title = trim($title);
        $product = Product::create([
            'title'     => $title,
            'created_by'   => Auth::user()->id
        ]);

        $slug  = Str::slug($title);
        $slugExists = Product::where('slug', '=', $slug)->exists();
        if ($slugExists) {
            $slug = Str::slug("{$title} {$product->id} " . rand(000, 999));
        }
        Product::where('id', '=', $product->id)
            ->update([
                'slug'      => $slug
            ]);
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
        extract($validated);

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

        $title = e(strip_tags(trim($title)));
        $slug = Str::slug(strtolower($title));
        $product = Product::findOrFail($id);
        $product->update([
            'title'                     => $title,
            'slug'                      => $slug,
            'sku'                       => e(strip_tags(strtoupper(str_replace(' ', '', trim($sku))))),
            'price'                     => trim($price),
            'old_price'                 => trim($old_price) ?? 0,
            'short_description'         => e(strip_tags(trim($short_description))),
            'description'               => e(strip_tags(trim($description))),
            'additional_information'    => e(strip_tags(trim($additional_information))),
            'shipping_returns'          => e(strip_tags(trim($shipping_returns))),
            'status'                    => $status,
            'brand_id'                  => $brand,
            'sub_category_id'           => $sub_category,
            'category_id'               => $category,
            'created_by'                => Auth::user()->id,
        ]);

        // Color issues
        if (!empty($color)) {
            $storedColorArr = [];
            $storedColors = ProductColor::where('product_id', '=', $product->id)
                ->get();
            foreach ($storedColors as $storedColor) {
                $storedColorArr[] = $storedColor->color_id;
            }
            $colorsWillStore = array_diff($color, $storedColorArr);
            $colorsWillDelete = array_diff($storedColorArr, $color);
            if (!empty($colorsWillStore)) {
                foreach ($colorsWillStore as $willStore) {
                    ProductColor::create([
                        'product_id'        => $product->id,
                        'color_id'          => $willStore
                    ]);
                }
            }
            if (!empty($colorsWillDelete)) {
                foreach ($colorsWillDelete as $willDelete) {
                    ProductColor::where('color_id', '=', $willDelete)
                        ->forceDelete();
                }
            }
        }

        // Size issues
        if (!empty($size)) {
            $requestSize = [];
            $storedSizeArr = [];

            $storedSizes = ProductSize::where('product_id', '=', $product->id)
                ->get();

            foreach ($storedSizes as $storedSize) {
                $storedSizeArr[$storedSize->size] = $storedSize->price;
            }
            foreach ($size as $storeSize) {
                $requestSize[$storeSize['name']] = $storeSize['price'];
            }

            $diffRequestSize = array_diff_assoc($requestSize, $storedSizeArr);
            $diffStoredSize = array_diff_assoc($storedSizeArr, $requestSize);
            // Store or Update
            if (!empty($diffRequestSize)) {
                foreach ($diffRequestSize as $requestSize => $requestPrice) {
                    if (array_key_exists($requestSize, $storedSizeArr)) {
                        if ($storedSizeArr[$requestSize] != $requestPrice) {
                            ProductSize::where('product_id', '=', $product->id)
                                ->where('size', '=', $requestSize)
                                ->update([
                                    'price'     => $requestPrice ?? 0
                                ]);
                        } elseif ($storedSizeArr[$requestSize] == $requestPrice) {
                            break;
                        }
                    } elseif (in_array($requestPrice, $storedSizeArr)) {
                        if ($storedSizeArr[$requestSize] ?? null == $requestPrice) {
                            break;
                        }
                        ProductSize::where('product_id', '=', $product->id)
                            ->where('price', '=', $requestPrice)
                            ->update([
                                'size'     => $requestSize
                            ]);
                    } elseif (!empty($requestSize) || $requestSize != null) {
                        ProductSize::create([
                            'product_id'    => $product->id,
                            'size'          => $requestSize,
                            'price'         => $requestPrice ?? 0
                        ]);
                    }
                }
            }

            // Delete size
            if (!empty($diffStoredSize)) {
                foreach ($diffStoredSize as $storedSize => $storedSizePrice) {
                    $sizeFound = array_key_exists($storedSize, $diffRequestSize);
                    $priceFound = in_array($storedSizePrice, $diffRequestSize);
                    if (!$sizeFound && !$priceFound) {
                        ProductSize::where('product_id', '=', $product->id)
                            ->where('size', '=', $storedSize)
                            ->where('price', '=', $storedSizePrice)
                            ->forceDelete();
                    }
                }
            }
        }

        // Images issues
        if (!empty($imagesData) && $imagesData !== null) {
            foreach ($imagesData as $image) {
                $storePath = 'storage' . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'product' . DIRECTORY_SEPARATOR . $image['basename'];
                if (
                    Storage::disk('public')
                    ->exists(DIRECTORY_SEPARATOR . $image['path'])
                ) {
                    Storage::disk('public')
                        ->move(
                            DIRECTORY_SEPARATOR . $image['path'],
                            DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'product' . DIRECTORY_SEPARATOR . $image['basename']
                        );

                    ProductImage::create([
                        'name'          => $image['name'],
                        'basename'      => $image['basename'],
                        'extension'     => $image['extension'],
                        'path'          => $storePath,
                        'size'          => $image['size'],
                        'product_id'    => $product->id
                    ]);

                    Storage::disk('public')->delete(DIRECTORY_SEPARATOR . $image['path']);
                }
            }
        }

        return redirect()
            ->route('products-list')
            ->with('success', 'Product successfully updated');
    }

    public function deleteProduct()
    {
        //
    }

    public function orderingImages(Request $request)
    {
        if (!empty($request->photo_id)) {
            foreach ($request->photo_id as $sortingImage => $imageId) {
                $sortImage = ProductImage::find($imageId);
                $sortImage->ordering = $sortingImage + 1;
                $sortImage->save();
            }
        }
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
}
