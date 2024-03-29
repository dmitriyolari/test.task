<?php

declare(strict_types=1);

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Brand\CreateBrandRequest;
use App\Http\Requests\Brand\UpdateBrandRequest;
use App\Http\Resources\Brand\BrandCollection;
use App\Http\Resources\Brand\BrandResource;
use App\Models\Brand;
use Illuminate\Http\JsonResponse;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;

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
     * @return JsonResponse|BrandResource
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    public function store(CreateBrandRequest $request): JsonResponse|BrandResource
    {
        $validatedDataRequest = $request->validated();
        $brand = Brand::create($validatedDataRequest);
        if (!$brand) {
            return response()->json(['message' => 'An error occurred. Please try again later.']);
        }
        if ($request->file('logo')) {
            $brand->addMedia($request->file('logo'))->toMediaCollection('logo');
        }

        return new BrandResource($brand);
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
     * @return BrandResource|JsonResponse
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    public function update(UpdateBrandRequest $request, Brand $brand): BrandResource|JsonResponse
    {
        if ($brand->update($request->validated())) {
            if ($request->file('logo')) {
                $brand->addMedia($request->file('logo'))->toMediaCollection('logo');
            }
            return new BrandResource($brand);
        }

        return response()->json(['message' => 'Something went wrong. Please try again.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return BrandResource|JsonResponse
     */
    public function destroy(int $id): JsonResponse|BrandResource
    {
        $brand = Brand::findOrFail($id);
        if ($brand->delete()) {
            return new BrandResource($brand);
        }

        return response()->json(['Something went wrong. Please try again.']);
    }

    /**
     * @param int $id
     * @return BrandResource|JsonResponse
     */
    public function removeLogo(int $id): BrandResource|JsonResponse
    {
        $brand = Brand::findOrFail($id);
        if ($brand->clearMediaCollection('logo')) {
            return new BrandResource($brand);
        }

        return response()->json(['Something went wrong. Please try again.']);
    }
}
