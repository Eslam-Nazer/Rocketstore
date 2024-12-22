<?php

namespace App\Jobs\Admin;

use App\Models\User;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;

class DeleteAdminJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     * @param int $id
     */
    public function __construct(
        public int $id
    ) {}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $admin = User::find($this->id);
        $admin->delete();
    }
}
