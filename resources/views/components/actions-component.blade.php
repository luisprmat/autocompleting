<div>

    {{-- Edit button --}}
    <a class="btn btn-primary{{ $size ? ' btn-' . $size : '' }}"
        href="{{ route($prefix . '.edit', $model) }}"
    >Editar</a>

    {{-- Delete button --}}
    <a class="btn btn-danger{{ $size ? ' btn-' . $size : '' }}"
        href="#"
        onclick="event.preventDefault();
            if(confirm('¿Estás seguro de eliminar el pais \'{{ $model->name }}\'?'))
            {document.getElementById('{{ $modelName }}-delete-{{ $model->id }}').submit();}"
    >Eliminar</a>
    <form action="{{ route($prefix . '.destroy', $model) }}"
        method="POST"
        class="d-none"
        id="{{ $modelName }}-delete-{{ $model->id }}"
    >@csrf @method('DELETE')
    </form>

</div>
