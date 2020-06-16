@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h1 class="mb-0">Listado de paises</h1>
                        <a class="btn btn-primary" href="{{ route('countries.create') }}">Nuevo pais</a>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Pais</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($countries as $country)
                                   <tr>
                                    <td scope="row">{{ $country->id }}</td>
                                    <td>{{ $country->name }}</td>
                                    <td>
                                        <a class="btn btn-primary btn-sm" href="{{ route('countries.edit', $country) }}">Editar</a>
                                        <a class="btn btn-danger btn-sm"
                                            href="{{ route('countries.destroy', $country) }}"
                                            onclick="event.preventDefault();
                                                document.getElementById('country-delete-{{$country->id}}').submit();"
                                        >Eliminar</a>
                                        <form action="{{ route('countries.destroy', $country) }}"
                                            method="POST"
                                            class="d-none"
                                            id="country-delete-{{ $country->id }}"
                                        >@csrf @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $countries->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
