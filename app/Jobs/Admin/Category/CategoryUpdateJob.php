<?php

namespace App\Jobs\Admin\Category;

use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;

class CategoryUpdateJob implements ShouldQueue
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
        Category::where('id', '=', $this->id)
            ->update([
                'name'              => trim($this->request['name']),
                'slug'              => trim($this->request['slug']),
                'status'            => trim($this->request['status']),
                'meta_title'        => trim($this->request['meta_title']),
                'meta_description'  => trim($this->request['meta_description']),
                'meta_keywords'     => trim($this->request['meta_keywords']),
                'created_by'        => Auth::user()->id
            ]);
    }
}
