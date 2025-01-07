<?php

namespace App\Jobs\Admin\Brand;

use App\Models\Brand;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;

class BrandStoreJob implements ShouldQueue
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
        $slug = strtolower(trim($this->request['slug']));
        Brand::create([
            'name'              => trim($this->request['name']),
            'slug'              => Str::slug($slug),
            'status'            => $this->request['status'],
            'meta_title'        => trim($this->request['meta_title']),
            'meta_description'  => trim($this->request['meta_description']),
            'meta_keywords'     => trim($this->request['meta_keywords']),
            'created_by'        => Auth::user()->id
        ]);
    }
}
