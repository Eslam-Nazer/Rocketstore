<?php

namespace App\Http\Controllers\Admin;

use App\Jobs\Admin\DeleteAdminJob;
use App\Jobs\Admin\InsertAdminJob;
use App\Jobs\Admin\UpdateAdminJob;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Admin\AdminInfoRequest;
use App\Http\Requests\Admin\AdminEdtingRequest;

class ActionsController extends Controller
{
    /**
     * Summary of insertAdmin
     * @param \App\Http\Requests\Admin\AdminInfoRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function insertAdmin(AdminInfoRequest $request): RedirectResponse
    {
        // dd($request->validated());
        InsertAdminJob::dispatch($request->validated());
        return redirect()->route('admin-list')
            ->with('success', 'Admin successfully inserted');
    }

    /**
     * Summary of updateAdmin
     * @param int $id
     * @param \App\Http\Requests\Admin\AdminEdtingRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateAdmin(int $id, AdminEdtingRequest $request): RedirectResponse
    {
        UpdateAdminJob::dispatch($request->all(), $id);
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
        DeleteAdminJob::dispatch($id);
        return redirect()->route('admin-list')
            ->with('info', 'Admin successfully deleted');
    }
}
