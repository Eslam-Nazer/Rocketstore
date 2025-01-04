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
        $is_admin = '1';
        User::create([
            'name'          => trim($this->request['name']),
            'email'         => trim($this->request['email']),
            'password'      => Hash::make($this->request['password']),
            'is_admin'       => $is_admin,
            'status'        => $this->request['status'],
            'created_at'    => now()
        ]);
    }
}
