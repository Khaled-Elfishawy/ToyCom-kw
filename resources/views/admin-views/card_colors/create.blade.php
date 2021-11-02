@extends('layouts.admin.app')

@section('title','Create wraping')

@push('css_or_js')

@endpush

@section('content')
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col-sm mb-2 mb-sm-0">
                    <h1 class="page-header-title text-capitalize"><i
                            class="tio-edit"></i> {{trans('messages.create_card_color')}}</h1>
                </div>
            </div>
        </div>
        <div class="row gx-2 gx-lg-3">
            <div class="col-sm-12 col-lg-12 mb-3 mb-lg-2">
                <form action="{{route('admin.card_colors.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label class="input-label"
                                       for="exampleFormControlInput1">{{trans('messages.name_ar')}}</label>
                                <input type="text" name="name_ar" value="{{old('name_ar')}}" class="form-control"
                                       required>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label class="input-label"
                                       for="exampleFormControlInput1">{{trans('messages.name_en')}}</label>
                                <input type="text" name="name_en" value="{{old('name_en')}}" class="form-control"
                                       required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label class="input-label"
                                       for="exampleFormControlInput1">{{trans('messages.color')}}</label>
                                <input type="color" name="color_code" value="#ff0000" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">create</button>
                </form>
            </div>
        </div>
    </div>
@endsection
