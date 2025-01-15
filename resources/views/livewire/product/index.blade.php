<div class="m-3">
    @if($products->count() > 0)
    <form class="row d-flex justify-content-start align-items-end mb-2">
        <div class="col-auto">
            <label class="form-label">عنوان</label>
            <input wire:model.live="title" type="text" class="form-control">
        </div>

    </form>
    <table class="table table-light">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">عنوان</th>
            <th scope="col">قیمت</th>
            <th scope="col">دسته بندی</th>
            <th scope="col">تصویر</th>
            <th scope="col">عملیات</th>
        </tr>
        </thead>
        <tbody>
        @foreach($products as $key => $product)
            <tr>
                <th scope="row">{{$product->id}}</th>
                <td>{{$product->title}}</td>
                <td>{{priceFormat($product->price)}} تومان</td>
                <td>{{!empty($product->category)? $product->category->name : 'فاقد دسته بندی'}}</td>
                <td class="d-flex justify-content-center align-items-center"><img src="{{!empty($product->image) ? asset($product->image) : 'فاقد تصویر'}}"></td>
                <td>
                    <div class="d-flex">

                        <div>
                            <button wire:click="$dispatchTo('product.edit','showEditModal',[{{$product->id}}])"
                                    class="btn btn-primary">ویرایش
                            </button>
                        </div>
                        <div>
                            <button wire:click="delete([{{$product->id}}])" class="btn btn-danger">حذف</button>
                        </div>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
        <div>
            {{$products->links()}}
        </div>
    </table>
    @endif

</div>
