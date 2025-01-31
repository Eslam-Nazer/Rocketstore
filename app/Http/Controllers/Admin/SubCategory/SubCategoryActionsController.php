<?php

namespace App\Http\Controllers\Admin\SubCategory;

use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Admin\SubCategory\SubCategoryInfoRequest;
use App\Http\Requests\Admin\SubCategory\SubCategoryEdtingRequest;

class SubCategoryActionsController extends Controller
{
    /**
     * Summary of insertSubCategory
     * @param \App\Http\Requests\Admin\SubCategory\SubCategoryInfoRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function insertSubCategory(SubCategoryInfoRequest $request): RedirectResponse
    {
        $validated = $this->sanitizeInputs($request->validated());

        SubCategory::create([
            'name'                  => $validated['name'],
            'status'                => $validated['status'],
            'meta_title'            => $validated['meta_title'],
            'meta_description'      => $validated['meta_description'],
            'meta_keywords'         => $validated['meta_keywords'],
            'category_id'           => $validated['category'],
            'created_by'            => Auth::user()->id
        ]);
        return redirect()->route('sub_category-list')
            ->with('success', 'Sub Category successfully instered');
    }

    /**
     * Summary of updateSubCategory
     * @param \App\Http\Requests\Admin\SubCategory\SubCategoryEdtingRequest $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateSubCategory(SubCategoryEdtingRequest $request, int $id): RedirectResponse
    {
        $validated = $this->sanitizeInputs($request->validated());

        $subCategory = SubCategory::find($id);
        $subCategory->update([
            'name'                  => $validated['name'],
            'status'                => $validated['status'],
            'meta_title'            => $validated['meta_title'],
            'meta_description'      => $validated['meta_description'],
            'meta_keywords'         => $validated['meta_keywords'],
            'created_by'            => Auth::user()->id,
            'category_id'           => $validated['category']
        ]);
        return redirect()->route('sub_category-list')
            ->with("success", "Sub Category successfully updated");
    }

    /**
     * Summary of deleteSubCategory
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteSubCategory(int $id): RedirectResponse
    {
        SubCategory::where('id', '=', $id)
            ->delete();
        return redirect()->route('sub_category-list')
            ->with('info', 'Sub Category successfully deleted');
    }

    /**
     * Summary of ajaxGetSubCategory
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajaxGetSubCategory(Request $request): JsonResponse
    {
        $conditions['category_id'] = $request->id;
        $sub_categories = SubCategory::active($conditions)->get();
        $html = '';
        foreach ($sub_categories as $sub_category) {
            $html .= "<option name='sub_category' value='{$sub_category->id}'>{$sub_category->name}</option>";
        }
        $data['html'] = $html;
        return response()->json($data);
    }
}
