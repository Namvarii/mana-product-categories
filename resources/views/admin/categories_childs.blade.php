<option value="{{ $child_category->id }}" {{ (old('parent') == $child_category->id)||(isset($category) && $category->parent_id == $child_category->id) ? 'selected' : ''}}>@for($i = $child_category->level;$i !== 0; $i--)    @endfor @for($i = $child_category->level;$i !== 0; $i--)-@endfor {{ $child_category->title }}</option>
@foreach ($child_category->childs as $childCategory)
    @include('categories::admin.categories_childs', ['child_category' => $childCategory])
@endforeach
