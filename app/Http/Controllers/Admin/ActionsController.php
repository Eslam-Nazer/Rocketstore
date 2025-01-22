<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Jobs\Admin\DeleteAdminJob;
use App\Jobs\Admin\UpdateAdminJob;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Admin\AdminInfoRequest;
use App\Http\Requests\Admin\AdminEditingRequest;

class ActionsController extends Controller
{
    /**
     * Summary of insertAdmin
     * @param \App\Http\Requests\Admin\AdminInfoRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function insertAdmin(AdminInfoRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        extract($validated);

        $is_admin = '1';
        User::create([
            'name'          => trim($name),
            'email'         => trim($email),
            'password'      => Hash::make($password),
            'is_admin'       => $is_admin,
            'status'        => $status,
            'created_at'    => now()
        ]);
        return redirect()->route('admin-list')
            ->with('success', 'Admin successfully inserted');
    }

    /**
     * Summary of updateAdmin
     * @param \App\Http\Requests\Admin\AdminEditingRequest $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateAdmin(AdminEditingRequest $request, int $id): RedirectResponse
    {
        $validated = $request->validated();
        extract($validated);

        $admin          = User::find($id);
        $admin->name    = trim($name);
        $admin->email   = trim($email);
        if (!empty($password) && $password !== null) {
            $admin->password = $password;
        }
        $admin->status  = $status;
        $admin->save();
        return redirect()->route('admin-list')
            ->with('success', 'Admin successfully updated');
    }

    /**
     * Summary of deleteAdmin
     * @param int $id
     * @return RedirectResponse
     */
    public function deleteAdmin(int $id): RedirectResponse
    {
        $admin = User::find($id);
        $admin->delete();
        return redirect()->route('admin-list')
            ->with('info', 'Admin successfully deleted');
    }
}
