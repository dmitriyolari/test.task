<?php

namespace App\Http\Controllers;

use App\Http\Requests\BrandRequest;
use App\Http\Resources\BrandCollection;
use App\Http\Resources\BrandResource;
use App\Models\Brand;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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

//    /**
//     * Store a newly created resource in storage.
//     *
//     * @param BrandRequest $request
//     * @return BrandResource
//     */
    public function store(BrandRequest $request)
    {
        $validatedDataRequest = $request->validated();

        if (Brand::create($validatedDataRequest)) {
            return 'Brand was successfully saved!';
        }

        return 'An error occurred. Please try again later.';
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return string
     */
    public function destroy(int $id): string
    {
        if (Brand::destroy($id)) {
            return response()->json('Brand was successfully removed');
        }
    }
}
