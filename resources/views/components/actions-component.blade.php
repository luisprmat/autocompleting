<div class="no-wrap">

    {{-- Edit button --}}
    <a class="btn btn-outline-primary{{ $size ? ' btn-' . $size : '' }}"
        href="{{ route($prefix . '.edit', $model) }}"
    ><i class="fas fa-pencil-alt fa-fw"></i></a>

    {{-- Delete button --}}
    <a class="btn btn-outline-danger{{ $size ? ' btn-' . $size : '' }}"
        href="#"
        onclick="event.preventDefault();
            if(confirm('¿Estás seguro de eliminar el pais \'{{ $model->name }}\'?'))
            {document.getElementById('{{ $modelName }}-delete-{{ $model->id }}').submit();}"
    ><i class="fas fa-trash-alt fa-fw"></i></a>
    <form action="{{ route($prefix . '.destroy', $model) }}"
        method="POST"
        class="d-none"
        id="{{ $modelName }}-delete-{{ $model->id }}"
    >@csrf @method('DELETE')
    </form>

</div>
