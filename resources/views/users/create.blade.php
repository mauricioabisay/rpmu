@extends('layouts.main')

@section('content')

<form method="POST" action="/users">
    @csrf
    <fieldset>
        <legend>Datos de acceso</legend>
        <div class="form-group">
            <label for="name">Nombre:</label>
            <input id="name" name="name" type="text" class="form-control" placeholder="Nombre completo" required autofocus>
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input id="email" name="email" type="email" class="form-control" placeholder="nombre@email.com" required>
        </div>
    </fieldset>
    <fieldset>
        <legend>Datos de departamento</legend>
        
        <div class="form-group">
            <label for="id">ID/Matricula:</label>
            <input type="text" class="form-control" id name="id">
        </div>
        
        <div class="form-group">
            <label for="bio">Bio:</label>
            <textarea name="bio" id="bio" cols="30" rows="10" class="form-control"></textarea>
        </div>
        
        <div class="form-group">
            <label for="link">Link:</label>
            <input type="text" class="form-control" id="link" name="link">
        </div>

        <div class="form-group">
            <label for="faculty_slug">Facultad:</label>
            <select name="faculty_slug" id="faculty_slug" class="form-control">
                @foreach ( $faculties as $faculty )
                    <option value="{{ $faculty->slug }}">{{ $faculty->title }}</option>
                @endforeach
            </select>
        </div>
    </fieldset>
    
    <input class="btn btn-primary" type="submit" value="Guardar">
</form>
@endsection
