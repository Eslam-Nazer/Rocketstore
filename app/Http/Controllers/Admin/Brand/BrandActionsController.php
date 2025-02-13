<?php

namespace App\Http\Controllers\Admin\Brand;

use App\Models\Brand;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Admin\Brand\BrandInfoRequest;
use App\Http\Requests\Admin\Brand\BrandEditingRequest;

class BrandActionsController extends Controller
{
    /**
     * Summary of insertBrand
     * @param \App\Http\Requests\Admin\Brand\BrandInfoRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function insertBrand(BrandInfoRequest $request): RedirectResponse
    {
        $validated = $this->sanitizeInputs($request->validated());

        Brand::create([
            'name'              => $validated['name'],
            'status'            => $validated['status'],
            'meta_title'        => $validated['meta_title'],
            'meta_description'  => $validated['meta_description'],
            'meta_keywords'     => $validated['meta_keywords'],
            'created_by'        => Auth::user()->id
        ]);
        return redirect()->route('brand-list')
            ->with('success', 'Brand successfully created');
    }

    /**
     * Summary of updateBrand
     * @param \App\Http\Requests\Admin\Brand\BrandEditingRequest $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateBrand(BrandEditingRequest $request, int $id): RedirectResponse
    {
        $validated = $this->sanitizeInputs($request->validated());

        $brand = Brand::find($id);
        $brand->update([
            'name'              => $validated['name'],
            'status'            => $validated['status'],
            'meta_title'        => $validated['meta_title'],
            'meta_description'  => $validated['meta_description'],
            'meta_keywords'     => $validated['meta_keywords'],
            'created_by'        => Auth::user()->id
        ]);
        return redirect()->route('brand-list')
            ->with('success', 'Brand Successfully updated');
    }

    /**
     * Summary of deleteBrand
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteBrand(int $id): RedirectResponse
    {
        Brand::where('id', '=', $id)
            ->delete();
        return redirect()->route('brand-list')
            ->with('info', 'Brand successfully deleted');
    }
}
