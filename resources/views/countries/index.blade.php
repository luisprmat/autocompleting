@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h1 class="mb-0">Listado de paises</h1>
                        <a class="btn btn-primary" href="{{ route('countries.create') }}"><i class="fas fa-plus fa-fw"></i> Nuevo pais</a>
                    </div>
                    <div class="card-body">
                        {{ $countries->links() }}
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
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
                                        <td><a href="{{ route('countries.show', $country) }}">{{ $country->name }}</a></td>
                                        <td>
                                            <x-actions-component size="sm" :model="$country" />
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        {{ $countries->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
