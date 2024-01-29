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
    
    <div class="search-container">
        <h2>Busqueda por categoria</h2>
        <form class="search-form">
            <div class="second-input-group">
                <select name="selector" id="selector">
                    <option value="option1">Option 1</option>
                    <option value="option2">Option 2</option>
                    <option value="option3">Option 3</option>
                </select>
            </div>
            <button type="submit" id="search-button">Buscar</button>
        </form>
    </div>

    @if(session('user') && session('user')['type'] == 'Admin')
        
            <div class="admin-container">
                <h2>Herramientas del administrador</h2>
                <div class="admin-buttons">
                    <a href="{{ route('pelicula.create') }}" class="button-link">Añadir película</a>
                </div>
            </div>
        
    @endif

    <div class="content-container">
        <h2>Peliculas</h2>
        <div class="peliculas-grid">
            @foreach($peliculas as $pelicula)
                <div class="pelicula-card">
                    <div class="pelicula-card-header">
                        <h3>{{ $pelicula['Nombre'] }}</h3>
                    </div>
                    <div class="pelicula-card-body">
                        <img src="{{ $pelicula['ArchivoImagen'] }}" alt="Imagen de la pelicula">
                    </div>
                    <div class="pelicula-card-footer">
                        <a href="{{ route('pelicula.show',['id' => $pelicula['id']]) }}" class="button-link">Ver</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    
    <footer class="footer">
        <p>&copy; 2023 My Website. All rights reserved.</p>
    </footer>
    </div>
</body>
</html>