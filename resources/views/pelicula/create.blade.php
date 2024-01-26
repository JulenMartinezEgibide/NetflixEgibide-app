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
        <form class="login-form" method="POST" action="{{ route('admin.pelicula.store') }}" enctype="multipart/form-data">
          @csrf
          <h1>Egibide Netflix</h1>
          <p>Formulario para peliculas</p>
          <div class="input-group">
            <input type="text" id="Nombre" name="Nombre" placeholder="Titulo" required>
          </div>
          <div class="input-group">
            <input type="text" id="Director" name="Director" placeholder="Director" required>
          </div>
          <div class="input-group">
            <input type="text" id="Duracion" name="Duracion" placeholder="Duracion" required>
          </div>
            <div class="input-group">
                <p>Seleccionar categoria:</p>
                <select name="Categoria" id="Categoria">
                    <option value="option1">Option 1</option>
                    <option value="option2">Option 2</option>
                    <option value="option3">Option 3</option>
                </select>
            </div>
            <div class="input-group">
                <p>Añadir video:</p>
                <input type="text" id="ArchivoVideo" name="ArchivoVideo" placeholder="Nombre video" required>
                <input type="file" id="video" name="video" required>
            </div>
            <div class="input-group">
                <p>Añadir imagen:</p>
                <input type="text" id="ArchivoImagen" name="ArchivoImagen" placeholder="Nombre imagen" required>
                <input type="file" id="img" name="img" required>
            </div>
            <div class="input-group">
                <button type="submit">Añadir</button>
            
                <a href=" {{ route('admin.pelicula.store') }} " class="button-link">Volver</a>
            </div>
        </form>
      </div>
</body>
</html>