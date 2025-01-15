<?php

namespace App\Livewire\Product;

use App\Models\Category;
use App\Models\Product;
use App\Services\Image\ImageService;
use App\Services\Product\ProductService;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads;

    public $product;
    public $title;
    public $price;
    public $category_id;
    public $image;
    public $height;
    public $width;
    protected $rules = [
        'title' => 'required|string',
        'price' => 'required|numeric',
        'category_id' => 'nullable|exists:categories,id',
        'image' => 'nullable|image',
        'height' => 'nullable|required_with:image|numeric',
        'width' => 'nullable|required_with:image|numeric',
    ];
    protected $listeners = ['showEditModal'];

    public function showEditModal(Product $product)
    {
        $this->product = $product;
        $this->title = $product->title;
        $this->price = $product->price;
        $this->category_id = $product->category_id;
        //$this->image = $product->image;
        $this->dispatch('showEditForm');
    }

    public function edit()
    {

        $this->validate();

        try {
            $result = '';
            if (!empty($this->image)) {
                $imageService = new ImageService();
                $imageService->deleteImage($this->product->image);
                $imageService->setExclusiveDirectory('products');
                $result = $imageService->fitAndSave($this->image, $this->width, $this->height);
            }
            $productService = new ProductService();
            $productService->update([
                'title' => $this->title,
                'price' => $this->price,
                'category_id' => !empty($this->category_id) ? $this->category_id : null,
                'image' => !empty($result) ? $result : $this->product->image,
            ], $this->product->id);
            $this->dispatch('flashMessage', 'success', 'محصول با موفقیت ویرایش شد')->to(Notification::class);
            $this->dispatch('refresh')->to(Index::class);
            $this->dispatch('hideEditForm');
            $this->reset();
        } catch (\Exception $exception) {
            $this->dispatch('flashMessage', 'error', $exception->getMessage())->to(Notification::class);
        }
    }

    public function render()
    {
        $categories = Category::all();
        return view('livewire.product.edit', compact('categories'));
    }
}
