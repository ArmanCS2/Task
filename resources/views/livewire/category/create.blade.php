<div class="m-5">

    <h5 class="text-center text-muted">ایجاد دسته بندی جدید :</h5>
    <form wire:submit.prevent="create">

        <div class="mb-3">
            <label class="form-label">نام دسته بندی</label>
            <input wire:model.live="name" type="text" class="form-control">
            @error('name')
            <div class="form-text text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">دسته بندی والد</label>
            <select wire:model.live="parent_id" type="text" class="form-control">

                <option value="">
                    دسته بندی اصلی
                </option>
                @foreach($categories as $category)
                <option value="{{$category->id}}">
                    {{$category->name}}
                </option>
                @endforeach
            </select>
            @error('parent_id')
            <div class="form-text text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-success">
            ثبت
            <div wire:loading wire:target="create">
                <div class="spinner-border spinner-border-sm"></div>
            </div>
        </button>
    </form>

</div>
