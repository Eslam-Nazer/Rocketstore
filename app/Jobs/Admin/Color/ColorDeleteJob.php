<?php

namespace App\Jobs\Admin\Color;

use App\Models\Color;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class ColorDeleteJob implements ShouldQueue
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
        Color::where('id', '=', $this->id)
            ->delete();
    }
}
