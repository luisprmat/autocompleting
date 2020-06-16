@csrf

<div class="form-group">
    <label for="name">Nombre</label>
    <input name="name"
        id="name"
        class="form-control @error('name') is-invalid @enderror"
        placeholder="Escriba un pais"
        value="{{ old('name', $country->name) }}"
    >

    @error('name')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>
