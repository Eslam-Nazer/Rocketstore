<?php

namespace App\Jobs\Admin\Brand;

use App\Models\Brand;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;

class BrandDeleteJob implements ShouldQueue
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
        Brand::where('id', '=', $this->id)
            ->delete();
    }
}
