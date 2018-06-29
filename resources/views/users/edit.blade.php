@extends('layouts.main')

@section('content')

<form method="POST" action="{{ action( 'UserController@update', ['id' => $user->id]) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <fieldset>
        <legend>Datos de acceso</legend>
        <div class="form-group">
            <label for="name">Nombre:</label>
            <input 
                id="name" name="name" 
                value="{{ $user->participant->name }}"
                type="text" class="form-control" placeholder="Nombre completo" required autofocus>
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input 
                id="email" name="email" 
                value="{{ $user->email }}" 
                type="email" class="form-control" placeholder="nombre@email.com" required>
        </div>
    </fieldset>
    <fieldset>
        <legend>Datos de departamento</legend>
        
        <div class="form-group">
            <label for="id">ID/Matricula:</label>
            <input 
                id="id" name="id" 
                value="{{ $user->participant->id }}" 
                type="text" class="form-control">
        </div>
        
        <div class="form-group">
            <label for="profile_photo">Foto de perfil:</label>
            <input type="file" class="form-control-file single-file" id="profile_photo" name="profile_photo" aria-describedby="profile-photo-help">
            <div class="thumb" style="background-image:url('{{ Storage::disk('local')->url('users/'.$user->email.'.jpg') }}');"></div>
            <small id="profile-photo-help" class="form-text text-muted">Inserta una imagen de perfil, esta se mostrará cuando seas mencionado en la plataforma.</small>
        </div>

        <div class="form-group">
            <label for="bio">Bio:</label>
            <textarea name="bio" id="bio" cols="30" rows="10" class="form-control">{{ $user->participant->bio }}</textarea>
        </div>
        
        <div class="form-group">
            <label for="link">Link:</label>
            <input type="text" class="form-control" 
                id="link" name="link" 
                value="{{ $user->participant->link }}">
        </div>

        <div class="form-group">
            <label for="faculty_slug">Facultad:</label>
            <select name="faculty_slug" id="faculty_slug" class="form-control">
                @foreach ( $faculties as $faculty )
                    <option 
                        value="{{ $faculty->slug }}" 
                        {{ ( $faculty->slug === $user->faculty_slug ) ? 'selected="selected"' : '' }}>{{ $faculty->title }}</option>
                @endforeach
            </select>
        </div>
    </fieldset>
    
    <input class="btn btn-primary" type="submit" value="Guardar">
</form>
@endsection
