<?php

namespace App\Livewire\Category;

use App\Models\Category;
use App\Models\Product;
use App\Services\Category\CategoryService;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use withPagination;

    protected $listeners = ['refresh' => '$refresh'];

    public function delete(Category $category)
    {
        $categoryService=new CategoryService();
        $categoryService->delete($category->id);
        $this->dispatch('flashMessage', 'success', 'دسته بندی با موفقیت حذف شد')->to(Notification::class);
        $this->dispatch('refresh')->to(Index::class);
        $this->dispatch('refresh')->to(Create::class);
    }

    public function render()
    {
        $categories = Category::paginate(10);
        return view('livewire.category.index', compact('categories'));
    }
}
