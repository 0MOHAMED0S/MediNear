<?php 

namespace App\Repositories\Eloquent;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Models\Category;

class CategoryRepository implements CategoryRepositoryInterface
{
    protected Category $model;

    public function __construct(Category $model)
    {
        $this->model = $model;
    }

    public function getAll()
    {
        return $this->model->latest()->get();
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function findById(int $id)
    {
        return $this->model->find($id);
    }

    public function update(int $id, array $data)
    {
        $category = $this->findById($id);
        if ($category) {
            $category->update($data);
            return $category;
        }
        return null;
    }

    public function delete(int $id)
    {
        $category = $this->findById($id);
        if ($category) {
            return $category->delete();
        }
        return false;
    }

    public function getActiveCategories()
    {
        return $this->model->where('is_active', true)->latest()->get();
    }

    public function getNotActiveCategories()
    {
        return $this->model->where('is_active', false)->latest()->get();
    }
}