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

    @if(session('user') && session('user')['type'] == 'Admin')
        
            <div class="admin-container">
                <h2>Herramientas del administrador</h2>
                <div class="admin-buttons">
                    <a href="{{ route('episodio.create', ['id' => $serie['id']])}}" class="button-link">Añadir episodio</a>
                </div>
            </div>
        
    @endif
    
    <div class="content-container">
        <div class="content-apart">
        <h2>Datos de la serie</h2>
        <div class="pelicula-details">
            <img src="{{ $serie['ArchivoImagen'] }}" alt="{{ $serie['Nombre'] }}" class="pelicula-image">
            <div class="pelicula-info">
                <div class="info-title">
                    <h3>{{ $serie['Nombre'] }}</h3>
                </div>
                <div class="info-item">
                    <span>Categoría:</span>
                    <span>{{ $serie['Categoria'] }}</span>
                </div>
                <div class="info-item">
                    <span>Director:</span>
                    <span>{{ $serie['Director'] }}</span>
                </div>
                <div class="info-buttons">
                    @if(session('user') && session('user')['type'] == 'Admin')
                    <form method="POST" action="{{ route('serie.destroy', ['id' => $serie['id']]) }}">
                        @csrf
                        @method("DELETE")
                    
                        <button type="submit">Eliminar</button>
                    </form>
                    @endif
                    <a href="{{ route('serie.descargar', ['id' => $serie['id']]) }}" class="button-link">Descargar</a>
                </div>
            </div>
        </div>
        </div>

        <div class="content-apart">
        <h2>Episodios</h2>
        <div class="peliculas-grid">
            @foreach($episodios as $episodio)
                <div class="pelicula-card">
                    <div class="pelicula-card-header">
                        <h3>{{ $episodio['Nombre_episodio'] }}</h3>
                    </div>
                    <div class="pelicula-card-body">
                        <img src="{{ asset("storage/{$episodio->ArchivoImagen}") }}" alt="Imagen de la episodio">
                    </div>
                    <div class="pelicula-card-footer">
                        <a href="{{ route('episodio.show',['id' => $serie['id'],'id_ep' => $episodio['id']]) }}" class="button-link">Ver</a>
                    </div>
                </div>
            @endforeach
        </div>
        </div>
    </div>

    <footer class="footer">
        <p>&copy; 2024 Egibide Netflix. All rights reserved.</p>
    </footer>
    </div>
</body>
</html>