<?php

namespace Tests\Feature;
use App\Models\Category;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoriesTest extends TestCase 
{

/**
* Test ID : Category-001
* Description : Check if we can acces the get all categories api
* Precondition : None
* Test Steps: 1. Hit the get all categories api
*		2. Check if the response status is 200
* Test Data : None
* Expected Result : The response status should be 200
* Actuel Result : The response status is 200
* Status : Passed
* Remark : None
*/	

public function test_acces_all_categories_api(): void
{
    $response = $this->get('/api/categories');
    
    $response->assertStatus(200);
    
    $response->assertJsonStructure([
        '*' => ['id', 'name'] 
    ]);
    
    $response->assertJson([]);
}


/**
* Test ID : Category-002
* Description : Check if we can create a category api
* Precondition : None
* Test Steps: 
*     1. Hit the create category api with valid data.
*     2. Check if the response status is 201.
* Test Data : name
* Expected Result : The response status should be 201
* Actuel Result : The response status is 201
* Status : Passed
* Remark : None
*/
public function test_create_category_api(): void
{
    $data = ['name' => 'New Category'];
    $response = $this->post('/api/categories', $data);
    $response->assertStatus(201);

}

/**
* Test ID : Category-004
* Description : Check if we can get a specific category by ID via API
* Precondition : A category exists in the database.
* Test Steps: 
*     1. Hit the get category API with a valid category ID.
*     2. Check if the response status is 200.
* Test Data : categoryId
* Expected Result : The response should contain the specific category data and status 200.
* Actuel Result : The response contains the category and status 200.
* Status : Passed
* Remark : None
*/
public function test_get_category_by_id_api(): void
{
    $category = Category::factory()->create(); 
    $response = $this->get("/api/categories/{$category->id}");
    $response->assertStatus(200)->assertJsonFragment(['id' => $category->id]);
}

/**
* Test ID : Category-005
* Description : Check if we can update a category via API
* Precondition : A category exists in the database.
* Test Steps: 
*     1. Hit the update category API with a valid category ID and new data.
*     2. Check if the response status is 200.
* Test Data : categoryId, name
* Expected Result : The response status should be 200, and the category should be updated.
* Actuel Result : The response status is 200, and the category is updated.
* Status : Passed
* Remark : None
*/
public function test_update_category_api(): void
{
    $category = Category::factory()->create();
    $newData = ['name' => 'Updated Category'];
    $response = $this->patch("/api/categories/{$category->id}", $newData);
    $response->assertStatus(200)->assertJsonFragment(['name' => 'Updated Category']);
}

/**
* Test ID : Category-006
* Description : Check if we can delete a category via API
* Precondition : A category exists in the database.
* Test Steps: 
*     1. Hit the delete category API with a valid category ID.
*     2. Check if the response status is 200.
* Test Data : categoryId
* Expected Result : The response status should be 200, and the category should be deleted.
* Actuel Result : The response status is 200, and the category is deleted.
* Status : Passed
* Remark : None
*/
public function test_delete_category_api(): void
{
    $category = Category::factory()->create();
    $response = $this->delete("/api/categories/{$category->id}");
    $response->assertStatus(200);
}

}

