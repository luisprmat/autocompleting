@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h1 class="mb-0">Editar pais</h1>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('countries.update', $country) }}" method="POST">
                            @method('PUT')

                            @include('countries.fields')

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Acualizar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
