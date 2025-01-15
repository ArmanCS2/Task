<?php

namespace App\Livewire\Category;

use App\Models\Category;
use App\Services\Category\CategoryService;
use Livewire\Component;
use Mockery\Exception;

class Create extends Component
{
    public $name;
    public $parent_id;
    protected $listeners=['refresh'=>'$refresh'];
    protected $rules=[
        'name'=>'required|string|min:3',
    ];

    public function updated($propertyName)
    {
       $this->validateOnly($propertyName);
    }

    public function create()
    {
        $this->validate();
        try {
            $categoryService=new CategoryService();
            $categoryService->create([
                'name' => $this->name,
                'category_id' => $this->parent_id ?? null,
            ]);
            $this->dispatch('flashMessage', 'success','دسته بندی با موفقیت ایجاد شد')->to(Notification::class);
            $this->dispatch('refresh')->to(Index::class);
            $this->dispatch('refresh')->to(Create::class);
            $this->reset();
        } catch (Exception $exception) {
            $this->dispatch('flashMessage', 'error',$exception->getMessage())->to(Notification::class);
        }

    }
    public function render()
    {
        $categories=Category::all();
        return view('livewire.category.create',compact('categories'));
    }
}
