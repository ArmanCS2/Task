<?php

namespace App\Services\Product;

use App\Repositories\ProductRepository\ProductRepository;

class ProductService
{
    public $productRepository;

    public function __construct()
    {
        $this->productRepository = new ProductRepository();
    }

    public function create(array $data)
    {
        return $this->productRepository->create($data);
    }

    public function update(array $data, $id)
    {
        return $this->productRepository->update($data, $id);
    }

    public function delete($id)
    {
        $this->productRepository->delete($id);
    }

    public function all()
    {
        return $this->productRepository->all();
    }

    public function find($id)
    {
        return $this->productRepository->find($id);
    }
}
