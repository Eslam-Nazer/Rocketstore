<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class LayoutController extends Controller
{
    /**
     * Summary of showDashboard
     * @return \Illuminate\Contracts\View\View
     */
    public function showDashboard(): View
    {
        $data['header_title'] = 'Dashboard';
        return view('admin.dashboard', $data);
    }

    /**
     * Summary of adminList
     * @return \Illuminate\Contracts\View\View
     */
    public function adminList(): View
    {
        $data['header_title'] = "Admins List";
        $data['admins'] = User::getAminds();
        return view('admin.list', $data);
    }

    /**
     * Summary of addAdmin
     * @return \Illuminate\Contracts\View\View
     */
    public function addAdmin(): View
    {
        $data['header_title'] = "New Admin";
        return view('admin.add', $data);
    }

    /**
     * Summary of editAdmin
     * @return \Illuminate\Contracts\View\View
     */
    public function editAdmin($id): View
    {
        $data['header_title'] = "Edit Admin";
        $data['admin'] = User::getSingleAdmin($id);
        return view('admin.edit', $data);
    }
}
