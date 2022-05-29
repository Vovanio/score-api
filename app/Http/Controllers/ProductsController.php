<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $products = Products::all();

        return response()->json([
            'products' => [
                'items' => $products
            ]
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'price' => 'required|integer',
            'img' => 'nullable|image'
        ]);

        if ($validator->fails()){
            return response()->json([
                'error' => [
                    'code' => 422,
                    'message' => 'Validation error',
                    'errors' => $validator->errors()
                ]
            ], 422);
        }

        $path = $request->file('img')->store('media/images/uploads', 'public');

        $products = new Products();
        $products->title = $request->title;
        $products->price = $request->price;
        $products->img_src = $path;
        $products->save();

        return response()->json([], 204);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function show(Products $products)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function edit(Products $products)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Products $products)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|integer',
            'title' => 'required|string',
            'price' => 'required|integer',
            'img' => 'nullable|image'
        ]);

        if ($validator->fails()){
            return response()->json([
                'error' => [
                    'code' => 422,
                    'message' => 'Validation error',
                    'errors' => $validator->errors()
                ]
            ], 422);
        }

        $path = $request->file('img')->store('media/images/uploads', 'public');

        $products = Products::find($request->id);
        $products->title = $request->title;
        $products->price = $request->price;
        $products->img_src = $path;
        $products->save();

        return response()->json([], 204);
    }

    /**
     * Remove the specified resource from storage.
     * @param \Illuminate\Http\Request $request
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request, Products $products)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|integer'
        ]);

        if ($validator->fails()){
            return response()->json([
                'error' => [
                    'code' => 422,
                    'message' => 'Validation error',
                    'errors' => $validator->errors()
                ]
            ], 422);
        }

        Products::find($request->id)
            ->delete();

        return response()->json([], 204);
    }
}
