@extends('layouts.admin.app')


@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        @lang('lang.roles')
    </h1>
    <ol class="breadcrumb">
        <li><a href="/home"><i class="fa fa-dashboard"></i> @lang('lang.Home')</a></li>
        <li class="active">@lang('lang.roles')</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
{{--    @include('messages')--}}
    <!-- COLOR PALETTE -->
    <div class="box box-default color-palette-box">
        <div class="row">
        <div class="col-md-12">
          <div class="box box-solid">
            <!-- /.box-header -->
            <div class="box-body">
                <div class="box-group" id="accordion">
                    @foreach ($roles as $role)

                        {!! Form::model($role, ['method' => 'PUT', 'route' => ['admin.rolePer.update',  $role->id ], 'class' => 'm-b']) !!}

                            @include('admin-views.shared._permissions', [
                                        'title' => $role->name .' Permissions',
                                        'model' => $role ])

                            @if(UserCan('add_role','admin'))
                                <br>
                                {!! Form::submit(__('lang.Save'), ['class' => 'btn btn-primary']) !!}
                            @endif

                            {!! Form::close() !!}
                            <br>
                                <hr>
                        @endforeach

                </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
    </div>

        <!-- /.box-body -->
    </div>
    <!-- /.box -->
</section>


@endsection
