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
        <form class="login-form" method="POST" action="{{ route('pelicula.store') }}" enctype="multipart/form-data">
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
                    <option value="Fantasia">Fantasia</option>
                    <option value="Aventuras">Aventuras</option>
                    <option value="Comedia">Comedia</option>
                    <option value="Drama">Drama</option>
                    <option value="Ciencia Ficcion">Ciencia Ficcion</option>
                    <option value="Musical">Musical</option>
                    <option value="Romance">Romance</option>
                    <option value="Terror">Terror</option>
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
            
                <a href=" {{ route('pelicula.store') }} " class="button-link">Volver</a>
            </div>
        </form>
      </div>
</body>
</html>