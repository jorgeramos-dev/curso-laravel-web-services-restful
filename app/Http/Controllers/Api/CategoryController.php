<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoriesFormRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function index(Request $request)
    {
        $categories = $this->category->getResults($request->name);
        return response()->json($categories);
    }

    public function show($id)
    {
        if (!$category = $this->category->find($id)) {
            return response()->json(['error' => 'Category Not Found'], 404);
        }
        return response()->json($category);
    }

    public function store(CategoriesFormRequest $request)
    {
        $category = $this->category->create($request->all());
        
        return response()->json($category, 201);
    }

    public function update(CategoriesFormRequest $request, $id)
    {
        if (!$category = $this->category->find($id)) {
            return response()->json(['error' => 'Category Not Found'], 404);
        }
        $category->update($request->all());
        
        return response()->json($category);
    }

    public function destroy($id)
    {
        if (!$category = $this->category->find($id)) {
            return response()->json(['error' => 'Category Not Found'], 404);
        }
        
        $category->delete();
        return response()->json(['sucess' => true], 204);
    }
}
