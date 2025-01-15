<?php

namespace App\Livewire\Category;

use Livewire\Component;

class Notification extends Component
{
    protected $listeners=['flashMessage'];
    public function flashMessage($type, $message)
    {
        session()->flash($type, $message);
    }
    public function render()
    {
        return view('livewire.category.notification');
    }
}
