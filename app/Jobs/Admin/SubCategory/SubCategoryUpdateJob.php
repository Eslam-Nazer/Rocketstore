<?php

namespace App\Jobs\Admin\SubCategory;

use App\Models\SubCategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;

class SubCategoryUpdateJob implements ShouldQueue
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
        SubCategory::where('id', '=', $this->id)
            ->update([
                'name'                  => $this->request['name'],
                'slug'                  => $this->request['slug'],
                'status'                => $this->request['status'],
                'meta_title'            => $this->request['meta_title'],
                'meta_description'      => $this->request['meta_description'],
                'meta_keywords'         => $this->request['meta_keywords'],
                'created_by'            => Auth::user()->id,
                'category_id'           => $this->request['category']
            ]);
    }
}
