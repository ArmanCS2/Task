<?php

namespace App\Services\Category;

use App\Repositories\CategoryRepository\CategoryRepository;

class CategoryService
{
    public $categoryRepository;

    public function __construct()
    {
        $this->categoryRepository = new CategoryRepository();
    }

    public function create(array $data)
    {
        return $this->categoryRepository->create($data);
    }

    public function update(array $data, $id)
    {
        return $this->categoryRepository->update($data, $id);
    }

    public function delete($id)
    {
        $this->categoryRepository->delete($id);
    }

    public function all()
    {
        return $this->categoryRepository->all();
    }

    public function find($id)
    {
        return $this->categoryRepository->find($id);
    }
}
