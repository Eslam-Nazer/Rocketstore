<?php

namespace App\Jobs\Admin\Product;

use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;

class ProductStoreJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public array $request
    ) {}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $title = trim($this->request['title']);
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
    }
}
