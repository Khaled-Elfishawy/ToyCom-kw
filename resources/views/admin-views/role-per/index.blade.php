@extends('layouts.admin.app')
@section('content')
    <section class="content-header">
        <h1>
            {{trans('messages.role-per')}}
        </h1>
    </section>
    <section class="content">
        <div class="box box-default color-palette-box">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-solid">
                        <div class="box-body">
                            <div class="box-group" id="accordion">
                                @foreach ($roles as $role)
                                    {!! Form::model($role, ['method' => 'PUT', 'route' => ['admin.rolePer.update',  $role->id ], 'class' => 'm-b']) !!}
                                    @include('admin-views.shared._permissions', [
                                                'title' => $role->name .' Permissions',
                                                'model' => $role ])
                                    @if(UserCan('add_role','admin'))
                                        <br>
                                        {!! Form::submit( trans('messages.update') , ['class' => 'btn btn-primary']) !!}
                                    @endif
                                    {!! Form::close() !!}
                                    <br>
                                    <hr>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
