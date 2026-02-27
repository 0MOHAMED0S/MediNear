<?php

namespace App\Services\Admin\Categories;

use App\Repositories\Interfaces\CategoryRepositoryInterface;
class CategoriesService
{
    protected CategoryRepositoryInterface $repository;

    public function __construct(CategoryRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    // get all categories
    public function getAllCategories()
    {
        return $this->repository->getAll();
    }

    // get category by id
    public function getCategoryById(int $id)
    {
        return $this->repository->findById($id);
    }
    
    
    // create category with image upload
    public function createCategory(array $data)
    {
        if (isset($data['image'])) {
            $image = $data['image'];
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images/categories'), $imageName);
            $data['image'] = 'images/categories/' . $imageName;
        }
        return $this->repository->create($data);
    }

    
    // update category with image upload
    public function updateCategory(int $id, array $data)
    {
        if (isset($data['image'])) {
            $image = $data['image'];
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images/categories'), $imageName);
            $data['image'] = 'images/categories/' . $imageName;
        }
        return $this->repository->update($id, $data);
    }

    // delete category
    public function deleteCategory(int $id)
    {
        return $this->repository->delete($id);
    }

    // get all active categories
    public function getActiveCategories()
    {
        return $this->repository->getActiveCategories();
    }

    // get all not active categories
    public function getNotActiveCategories()
    {
        return $this->repository->getNotActiveCategories();
    }
}
