<?php

namespace App\Jobs\Admin\Category;

use App\Models\Category;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class CategoryDeleteJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public int $id
    ) {}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Category::where('id', '=', $this->id)
            ->delete();
    }
}
