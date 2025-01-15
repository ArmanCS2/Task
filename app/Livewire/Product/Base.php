<?php

namespace App\Livewire\Product;

use Livewire\Component;

class Base extends Component
{
    protected $listeners=['refresh'=>'$refresh'];
    public function render()
    {
        return view('livewire.product.base')->extends('livewire.layouts.master')->section('content');
    }
}
