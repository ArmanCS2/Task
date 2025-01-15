<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'شماره'=>$this->id,
            'عنوان'=>$this->title,
            'قیمت'=>$this->price,
            'دسته بندی'=>!empty($this->category) ? $this->category->name : 'فاقد دسته بندی' ,
            'تصویر'=>$this->image ?  asset($this->image) : 'فاقد تصویر',
        ];
    }
}
