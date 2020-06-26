@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h1 class="mb-0">Listado de paises</h1>
                        @can('create', App\Country::class)
                            <a class="btn btn-primary" href="{{ route('countries.create') }}"><i class="fas fa-plus fa-fw"></i> Nuevo pais</a>
                        @endcan
                    </div>
                    <div class="card-body">
                        {{ $countries->withQueryString()->links() }}
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th><a href="{{ $sortable->url('id', request('sort') == 'id' ? 'desc' : 'asc') }}"># <i class="{{ $sortable->classes('id') }}"></i></a></th>
                                        <th><a href="{{ $sortable->url('name', request('sort') == 'name' ? 'desc' : 'asc') }}">Pais <i class="{{ $sortable->classes('name') }}"></i></a></th>
                                        @can('manage-countries')
                                            <th>Acciones</th>
                                        @endcan
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($countries as $country)
                                    <tr>
                                        <td scope="row">{{ $country->id }}</td>
                                        <td><a href="{{ route('countries.show', $country) }}">{{ $country->name }}</a></td>
                                        @can('manage-countries')
                                            <td>
                                                <x-actions-component size="sm" :model="$country" />
                                            </td>
                                        @endcan
                                    </tr>
                                    @endforeach
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
