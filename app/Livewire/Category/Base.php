<?php

namespace App\Livewire\Category;

use Livewire\Component;

class Base extends Component
{
    public function render()
    {
        return view('livewire.category.base')->extends('livewire.layouts.master')->section('content');
    }
}
