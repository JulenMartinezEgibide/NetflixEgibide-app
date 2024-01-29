<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    @vite(['resources/css/styles.css', 'resources/js/app.js'])
</head>
<body>
    <div class="grid-container">
    <nav class="navbar">
        <ul class="navbar-menu">
          <li class="navbar-item"><a href="#" class="navbar-link">Peliculas</a></li>
          <li class="navbar-item"><a href="#" class="navbar-link">Series</a></li>
          <li class="navbar-item navbar-item-right"><a href=" {{ route('login.index') }} " class="navbar-link">Cerrar sesion</a></li>
        </ul>
    </nav>
    
    <div class="content-container">
        <h2>Datos de la pelicula</h2>
        <div class="pelicula-details">
            <img src="{{ $pelicula['ArchivoImagen'] }}" alt="{{ $pelicula['Nombre'] }}" class="pelicula-image">
            <div class="pelicula-info">
                <div class="info-title">
                    <h3>{{ $pelicula['Nombre'] }}</h3>
                </div>
                <div class="info-item">
                    <span>Categoría:</span>
                    <span>{{ $pelicula['Categoria'] }}</span>
                </div>
                <div class="info-item">
                    <span>Director:</span>
                    <span>{{ $pelicula['Director'] }}</span>
                </div>
                <div class="info-item">
                    <span>Duración:</span>
                    <span>{{ $pelicula['Duracion'] }}</span>
                </div>
                <div class="info-buttons">
                    @if(session('user') && session('user')['type'] == 'Admin')
                        <form method="POST">
                            @csrf
                            @method("DELETE")
                   
                          <button type="submit">Eliminar</button>
                        </form>
                    @endif
                    <a href="{{ route('pelicula.descargar', ['id' => $pelicula['id']]) }}" class="button-link">Descargar</a>
                </div>
            </div>
        </div>
    </div>
    
    <footer class="footer">
        <p>&copy; 2023 My Website. All rights reserved.</p>
    </footer>
    </div>
</body>
</html>