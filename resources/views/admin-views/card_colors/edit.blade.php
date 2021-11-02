@extends('layouts.admin.app')

@section('title','Update wraping')

@push('css_or_js')

@endpush

@section('content')
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col-sm mb-2 mb-sm-0">
                    <h1 class="page-header-title"><i class="tio-edit"></i> {{trans('messages.update')}} {{trans('messages.wraping')}}</h1>
                </div>
            </div>
        </div>
        <!-- End Page Header -->
        <div class="row gx-2 gx-lg-3">
            <div class="col-sm-12 col-lg-12 mb-3 mb-lg-2">
                <form action="{{route('admin.card_colors.update', $data->id)}}" method="post" enctype="multipart/form-data">
                    @csrf @method('put')
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label class="input-label" for="exampleFormControlInput1">{{trans('messages.name_ar')}}</label>
                                <input type="text" name="name_ar" value="{{$data->name_ar}}" class="form-control"  required>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label class="input-label" for="exampleFormControlInput1">{{trans('messages.name_en')}}</label>
                                <input type="text" name="name_en" value="{{$data->name_en}}" class="form-control" required>
                            </div>
                        </div>

                    </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label class="input-label" for="exampleFormControlInput1">{{trans('messages.price')}}</label>
                            <input type="text" name="price" value="{{$data->price}}"  value="{{old('price')}}" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-6">

                    </div>
                </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label>{{trans('messages.Wraping')}} {{trans('messages.image')}}</label><small style="color: red">* ( {{trans('messages.ratio')}} 3:1 )</small>
                                <div class="custom-file">
                                    <input type="file" name="image" id="customFileEg1" class="custom-file-input"
                                           accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*">
                                    <label class="custom-file-label" for="customFileEg1">{{trans('messages.choose')}} {{trans('messages.file')}}</label>
                                </div>
                                <hr>
                                <center>
                                    <img style="width: 80%;border: 1px solid; border-radius: 10px;" id="viewer"
                                         src="{{asset('storage/app/public/wraping')}}/{{$data->image }}" alt="brand image"/>
                                </center>
                            </div>
                        </div>

                    </div>
                    <hr>
                    <button type="submit" class="btn btn-primary">{{trans('messages.update')}}</button>
                </form>
            </div>
        </div>
    </div>


@endsection

@push('script_2')
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#viewer').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#customFileEg1").change(function () {
            readURL(this);
        });

        function show_item(type) {
            if (type === 'product') {
                $("#type-product").show();
                $("#type-category").hide();
            } else {
                $("#type-product").hide();
                $("#type-category").show();
            }
        }
    </script>
@endpush
