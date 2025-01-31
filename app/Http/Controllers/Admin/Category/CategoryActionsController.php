<?php

namespace App\Http\Controllers\Admin\Category;

use App\Models\Category;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Admin\Category\CategoryInfoRequest;
use App\Http\Requests\Admin\Category\CategoryEditingRequest;

class CategoryActionsController extends Controller
{
    /**
     * Summary of insertCategory
     * @param \App\Http\Requests\Admin\Category\CategoryInfoRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function insertCategory(CategoryInfoRequest $request): RedirectResponse
    {
        $validated = $this->sanitizeInputs($request->validated());

        Category::create([
            'name'              => $validated['name'],
            'status'            => $validated['status'],
            'meta_title'        => $validated['meta_title'],
            'meta_description'  => $validated['meta_description'],
            'meta_keywords'     => $validated['meta_keywords'],
            'created_by'        => Auth::user()->id,
        ]);
        return redirect()
            ->route('category-list')
            ->with('success', 'Category successfully saved');
    }

    /**
     * Summary of updateCategory
     * @param \App\Http\Requests\Admin\Category\CategoryEditingRequest $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateCategory(CategoryEditingRequest $request, int $id): RedirectResponse
    {
        $validated = $this->sanitizeInputs($request->validated());

        $category = Category::find($id);
        $category->update([
            'name'              => $validated['name'],
            'status'            => $validated['status'],
            'meta_title'        => $validated['meta_title'],
            'meta_description'  => $validated['meta_description'],
            'meta_keywords'     => $validated['meta_keywords'],
            'created_by'        => Auth::user()->id
        ]);
        return redirect()
            ->route('category-list')
            ->with('success', 'Category successfully updated');
    }

    /**
     * Summary of deleteCategory
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteCategory(int $id): RedirectResponse
    {
        Category::where('id', '=', $id)
            ->delete();
        return redirect()->route('category-list')
            ->with('info', 'Category successfully deleted!');
    }
}
