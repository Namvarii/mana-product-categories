<tr>
    <td>{{$child_category->id}}.</td>
    <td>@for($i = $child_category->level;$i !== 0; $i--)    @endfor @for($i = $child_category->level;$i !== 0; $i--)-@endfor {{$child_category->title}}</td>
    <td style="text-align: left">{{$child_category->slug}}</td>
    <td class="text-center">
        <a class="btn btn-xs btn-primary" href="{{route('manage.category.edit',$child_category)}}">ویرایش</a>
        <form class="d-inline-block" action="{{route('manage.category.destroy',$child_category)}}" method="POST">
            @csrf
            @method('DELETE')
            <button class="btn btn-xs btn-danger" type="submit">حذف</button>
        </form>
    </td>
</tr>
@foreach ($child_category->childs as $childCategory)
    @include('categories::admin.index_childs', ['child_category' => $childCategory])
@endforeach
