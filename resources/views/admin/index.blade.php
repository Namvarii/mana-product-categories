@extends('admin.layout.master')
@section('title','دسته بندی های محصولات')

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">@yield('title')</h3>
                        <div class="card-tools">
                            <a class="btn btn-sm btn-success" href="{{ route('manage.batch.productcategory.export') }}">دریافت فایل پشتیبان</a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive ">
                        <table id="categories"  class="table table-hover border-bottom">
                            <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>نام</th>
                                    <th style="width: 250px; text-align: right">slug</th>
                                    <th style="width: 170px" class="text-center">عملیات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($categories->count())
                                    @foreach($categories as $category)
                                        <tr>
                                            <td>{{$category->id}}.</td>
                                            <td>{{$category->title}}</td>
                                            <td style="text-align: right">{{$category->slug}}</td>
                                            <td class="text-center">
                                                <a class="btn btn-xs btn-primary" href="{{route('manage.productcategory.edit',$category)}}">ویرایش</a>
                                                <form class="d-inline-block" action="{{route('manage.productcategory.destroy',$category)}}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-xs btn-danger" type="submit">حذف</button>
                                                </form>
                                            </td>
                                        </tr>
                                        @foreach($category->moreChilds as $childs)
                                            @include('ProductCategories::admin.index_childs',['child_category' => $childs])
                                        @endforeach
                                    @endforeach
                                @else
                                    <tr>
                                        <td class="text-center" colspan="8">متاسفانه دسته بندی برای محصولات ایجاد نشده است.</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div><!-- /.col-->
        </div><!-- ./row -->
    </section><!-- /.content -->
@stop
@section('css')
    <link rel="stylesheet" href="{{asset('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
@endsection
@section('js')
    <script src="{{asset('admin/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script>
        $('#categories').DataTable({
            ordering: false,
            columnDefs: [
                { targets: [ 3 ], searchable: false }
            ],
            language: {
                "sEmptyTable":     "هیچ داده‌ای در جدول وجود ندارد",
                "sInfo":           "نمایش [ _START_ الی _END_ ] از _TOTAL_ ردیف",
                "sInfoEmpty":      "جستجو بدون نتیجه!",
                "sInfoFiltered":   "(فیلتر شده از _MAX_ ردیف)",
                "sInfoPostFix":    "",
                "sInfoThousands":  ",",
                "sLengthMenu":     "نمایش _MENU_ ردیف",
                "sLoadingRecords": "در حال بارگزاری...",
                "sProcessing":     "در حال پردازش...",
                "sSearch":         "جستجو:",
                "sZeroRecords":    "رکوردی با این مشخصات پیدا نشد",
                "oPaginate": {
                    "sFirst":    "برگه‌ی نخست",
                    "sLast":     "برگه‌ی آخر",
                    "sNext":     "بعدی",
                    "sPrevious": "قبلی"
                },
                "oAria": {
                    "sSortAscending":  ": فعال سازی نمایش به صورت صعودی",
                    "sSortDescending": ": فعال سازی نمایش به صورت نزولی"
                }
            }
        });
    </script>
@endsection
@section('meta_csrf')
{{--    <meta name="csrf-token" content="{{ csrf_token() }}">--}}
@endsection
