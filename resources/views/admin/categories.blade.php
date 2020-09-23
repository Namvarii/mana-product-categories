@foreach($categories as $cat)
    <option value="{{ $cat->id . '#' . $cat->level }}" {{ (old('parent') == $cat->id)||(isset($category) && $category->parent_id == $cat->id) ? 'selected' : ''}}>{{ $cat->title }}</option>
    @foreach($cat->moreChilds as $childCategory)
        @include('ProductCategories::admin.categories_childs',['child_category' => $childCategory])
    @endforeach
@endforeach
