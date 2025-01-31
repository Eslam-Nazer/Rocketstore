<?php

namespace App\Http\Controllers\Admin\Color;

use App\Models\Color;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Admin\Color\ColorInfoRequest;
use App\Http\Requests\Admin\Color\ColorEditingRequest;

class ColorActionsController extends Controller
{
    /**
     * Summary of insertColor
     * @param \App\Http\Requests\Admin\Color\ColorInfoRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function insertColor(ColorInfoRequest $request): RedirectResponse
    {
        $validated = $this->sanitizeInputs($request->validated());

        Color::create([
            'name'          => $validated['name'],
            'code'          => $validated['code'],
            'status'        => $validated['status'],
            'created_by'    => Auth::user()->id
        ]);
        return redirect()
            ->route('color-list')
            ->with('success', 'Color Successfully created');
    }

    /**
     * Summary of updateColor
     * @param \App\Http\Requests\Admin\Color\ColorEditingRequest $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateColor(ColorEditingRequest $request, int $id): RedirectResponse
    {
        $validated = $this->sanitizeInputs($request->validated());

        $color = Color::find($id);
        $color->update([
            'name'          => $validated['name'],
            'code'          => $validated['code'],
            'status'        => $validated['status'],
            'created_by'    => Auth::user()->id
        ]);
        return redirect()->route('color-list')
            ->with('success', 'Color Successfully updated');
    }

    /**
     * Summary of deleteColor
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteColor(int $id): RedirectResponse
    {
        Color::where('id', '=', $id)
            ->delete();
        return redirect()->route('color-list')
            ->with('info', 'Color Successfully deleted');
    }
}
