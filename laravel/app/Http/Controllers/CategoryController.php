<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Models;
use App\Models\Category;


class CategoryController extends Controller
{

    /*
    // --- Get /api/categories
    public function getCategories(){
        return ["message" => "Getting list of categories"];
    }

    // --- Post /api/categories
    public function createCategory(){
        return ["message" => "Creating 1 new category"];
    }

    // --- Get /api/categories/{categoryId}
    public function getCategory($categoryId) {
        return ["message" => "Getting 1 category base on given categoryId"];
    }

    // --- Patch /api/categories/{categoryId}
    public function updateCategory($categoryId) {
        return ["message" => "Updating 1 category base on given categoryId"];
    }

    // --- Delete /api/categories/{categoryId}
    public function deleteCategory($categoryId) {
        return ["message" => "Deleting 1 category base on given categoryId"];
    }
    */
    
    // --- Get /api/categories
    public function getCategories()
    {
        return response()->json(Category::all());
    }

    // --- Post /api/categories
    public function createCategory(Request $request)
    {
        $category = Category::create($request->all());
        return response()->json($category, 201);
    }

    // --- Get /api/categories/{categoryId}
    public function getCategory($categoryId)
    {
        $category = Category::with('products')->findOrFail($categoryId);
        return response()->json($category);
    }

    // --- Patch /api/categories/{categoryId}
    public function updateCategory(Request $request, $categoryId)
    {
        $category = Category::findOrFail($categoryId);
        $category->update($request->all());
        return response()->json($category);
    }

    // --- Delete /api/categories/{categoryId}
    public function deleteCategory($categoryId)
    {
        Category::findOrFail($categoryId)->delete();
        return response()->json(['message' => 'Category deleted with succes']);
    }
    
}