<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Jobs\Admin\Category\CategoryStoreJob;
use App\Jobs\Admin\Category\CategoryDeleteJob;
use App\Jobs\Admin\Category\CategoryUpdateJob;
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
        // dd(Auth::user()->id);
        CategoryStoreJob::dispatch($request->validated());
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
        CategoryUpdateJob::dispatch($request->validated(), $id);
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
        CategoryDeleteJob::dispatch($id);
        return redirect()->route('category-list')
            ->with('info', 'Category successfully deleted!');
    }
}
