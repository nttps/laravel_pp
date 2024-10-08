
@can('edit_'.$entity)
    <a href="{{ route('admin.'.$entity.'.edit', [str_singular($entity) => $id])  }}" class="btn m-btn btn-accent btn-sm">
        <i class="fa fa-edit"></i>
    </a>
@endcan

@can('delete_'.$entity)
    {!! Form::open( ['method' => 'delete', 'url' => route('admin.'.$entity.'.destroy', ['user' => $id]), 'style' => 'display: inline', 'onSubmit' => 'return confirm("Are yous sure wanted to delete it?")']) !!}
        <button type="submit" class="btn btn-danger btn-sm m-btn">
            <i class="fa fa-trash"></i>
        </button>
    {!! Form::close() !!}
@endcan