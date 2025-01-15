<?php

namespace App\Livewire\Product;

use App\Models\Product;
use Livewire\Component;

class Count extends Component
{
    public $count;
    protected $listeners = ['refresh' => '$refresh'];
    public function render()
    {
        $this->count=Product::count();
        if($this->count==0){
            $this->dispatch('flashMessage', 'error','محصولی وجود ندارد')->to(Notification::class);
        }elseif ($this->count<3){
            $this->dispatch('flashMessage', 'error','موجودی رو به اتمام است')->to(Notification::class);
        }
        return view('livewire.product.count');
    }
}
