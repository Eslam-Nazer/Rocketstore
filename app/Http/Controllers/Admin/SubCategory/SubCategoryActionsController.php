<?php

namespace App\Http\Controllers\Admin\SubCategory;

use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use App\Jobs\Admin\SubCategory\SubCategoryStoreJob;
use App\Jobs\Admin\SubCategory\SubCategoryDeleteJob;
use App\Jobs\Admin\SubCategory\SubCategoryUpdateJob;
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
        SubCategoryStoreJob::dispatch($request->validated());
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
        SubCategoryUpdateJob::dispatch($request->validated(), $id);
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
        SubCategoryDeleteJob::dispatch($id);
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
