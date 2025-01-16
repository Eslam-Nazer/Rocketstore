<?php

namespace App\Jobs\Admin\Product;

use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use App\Models\ProductColor;
use Illuminate\Support\Str;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class ProductUpdateJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public array $request,
        public int $id
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
            'old_price'                 => trim($this->request['old_price']),
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
            $productColors = ProductColor::where('product_id', '=', $product->id)
                ->exists();
            if ($productColors) {
                ProductColor::where('product_id', '=', $product->id)
                    ->forceDelete();
            }
            foreach ($this->request['color'] as $color) {
                ProductColor::create([
                    'product_id'        => $product->id,
                    'color_id'          => $color
                ]);
            }
        }
    }
}
