<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Netflix</title>
    @vite(['resources/css/styles.css', 'resources/js/app.js','resources/js/nav.js'])
</head>
<body>
    <div class="grid-container">
    <nav class="navbar">
        <ul class="navbar-menu">
          <li class="navbar-item"><a href="{{ route('pelicula.index') }}" class="navbar-link">Películas</a></li>
          <li class="navbar-item"><a href=" {{ route('serie.index') }} " class="navbar-link">Series</a></li>
          @if(session('user') && session('user')['type'] == 'Admin')
          <li class="navbar-item"><a href="{{ route('usuario.index') }}" class="navbar-link">Usuarios</a></li>
          @endif
          <li class="navbar-item navbar-item-right"><a href=" {{ route('login.index') }} " class="navbar-link">Cerrar sesión</a></li>
        </ul>
    </nav>
    
    <div class="search-container">
        <h2>Busqueda por categoria</h2>
        <form class="search-form" method="POST" action="{{ route('serie.load') }}">
            @csrf
            <div class="second-input-group">
                <select name="selector" id="selector">
                    <option value="Fantasia">Fantasía</option>
                    <option value="Aventuras">Aventuras</option>
                    <option value="Comedia">Comedia</option>
                    <option value="Drama">Drama</option>
                    <option value="Ciencia Ficcion">Ciencia Ficción</option>
                    <option value="Musical">Musical</option>
                    <option value="Romance">Romance</option>
                    <option value="Terror">Terror</option>
                </select>
            </div>
            <button type="submit" id="search-button">Buscar</button>
        </form>
    </div>

    @if(session('user') && session('user')['type'] == 'Admin')
        
            <div class="admin-container">
                <h2>Herramientas del administrador</h2>
                <div class="admin-buttons">
                    <a href="{{ route('serie.create') }}" class="button-link">Añadir serie</a>
                </div>
            </div>
        
    @endif

    <div class="content-container">
        <h2>Series</h2>
        <div class="peliculas-grid">
            @foreach($series as $serie)
                <div class="pelicula-card">
                    <div class="pelicula-card-header">
                        <h3>{{ $serie['Nombre'] }}</h3>
                    </div>
                    <div class="pelicula-card-body">
                        <img src="{{ $serie['ArchivoImagen'] }}" alt="Imagen de la pelicula">
                    </div>
                    <div class="pelicula-card-footer">
                        <a href="{{ route('serie.show',['id' => $serie['id']]) }}" class="button-link">Ver</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    
    <footer class="footer">
        <p>&copy; 2024 Egibide Netflix. All rights reserved.</p>
    </footer>
    </div>
</body>
</html>