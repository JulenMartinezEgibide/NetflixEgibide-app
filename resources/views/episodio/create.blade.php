<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    @vite(['resources/css/styles.css', 'resources/js/app.js'])
</head>
<body>
  <div class="login-container">
    <form class="login-form" method="POST" action="{{ route('episodio.store',['id' => $id_serie]) }}" enctype="multipart/form-data">
      @csrf
      <h1>Egibide Netflix</h1>
      <p>Formulario para episodios</p>
      <div class="input-group">
        <p>Id de la serie:</p>
        <input type="text" id="id_serie" name="id_serie" value="{{ $id_serie }}" disabled required>
    </div>
      <div class="input-group">
        <input type="text" id="Nombre" name="Nombre" placeholder="Titulo" required>
      </div>
      <div class="input-group">
        <p>Descripcion:</p>
        <textarea id="Descripcion" name="Descripcion" required></textarea>
      </div>
      <div class="input-group">
        <input type="text" id="Duracion" name="Duracion" placeholder="Duracion" required>
      </div>
        <div class="input-group">
            <p>Añadir video:</p>
            <input type="text" id="ArchivoVideo" name="ArchivoVideo" placeholder="Nombre video" required>
            <input type="file" id="video" name="video" required>
        </div>
        <div class="input-group">
            <button type="submit">Añadir</button>
        
            <a href=" {{ route('serie.show',['id' => $id_serie]) }} " class="button-link">Volver</a>
        </div>
    </form>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
  </div>
</body>
</html>