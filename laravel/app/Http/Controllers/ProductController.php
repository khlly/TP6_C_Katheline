<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    /*
    // --- Get /api/products
    public function getProducts(){
        return ["message" => "Getting list of products"];
    }

    // --- Post /api/products
    public function createProducts(){
        return ["message" => "Creating 1 new product"];
    }

    // --- Get /api/products/{productId}
    public function getProduct($productId) {
        return ["message" => "Getting 1 product base on given productId"];
    }

    // --- Patch /api/products/{productId}
    public function updateProduct($productId) {
        return ["message" => "Updating 1 product base on given productId"];
    }

    // --- Delete /api/products/{productId}
    public function deleteProduct($productId) {
        return ["message" => "Deleting 1 product base on given productId"];
    }

    // --- Get /api/categories/{categoryId}/products
    public function getProductsFromCat($categoryId) {
        return ["message" => "Getting list of products base on given categoryId"];

    }

    */
    // --- Get /api/products
    public function getProducts()
    {
        return response()->json(Product::all());
    }

    // --- Post /api/products
    public function createProducts(Request $request)
    {
        //dd($request->all());
        $product = Product::create($request->all());
        return response()->json($product, 201);
    }

    // --- Get /api/products/{productId}
    public function getProduct($productId)
    {
        $product = Product::with('category')->findOrFail($productId);
        return response()->json($product);
    }

    // --- Patch /api/products/{productId}
    public function updateProduct(Request $request, $productId)
    {
        $product = Product::findOrFail($productId);
        $product->update($request->all());
        return response()->json($product);
    }

    // --- Delete /api/products/{productId}
    public function deleteProduct($productId)
    {
        Product::findOrFail($productId)->delete();
        return response()->json(['message' => 'Product deleted with succes']);
    }

    // --- Get /api/categories/{categoryId}/products
    public function getProductsFromCat($categoryId)
    {
        $category = Category::with('products')->findOrFail($categoryId);
        return response()->json($category->products);
    }
    
}
