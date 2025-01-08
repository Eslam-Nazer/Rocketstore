<?php

namespace App\Jobs\Admin\Color;

use App\Models\Color;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class ColorUpdateJob implements ShouldQueue
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
        Color::where('id', '=', $this->id)
            ->update([
                'name'          => trim($this->request['name']),
                'code'          => $this->request['code'],
                'status'        => $this->request['status'],
                'created_by'    => Auth::user()->id
            ]);
    }
}
