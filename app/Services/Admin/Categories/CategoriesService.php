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

    // create category
    public function createCategory(array $data)
    {
        return $this->repository->create($data);
    }

    // update category
    public function updateCategory(int $id, array $data)
    {
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
