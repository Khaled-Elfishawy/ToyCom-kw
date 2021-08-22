@extends('layouts.admin.app')

@section('title','Update Price-Gropu')

@push('css_or_js')

@endpush

@section('content')
    <div class="content container-fluid">
        <!-- Page Header -->
        @if(UserCan('edit_price_group','admin'))
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col-sm mb-2 mb-sm-0">
                    <h1 class="page-header-title text-capitalize"><i class="tio-edit"></i> {{trans('messages.price-group')}} {{trans('messages.update')}}</h1>
                </div>
            </div>
        </div>
        <!-- End Page Header -->
        <div class="row gx-2 gx-lg-3">
            <div class="col-sm-12 col-lg-12 mb-3 mb-lg-2">
                <form action="{{route('admin.price-group.update',[$price['id']])}}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label class="input-label" for="exampleFormControlInput1">{{trans('messages.name')}}</label>
                                <input type="text" name="name" value="{{$price['name']}}" class="form-control" placeholder="New price-group" required>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">{{trans('messages.update')}}</button>
                </form>
            </div>
            <!-- End Table -->
        </div>
        @endif
    </div>

@endsection

@push('script_2')

@endpush
