<?php

namespace App\Jobs\Admin;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;

class UpdateAdminJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public array $request,
        public int $id
    ) {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $admin          = User::find($this->id);
        $admin->name    = trim($this->request['name']);
        $admin->email   = trim($this->request['email']);
        if (!empty($this->request['password']) && $this->request['password'] !== null) {
            $admin->password = $this->request['password'];
        }
        $admin->status  = $this->request['status'];
        $admin->save();
    }
}
