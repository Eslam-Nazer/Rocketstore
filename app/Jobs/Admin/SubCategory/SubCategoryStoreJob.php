<?php

namespace App\Jobs\Admin\SubCategory;

use App\Models\SubCategory;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Auth;

class SubCategoryStoreJob implements ShouldQueue
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
        SubCategory::create([
            'name'                  => $this->request['name'],
            'slug'                  => $this->request['slug'],
            'status'                => $this->request['status'],
            'meta_title'            => $this->request['meta_title'],
            'meta_description'      => $this->request['meta_description'],
            'meta_keywords'         => $this->request['meta_keywords'],
            'category_id'           => $this->request['category'],
            'created_by'            => Auth::user()->id
        ]);
    }
}
