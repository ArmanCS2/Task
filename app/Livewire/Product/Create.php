<?php

namespace App\Livewire\Product;

use App\Models\Category;
use App\Models\Product;
use App\Services\Image\ImageService;
use App\Services\Product\ProductService;
use Livewire\Component;
use Livewire\WithFileUploads;
use Mockery\Exception;

class Create extends Component
{
    use WithFileUploads;
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
        'image' => 'required|image',
        'height' => 'required|numeric',
        'width' => 'required|numeric',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }


    public function create()
    {
        $this->validate();
        try {
            $result="";
            if(!empty($this->image)){
                $imageService=new ImageService();
                $imageService->setExclusiveDirectory('products');
                $result = $imageService->fitAndSave($this->image,$this->width,$this->height);
            }
            $productService=new ProductService();
            $productService->create([
                'title' => $this->title,
                'price' => $this->price,
                'category_id' => $this->category_id ?? null,
                'image' => $result ?? null,
            ]);
            $this->dispatch('flashMessage', 'success','محصول با موفقیت ایجاد شد')->to(Notification::class);
            $this->dispatch('refresh')->to(Index::class);
            $this->dispatch('refresh')->to(Count::class);
            $this->reset();
        } catch (Exception $exception) {
            $this->dispatch('flashMessage', 'error',$exception->getMessage())->to(Notification::class);
        }

    }
    public function render()
    {
        $categories=Category::all();
        return view('livewire.product.create',compact('categories'));
    }
}
