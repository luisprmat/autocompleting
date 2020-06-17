@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="card">
                <h2 class="card-header"><strong>Pais</strong></h2>
                <div class="card-body">
                    <div class="card-title">
                        <i class="text-secondary">{{ $country->name }}</i>
                    </div>
                    <div class="card-text d-flex">
                        <x-actions-component size="sm" :model="$country" />
                        <a href="{{ route('countries.index') }}" class="btn btn-link btn-sm">Regresar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
