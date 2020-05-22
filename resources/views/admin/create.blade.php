@extends('admin.layout.master')
@section('title', request()->route()->named('manage.category.edit') ? trans('categories::categories.edit.title').' '.$category->name : trans('categories::categories.add.title') )
@section('content')
    <section class="content Namvarii">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-info Namvarii">
                    <div class="card-header">
                        <h3 class="card-title">دسته بندی های اخبار : <small>@yield('title')</small></h3><!-- tools box -->
                    </div><!-- /.card-header -->
                    @if(request()->route()->named('manage.category.edit'))
                        <form id="createPost" method="POST" action="{{ route('manage.category.update',$category) }}">
                            @method('PATCH')
                    @else
                        <form id="createPost" method="POST" action="{{ route('manage.category.store') }}">
                    @endif
                        @csrf
                        <div class="card-body pad">
                            <div class="row">
                                <div class="form-group col-md-4 Namvarii" dir="rtl">
                                    <label>والد</label>
                                    @error('parnet')
                                    <label class="text-danger text-xs">#{{ $message }}</label>
                                    @enderror
                                    <select name="parent" id="parent" class="form-control select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                        <option value="noparent">بدون والد</option>
                                        @if($categories->count() > 0)
                                            @include('categories::admin.categories',compact('categories'))
                                        @endif
                                    </select>
                                </div>
                                <div class="form-group col-md-4 Namvarii">
                                    <label>نام دسته بندی</label>
                                    @error('title')
                                    <label class="text-danger text-xs">#{{ $message }}</label>
                                    @enderror
                                    <input type="text" required name="title" class="form-control @error('title') is-invalid @enderror" placeholder="عنوان" value="{{ old('title') ?? $category->title ?? ''}}">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>متن دسته بندی در آدرس</label>
                                    @error('slug')
                                        <label class="text-danger text-xs">#{{ $message }}</label>
                                    @enderror
                                    <div class="input-group mb-3 Namvarii">
                                        <input type="text" name="slug" class="form-control ltr @error('slug') is-invalid @enderror" value="{{ old('slug') ?? $category->slug ?? ''}}" placeholder="slug">
                                        <div class="input-group-append">
                                            <span class="input-group-text">SLUG</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-12">
                                    <label>توضیحات</label>
                                    @error('description')
                                        <label class="text-danger text-xs" for="description">#{{ $message }}</label>
                                    @enderror
                                        <textarea required name="description" class="form-control" rows="3" placeholder="توضحیات">{{ old('description') ?? $category->desc ?? ''}}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-info" type="submit" id="submitForm">ذخیره دسته بندی</button>
                        </div>
                    </form>
                </div>
            </div><!-- /.col-->
        </div><!-- ./row -->
    </section><!-- /.content -->
@stop
@section('css')
    <link rel="stylesheet" href="{{asset('admin/plugins/select2/css/select2.min.css')}}">
    <style>
        .select2-results__option {text-align: right !important;}
        .select2-selection.select2-selection--single {height: auto; padding-bottom: 3px }
    </style>
@endsection
@section('js')
    <script src="{{asset('admin/plugins/select2/js/select2.full.min.js')}}"></script>
    <script src="{{asset('admin/plugins/select2/js/i18n/fa.js')}}"></script>
    <script>
        $('.select2').select2()
    </script>
@endsection
@section('meta_csrf')
{{--    <meta name="csrf-token" content="{{ csrf_token() }}">--}}
@endsection
