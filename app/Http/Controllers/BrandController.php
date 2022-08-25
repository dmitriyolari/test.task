<?php

namespace App\Http\Controllers;

use App\Http\Requests\Brand\CreateBrandRequest;
use App\Http\Requests\Brand\UpdateBrandRequest;
use App\Http\Resources\BrandCollection;
use App\Http\Resources\BrandResource;
use App\Models\Brand;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return BrandCollection
     */
    public function index(): BrandCollection
    {
        return new BrandCollection(Brand::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateBrandRequest $request
     * @return string
     */
    public function store(CreateBrandRequest $request): string
    {
        $validatedDataRequest = $request->validated();
        $brand = Brand::create($validatedDataRequest);
        if (!$brand) {
            return 'An error occurred. Please try again later.';
        }
        if ($request->file('logo')) {
            $brand->addMedia($request->file('logo'))->toMediaCollection('logo');
        }

        return 'Brand was successfully saved!';
    }

    /**
     * Display the specified resource.
     *
     * @param Brand $brand
     * @return BrandResource
     */
    public function show(Brand $brand): BrandResource
    {
        return new BrandResource($brand);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateBrandRequest $request
     * @param Brand $brand
     * @return string
     */
    public function update(UpdateBrandRequest $request, Brand $brand): string
    {
        if ($brand->update($request->validated())) {
            return 'Brand was successfully modified!';
        }

        return 'Something went wrong. Please try again.';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return string
     */
    public function destroy(int $id): string
    {
        $brand = Brand::findOrFail($id);
        if ($brand->delete()) {
            return 'Brand was successfully removed';
        }

        return 'Something went wrong. Please try again.';
    }
}
