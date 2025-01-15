<?php

namespace App\Livewire\Product;

use App\Models\Product;
use App\Models\Task;
use App\Services\Product\ProductService;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use withPagination;

    public $title;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['refresh' => '$refresh'];

    public function delete(Product $product)
    {
        $productService = new ProductService();
        $productService->delete($product->id);
        $this->dispatch('refresh')->to(Count::class);
        $this->dispatch('flashMessage', 'success', 'محصول با موفقیت حذف شد')->to(Notification::class);
    }

    public function render()
    {
        $title = trim($this->title);
        $products = Product::when(!empty($title), function ($query) use ($title) {
            return $query->where('title', 'like', "%$title%");
        })->orderBy('created_at', 'desc')->paginate(5);
        return view('livewire.product.index', compact('products'));
    }
}
