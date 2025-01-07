<?php

namespace App\Http\Controllers\Admin\Brand;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Jobs\Admin\Brand\BrandStoreJob;
use App\Jobs\Admin\Brand\BrandDeleteJob;
use App\Jobs\Admin\Brand\BrandUpdateJob;
use App\Http\Requests\Admin\Brand\BrandInfoRequest;
use App\Http\Requests\Admin\Brand\BrandEditingRequest;

class BrandActionsController extends Controller
{
    public function insertBrand(BrandInfoRequest $request)
    {
        BrandStoreJob::dispatch($request->validated());
        return redirect()->route('brand-list')
            ->with('success', 'Brand successfully created');
    }

    public function updateBrand(BrandEditingRequest $request, int $id)
    {
        BrandUpdateJob::dispatch($request->validated(), $id);
        return redirect()->route('brand-list')
            ->with('success', 'Brand Successfully updated');
    }

    public function deleteBrand(int $id)
    {
        BrandDeleteJob::dispatch($id);
        return redirect()->route('brand-list')
            ->with('info', 'Brand successfully deleted');
    }
}
