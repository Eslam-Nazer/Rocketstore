<?php

namespace App\Jobs\Admin;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;

class InsertAdminJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public array $request
    ) {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $is_admin = 1;
        $status = (int) $this->request['status'];
        User::create([
            'name'          => $this->request['name'],
            'email'         => $this->request['email'],
            'password'      => Hash::make($this->request['password']),
            'is_admin'       => $is_admin,
            'status'        => $status,
            'created_at'    => now()
        ]);
    }
}
