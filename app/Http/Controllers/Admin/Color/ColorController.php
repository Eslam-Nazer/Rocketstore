<?php

namespace App\Http\Controllers\Admin\Color;

use App\Models\Color;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;

class ColorController extends Controller
{
    /**
     * Summary of colorList
     * @return \Illuminate\Contracts\View\View
     */
    public function colorList(): View
    {
        $data['header_title'] = 'Colors List';
        $data['colors'] = Color::getColors();
        return view('admin.color.list', $data);
    }

    /**
     * Summary of addColor
     * @return \Illuminate\Contracts\View\View
     */
    public function addColor(): View
    {
        $data['header_title'] = 'Add New Color';
        return view('admin.color.add', $data);
    }

    /**
     * Summary of editColor
     * @param int $id
     * @return \Illuminate\Contracts\View\View
     */
    public function editColor(int $id): View
    {
        $data['header_title'] = 'Edit Color';
        $data['color'] = Color::getColor($id);
        return view('admin.color.edit', $data);
    }
}
