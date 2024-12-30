<?php

namespace App\Jobs\Admin\Category;

use App\Models\Category;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

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
                'name'              => $this->request['name'],
                'slug'              => $this->request['slug'],
                'status'            => $this->request['status'],
                'meta_title'        => $this->request['meta_title'],
                'meta_description'  => $this->request['meta_description'],
                'meta_keywords'     => $this->request['meta_keywords']
            ]);
    }
}
