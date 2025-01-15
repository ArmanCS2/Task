<div wire:ignore.self class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">ویرایش</h5>
            </div>
            <div class="modal-body">
                <form wire:submit.prevent="edit">

                    <div class="mb-3">
                        <label class="form-label">عنوان محصول</label>
                        <input wire:model.live="title" type="text" class="form-control">
                        @error('title')
                        <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">قیمت</label>
                        <input type="text" wire:model.live="price" rows="3" class="form-control"></input>
                        @error('price')
                        <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">دسته بندی</label>
                        <select wire:model.live="category_id" type="text" class="form-control">
                            <option value="">
                                فاقد دسته بندی
                            </option>
                            @foreach($categories as $category)
                                <option value="{{$category->id}}">
                                    {{$category->name}}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                        <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">تصویر</label>
                        <input wire:model.lazy="image" type="file" class="form-control">
                        @error('image')
                        <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                        <div wire:loading wire:target="image" class="mt-1">
                            در حال بارگذاری...
                        </div>
                        @if(!empty($image))
                            <img width="200" class="mt-1" src="{{$image->temporaryUrl()}}">
                        @endif
                    </div>

                    @if(!empty($image))

                        <div class="mb-3">
                            <div class="row">
                                <div class="col">
                                    <label class="form-label">ارتفاع تصویر (px)</label>
                                    <input type="text" wire:model.live="height" rows="3" class="form-control"></input>
                                    @error('height')
                                    <div class="form-text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col">
                                    <label class="form-label">عرض تصویر (px)</label>
                                    <input type="text" wire:model.live="width" rows="3" class="form-control"></input>
                                    @error('width')
                                    <div class="form-text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    @endif

                    <button type="submit" class="btn btn-primary">
                        ثبت
                        <div wire:loading wire:target="edit">
                            <div class="spinner-border spinner-border-sm"></div>
                        </div>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

