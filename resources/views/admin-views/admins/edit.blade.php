@extends('layouts.admin.app')

@section('title','Customer Details')

@push('css_or_js')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{asset('public/assets/admin/css/tags-input.min.css')}}" rel="stylesheet">
@endpush

@section('content')
    <div class="content container-fluid">
        <!-- Page Header -->
        @if(UserCan('edit_customer','admin'))
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col-sm mb-2 mb-sm-0">
                    <h1 class="page-header-title"><i
                            class="tio-edit"></i>{{trans('messages.customer_edit')}}</h1>
                </div>
            </div>
        </div>
        <!-- End Page Header -->
        <div class="row gx-2 gx-lg-3">
            <div class="col-sm-12 col-lg-12 mb-3 mb-lg-2">
                <form action="{{route('admin.admins.update',[$customer['id']])}}" method="post"
                      enctype="multipart/form-data">
                    @csrf @method('put')
                    <div class="row">
                        <div class="col-md-2 col-12">
                            <div class="form-group">
                                <label class="input-label" for="exampleFormControlInput1"> {{trans('messages.f_name')}}</label>
                                <input type="text" name="f_name" value="{{$customer['f_name']}}" class="form-control" placeholder="{{trans('messages.f_name')}}"
                                       required>
                            </div>
                        </div>
                        <div class="col-md-2 col-12">
                            <div class="form-group">
                                <label class="input-label" for="exampleFormControlInput1"> {{trans('messages.l_name')}}</label>
                                <input type="text" name="l_name" value="{{$customer['l_name']}}" class="form-control" placeholder="{{trans('messages.l_name')}}"
                                       required>
                            </div>
                        </div>
                        <div class="col-md-4 col-12">
                            <div class="form-group">
                                <label class="input-label" for="exampleFormControlInput1">{{trans('messages.email')}}</label>
                                <input type="email" name="email" value="{{$customer['email']}}" class="form-control" placeholder="Ex : ex@example.com"
                                       required>
                            </div>
                        </div>
                        <div class="col-md-4 col-12">
                            <div class="form-group">
                                <label class="input-label" for="exampleFormControlInput1">{{trans('messages.phone')}}</label>
                                <input type="text" name="phone" value="{{$customer['phone']}}" class="form-control" placeholder="Ex : 017********"
                                       required>
                            </div>
                        </div>
                        <div class="col-md-4 col-12">
                            <div class="form-group">
                                <label class="input-label" for="exampleFormControlInput1"> {{trans('messages.password')}}</label>
                                <input type="password" name="password"  class="form-control" placeholder="{{trans('messages.password')}}"
                                       >
                            </div>
                        </div>
                        <div class="col-md-4 col-12">
                            <div class="form-group">
                                <label class="input-label"
                                       for="exampleFormControlSelect1">{{trans('messages.role-per')}}</label>
                                <select name="role_id" class="form-control js-select2-custom">
                                    @foreach($Roles as $Role)
                                        <option value="{{$Role->id}}" @if($customer['role_id'] == $Role->id) selected @endif >{{$Role->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">{{trans('messages.edit')}}</button>
                </form>
            </div>
        </div>
        @endif
    </div>

@endsection




