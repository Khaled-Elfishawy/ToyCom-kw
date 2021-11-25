@extends('layouts.admin.app')

@section('title','Add admin')

@push('css_or_js')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{asset('public/assets/admin/css/tags-input.min.css')}}" rel="stylesheet">
@endpush

@section('content')
    <div class="content container-fluid">
        <!-- Page Header -->
        {{--        @if(UserCan('edit_customer','admin'))--}}
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col-sm mb-2 mb-sm-0">
                    <h1 class="page-header-title"><i
                            class="tio-edit"></i> {{trans('messages.admin create')}}</h1>
                </div>
            </div>
        </div>
        <!-- End Page Header -->
        <div class="row gx-2 gx-lg-3">
            <div class="col-sm-12 col-lg-12 mb-3 mb-lg-2">
                <form action="{{route('admin.admins.admin_store')}}" method="post"
                      enctype="multipart/form-data">
                    @csrf
                    {{--                        @method('put')--}}
                    <div class="row">
                        <div class="col-md-4 col-12">
                            <div class="form-group">
                                <label class="input-label"
                                       for="exampleFormControlInput1"> {{trans('messages.f_name')}}</label>
                                <input type="text" name="f_name" value="" class="form-control"
                                       placeholder="{{trans('messages.name')}}"
                                       required>
                            </div>
                        </div>
                        <div class="col-md-4 col-12">
                            <div class="form-group">
                                <label class="input-label"
                                       for="exampleFormControlInput1"> {{trans('messages.s_name')}}</label>
                                <input type="text" name="l_name" value="" class="form-control"
                                       placeholder="{{trans('messages.name')}}"
                                       required>
                            </div>
                        </div>
                        <div class="col-md-4 col-12">
                            <div class="form-group">
                                <label class="input-label"
                                       for="exampleFormControlInput1">{{trans('messages.email')}}</label>
                                <input type="email" name="email" value="" class="form-control"
                                       placeholder="Ex : ex@example.com"
                                       required>
                            </div>
                        </div>
                        <div class="col-md-4 col-12">
                            <div class="form-group">
                                <label class="input-label"
                                       for="exampleFormControlInput1">{{trans('messages.phone')}}</label>
                                <input type="text" name="phone" value="" class="form-control"
                                       placeholder="Ex : +9********"
                                       required>
                            </div>
                        </div>
                        <div class="col-md-4 col-12">
                            <div class="form-group">
                                <label class="input-label"
                                       for="exampleFormControlInput1"> {{trans('messages.password')}}</label>
                                <input type="password" name="password" class="form-control"
                                       placeholder="{{trans('messages.password')}}">
                            </div>
                        </div>
                        <div class="col-md-4 col-12">
                            <div class="form-group">
                                <label class="input-label"
                                       for="exampleFormControlInput1"> {{trans('messages.confirmed password')}}</label>
                                <input type="password" name="password_confirmation" class="form-control"
                                       placeholder="{{trans('messages.password')}}"
                                >
                            </div>
                        </div>

                        <div class="col-md-4 col-12">
                            <div class="form-group">
                                <label class="input-label"
                                       for="exampleFormControlSelect1">{{trans('messages.role-per')}}</label>
                                <select name="role_id" id="price_group-id"
                                        class="form-control js-select2-custom">
                                    @foreach($Roles as $Role)
                                        <option value="{{$Role->id}}">{{$Role->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                    </div>


                    <hr>
                    <button type="submit" class="btn btn-primary">{{trans('messages.add')}}</button>
                </form>
            </div>
        </div>
        {{--        @endif--}}
    </div>

@endsection




