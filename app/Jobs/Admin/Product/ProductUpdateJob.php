<?php

namespace App\Jobs\Admin\Product;

use App\Models\Product;
use Exception;
use Illuminate\Support\Str;
use App\Models\ProductSize;
use App\Models\ProductColor;
use App\Models\ProductImage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;

class ProductUpdateJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     * @param array $request
     * @param int $id
     * @param array|string|null $images
     */
    public function __construct(
        public array $request,
        public int $id,
        public array|null $images
    ) {}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $title = e(strip_tags(trim($this->request['title'])));
        $slug = Str::slug(strtolower($title));
        $product = Product::findOrFail($this->id);
        $product->update([
            'title'                     => $title,
            'slug'                      => $slug,
            'sku'                       => e(strip_tags(strtoupper(str_replace(' ', '', trim($this->request['sku']))))),
            'price'                     => trim($this->request['price']),
            'old_price'                 => trim($this->request['old_price']) ?? 0,
            'short_description'         => e(strip_tags(trim($this->request['short_description']))),
            'description'               => e(strip_tags(trim($this->request['description']))),
            'additional_information'    => e(strip_tags(trim($this->request['additional_information']))),
            'shipping_returns'          => e(strip_tags(trim($this->request['shipping_returns']))),
            'status'                    => $this->request['status'],
            'brand_id'                  => $this->request['brand'],
            'sub_category_id'           => $this->request['sub_category'],
            'category_id'               => $this->request['category'],
            'color'                     => $this->request['color'],
            'created_by'                => Auth::user()->id,
        ]);

        if (!empty($this->request['color'])) {
            $storedColorArr = [];
            $storedColors = ProductColor::where('product_id', '=', $product->id)
                ->get();
            foreach ($storedColors as $storedColor) {
                $storedColorArr[] = $storedColor->color_id;
            }
            $colorsWillStore = array_diff($this->request['color'], $storedColorArr);
            $colorsWillDelete = array_diff($storedColorArr, $this->request['color']);
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

        if (!empty($this->request['size'])) {
            $requestSize = [];
            $storedSizeArr = [];
            $storedSizes = ProductSize::where('product_id', '=', $product->id)
                ->get();
            foreach ($storedSizes as $storedSize) {
                $storedSizeArr[$storedSize->size] = $storedSize->price;
            }
            foreach ($this->request['size'] as $size) {
                $requestSize[$size['name']] = $size['price'];
            }
            $diffRequestSize = array_diff_assoc($requestSize, $storedSizeArr);
            $diffStoredSize = array_diff_assoc($storedSizeArr, $requestSize);
            // Store or Update
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
                        'price'         => $requestPrice
                    ]);
                }
            }
            // Delete size
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

        if (!empty($this->images) && $this->images !== null) {
            foreach ($this->images as $image) {
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
                } else {
                    throw new Exception('not move');
                }
            }
        }
    }
}
