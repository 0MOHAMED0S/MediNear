<?php

namespace App\Http\Controllers\Api\Admin\Categories;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoriesRequest;
use App\Services\Admin\Categories\CategoriesService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;


class CategoriesController extends Controller
{

// get all categories public function index() { } 
// create category
//try and catch
public function create(Request $request, CategoriesService $service) {
    $validatedData = $request->validate((new CategoriesRequest())->rules());
    try {
        $category = $service->createCategory($validatedData);
        return response()->json($category, 201);
        }
    
    catch (\Exception $e) {
        return response()->json(['error' => 'Failed to create category'], 500);
        }
}

// update category
// try and catch
public function update(Request $request, CategoriesService $service, $id) {
    $validatedData = $request->validate((new CategoriesRequest())->rules());
    try {
        $category = $service->updateCategory($id, $validatedData);
        return response()->json($category);
        } 
    
    catch (\Exception $e) {
        return response()->json(['error' => 'Failed to update category'], 500);
        }
}

// delete category
//try and catch
public function delete(CategoriesService $service, $id) {
    try {
        $service->deleteCategory($id);
        return response()->json(null, 204);
        } 
    catch (\Exception $e) {
        return response()->json(['error' => 'Failed to delete category'], 500);
        }
}

// get all active categories public function active() { } 
// get all not active categories
public function notactive(CategoriesService $service): JsonResponse
{
    $categories = $service->getNotActiveCategories();
    return response()->json($categories);
}


}
