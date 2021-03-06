@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h1 class="mb-0">{{ trans("countries.title.{$view}") }}</h1>
                        <div>
                            @if($view == 'index')
                                <a class="btn btn-outline-dark" href="{{ route('countries.trashed') }}">Ver papelera</a>
                                <a class="btn btn-primary" href="{{ route('countries.create') }}"><i class="fas fa-plus fa-fw"></i> Nuevo pais</a>
                            @else
                                <a href="{{ route('countries.index') }}" class="btn btn-outline-dark">Regresar al listado de paises</a>
                            @endif
                        </div>

                    </div>
                    <div class="card-body">
                        {{ $countries->withQueryString()->links() }}
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th><a href="{{ $sortable->url('id', request('sort') == 'id' ? 'desc' : 'asc') }}"># <i class="{{ $sortable->classes('id') }}"></i></a></th>
                                        <th><a href="{{ $sortable->url('name', request('sort') == 'name' ? 'desc' : 'asc') }}">Pais <i class="{{ $sortable->classes('name') }}"></i></a></th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($countries as $country)
                                        <tr>
                                            <td scope="row">{{ $country->id }}</td>
                                            <td><a href="{{ route('countries.show', $country) }}">{{ $country->name }}</a></td>
                                            <td>
                                                @if($view == 'index')
                                                    <x-actions-component size="sm" :model="$country" />
                                                @else
                                                    <x-actions-component
                                                        size="sm"
                                                        :model="$country"
                                                        :allowedActions="['restore', 'forceDelete']" />
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3">No hay registros</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        {{ $countries->withQueryString()->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
