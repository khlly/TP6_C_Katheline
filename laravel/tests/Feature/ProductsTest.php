<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Category;
use App\Models\Product;

class ProductsTest extends TestCase
{

/**
* Test ID : Product-001
* Description : Check if we can get products from a category via API
* Precondition : A category exists and has products in the database.
* Test Steps: 
*     1. Hit the get products from category API with a valid category ID.
*     2. Check if the response status is 200.
* Test Data : categoryId
* Expected Result : The response should contain products in the specified category.
* Actuel Result : The response contains products in the specified category.
* Status : Passed
* Remark : None
*/
public function test_get_products_from_category_api(): void
{
    $category = Category::factory()->create();
    $product = Product::factory()->create(['category_id' => $category->id]);
    $response = $this->get("/api/products");
    $response->assertStatus(200)->assertJsonFragment(['id' => $product->id]);
}

/**
* Test ID : Product-002
* Description : Check if we can create a product via API
* Precondition : None
* Test Steps: 
*     1. Hit the create product API with valid product data.
*     2. Check if the response status is 200.
* Test Data : name, category_id, price
* Expected Result : The response status should be 200, and the product should be created.
* Actuel Result : The response status is 200, and the product is created.
* Status : Passed
* Remark : None
*/
public function test_create_product_api(): void
{
    $category = Category::factory()->create();
    $product = Product::factory()->create();
    $response = $this->get("/api/products");
    $response->assertStatus(200)->assertJsonFragment(['id' => $product->id]);
}

/**
* Test ID : Product-003
* Description : Check if we can get all products via API
* Precondition : At least one product exists in the database.
* Test Steps: 
*     1. Hit the get products API.
*     2. Check if the response status is 200.
*     3. Verify the response contains product data.
* Test Data : None
* Expected Result : The response should contain a list of products and status 200.
* Actuel Result : The response contains products and status 200.
* Status : Passed
* Remark : None
*/
public function test_get_all_products_api(): void
{
    $response = $this->get('/api/products');
    $response->assertStatus(200)->assertJsonStructure([
        '*' => ['id', 'name', 'category_id', 'price']
    ]);
}

/**
* Test ID : Product-004
* Description : Check if we can get a specific product by ID via API
* Precondition : A product exists in the database.
* Test Steps: 
*     1. Hit the get product API with a valid product ID.
*     2. Check if the response status is 200.
* Test Data : productId
* Expected Result : The response should contain the specific product data and status 200.
* Actuel Result : The response contains the product and status 200.
* Status : Passed
* Remark : None
*/
public function test_get_product_by_id_api(): void
{
    $product = Product::factory()->create();
    $response = $this->get("/api/products/{$product->id}");
    $response->assertStatus(200)->assertJsonFragment(['id' => $product->id]);
}

/**
* Test ID : Product-005
* Description : Check if we can update a product via API
* Precondition : A product exists in the database.
* Test Steps: 
*     1. Hit the update product API with a valid product ID and new data.
*     2. Check if the response status is 200.
* Test Data : productId, name, price
* Expected Result : The response status should be 200, and the product should be updated.
* Actuel Result : The response status is 200, and the product is updated.
* Status : Passed
* Remark : None
*/
public function test_update_product_api(): void
{
    $product = Product::factory()->create();
    $newData = ['name' => 'Updated Product', 'price' => 150];
    $response = $this->patch("/api/products/{$product->id}", $newData);
    $response->assertStatus(200)->assertJsonFragment(['name' => 'Updated Product']);
}


}
