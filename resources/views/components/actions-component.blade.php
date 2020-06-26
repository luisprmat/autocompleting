<div class="no-wrap">

    {{-- Edit button --}}
    @if($allowedActions->contains('update'))
        @can('update', $model)
            <a class="btn btn-outline-primary{{ $size ? ' btn-' . $size : '' }}"
                href="{{ route($prefix . '.edit', $model) }}"
            ><i class="fas fa-pencil-alt fa-fw"></i>
            </a>
        @endcan
    @endif

    {{-- Delete button --}}
    @if($allowedActions->contains('delete'))
        @can('delete', $model)
            <a class="btn btn-outline-danger{{ $size ? ' btn-' . $size : '' }}"
                href="#"
                onclick="event.preventDefault();
                    document.getElementById('{{ $modelName }}-delete-{{ $model->id }}').submit();"
            ><i class="fas fa-trash-alt fa-fw"></i></a>
            <form action="{{ route($prefix . '.destroy', $model) }}"
                method="POST"
                class="d-none"
                id="{{ $modelName }}-delete-{{ $model->id }}"
            >@csrf @method('DELETE')
            </form>
        @endcan
    @endif

    {{-- Restore button --}}
    @if($allowedActions->contains('restore'))
        @can('restore', $model)
            <a class="btn btn-outline-info{{ $size ? ' btn-' . $size : '' }}"
                href="#"
                onclick="event.preventDefault();
                    document.getElementById('{{ $modelName }}-restore-{{ $model->id }}').submit();"
            ><i class="fas fa-trash-restore-alt fa-fw"></i></a>
            <form action="{{ route($prefix . '.restore', $model) }}"
                method="POST"
                class="d-none"
                id="{{ $modelName }}-restore-{{ $model->id }}"
            >@csrf @method('PATCH')
            </form>
        @endcan
    @endif

    {{-- Force Delete button --}}
    @if($allowedActions->contains('forceDelete'))
        @can('force-delete', $model)
            <a class="btn btn-outline-danger{{ $size ? ' btn-' . $size : '' }}"
                href="#"
                onclick="event.preventDefault();
                    if(confirm('Esta acción no se puede deshacer, ¿Estás seguro de eliminar permanentemente el pais \'{{ $model->name }}\'?'))
                        {document.getElementById('{{ $modelName }}-force-delete-{{ $model->id }}').submit();}"
            ><i class="fas fa-times-circle fa-fw"></i></a>
            <form action="{{ route($prefix . '.force-delete', $model) }}"
                method="POST"
                class="d-none"
                id="{{ $modelName }}-force-delete-{{ $model->id }}"
            >@csrf @method('DELETE')
            </form>
        @endcan
    @endif



</div>
