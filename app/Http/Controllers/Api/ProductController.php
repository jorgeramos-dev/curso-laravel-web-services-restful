<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateProductFormRequest;
use App\Models\Products;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private $product, $totalPages = 4;

    public function __construct(Products $product)
    {
        $this->product = $product;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $product = $this->product->getResults($request->all(), $this->totalPages);
        return response()->json($product);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUpdateProductFormRequest $request)
    {
        $data = $request->all();

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $name = kebab_case($request->name); // helper para formatar nome do arquivo
            $extension = $request->image->extension();

            $nameFile = "{$name}" . "{$extension}";
            $data['image'] = $nameFile;

            $upload = $request->image->storeAs('products', $nameFile); // cria pasta produtos e cria arquivo com nome nameFile
            if (!$upload) {
                return response()->json(['error' => 'Fail Upload'], 500);
            }

        }
        $product = $this->product->create();
        return response()->json($product, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if ($product = $this->product->find($id)) {
            return response()->json(['error' => 'Not Found'], 404);
        }
        return response()->json($product);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreUpdateProductFormRequest $request, string $id)
    {
        if ($product = $this->product->find($id)) {
            return response()->json(['error' => 'Not Found'], 404);
        }

        $product->update($request->all());
        return response()->json($product);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if ($product = $this->product->find($id)) {
            return response()->json(['error' => 'Not Found'], 404);
        }
        $product->delete($product);
        return response()->json(['sucess' => true], 204);
    }
}
