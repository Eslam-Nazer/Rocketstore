<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Jobs\Admin\InsertAdminJob;
use App\Http\Controllers\Controller;
use App\Jobs\Admin\DeleteAdminJob;
use App\Jobs\Admin\UpdateAdminJob;
use Illuminate\Http\RedirectResponse;

class ActionsController extends Controller
{
    /**
     * Summary of insertAdmin
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function insertAdmin(Request $request): RedirectResponse
    {
        InsertAdminJob::dispatch($request->all());
        return redirect()->route('admin-list')
            ->with('success', 'Admin successfully inserted');
    }

    /**
     * Summary of updateAdmin
     * @param int $id
     * @param \Illuminate\Http\Request $request
     * @return RedirectResponse
     */
    public function updateAdmin(int $id, Request $request): RedirectResponse
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
