<?php

namespace App\Repositories\ProductRepository;

use App\Models\Product;

class ProductRepository implements ProductRepositoryInterface
{
    public function all()
    {
        return Product::all();
    }

    public function create(array $data)
    {
        return Product::create($data);
    }

    public function update(array $data, $id)
    {
        $product = Product::findOrFail($id);
        $product->update($data);
        return $product;
    }

    public function delete($id)
    {
        $product = Product::findOrFail($id);
        if (!empty($product->image) && file_exists($product->image)) {
            unlink($product->image);
        }
        $product->delete();
    }

    public function find($id)
    {
        return Product::findOrFail($id);
    }
}
