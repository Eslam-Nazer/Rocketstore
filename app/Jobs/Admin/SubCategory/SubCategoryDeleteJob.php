<?php

namespace App\Jobs\Admin\SubCategory;

use App\Models\SubCategory;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;

class SubCategoryDeleteJob implements ShouldQueue
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
        SubCategory::where('id', '=', $this->id)
            ->delete();
    }
}
