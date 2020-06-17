@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Bienvenidos</h1>
        <div class="row">
            <div class="col-lg-6">
                <img class="img-fluid" src="{{ asset('images/welcome.svg') }}" alt="Bienvenido">
            </div>
        </div>
    </div>
@endsection
