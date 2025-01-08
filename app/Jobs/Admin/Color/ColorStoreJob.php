<?php

namespace App\Jobs\Admin\Color;

use App\Models\Color;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;

class ColorStoreJob implements ShouldQueue
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
        Color::create([
            'name'          => trim($this->request['name']),
            'code'          => $this->request['code'],
            'status'        => $this->request['status'],
            'created_by'    => Auth::user()->id
        ]);
    }
}
