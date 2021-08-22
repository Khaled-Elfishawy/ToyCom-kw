{{--@can('edit_'.$entity)--}}
    <a href="{{ route($entity.'.edit', [str_singular($entity) => $id])  }}" class="btn btn-sm btn-info">
        @lang('lang.Edit')
    </a>
{{--@endcan--}}

{{--@can('delete_'.$entity)--}}
    {!! Form::open( ['method' => 'delete', 'url' => route($entity.'.destroy', ['user' => $id]), 'style' => 'display: inline', 'onSubmit' => 'return confirm("Are yous sure wanted to delete it?")']) !!}
        <button type="submit" class="btn-delete btn btn-sm btn-danger">
            @lang('lang.Delete')
        </button>
    {!! Form::close() !!}
{{--@endcan--}}
