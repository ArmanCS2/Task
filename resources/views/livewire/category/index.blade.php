<div class="m-5">
    @if($categories->count()>0)
        <form class="row d-flex justify-content-start align-items-end mb-2">
        </form>
        <table class="table table-light">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">نام دسته بندی</th>
                <th scope="col">دسته بندی والد</th>
                <th scope="col">عملیات</th>
            </tr>
            </thead>
            <tbody>
            @foreach($categories as $key => $category)
                <tr>
                    <th scope="row">{{$category->id}}</th>
                    <td>{{$category->name}}</td>
                    <td>{{$category->parent->name ?? 'دسته بندی اصلی'}}</td>
                    <td>
                        <div class="d-flex">
                            <div>
                                <button wire:click="delete([{{$category->id}}])" class="btn btn-danger">حذف</button>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
            <div>
                {{$categories->links()}}
            </div>
        </table>
    @endif
</div>
