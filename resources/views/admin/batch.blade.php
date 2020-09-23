@extends('admin.layout.master')
@section('title',$title)

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">@yield('title')</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form action="{{ route('manage.batch.productcategory.store') }}" enctype="multipart/form-data" method="POST">
                            @csrf
                            @method('patch')
                            <div class="row">
                                <div class="col-md-10">
                                    <div class="form-group">
                                        <label for="customFile">انتخاب فایل ایکسل</label>

                                        @error('excel_file')
                                            <label class="text-xs text-danger">* {{ $message }}</label>
                                        @enderror

                                        <div class="custom-file">
                                            <input name="excel_file" type="file" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" class="custom-file-input" id="customFile">
                                            <label class="custom-file-label" for="customFile">انتخاب فایل </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="text-white">_____________</label>
                                        <button class="btn btn-outline-danger btn-block" type="submit">افزودن دسته جمعی</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div><!-- /.col-->
        </div><!-- ./row -->
    </section><!-- /.content -->
@stop
@push('css')

@endpush
@push('js')
    <!-- bs-custom-file-input -->
    <script src="{{ asset('admin/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            bsCustomFileInput.init();
        });
    </script>
@endpush
@section('meta_csrf')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
