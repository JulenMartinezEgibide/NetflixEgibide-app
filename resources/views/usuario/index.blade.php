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
        <h2>Busqueda por tipo</h2>
        <form class="search-form" method="POST" action="{{ route('usuario.load') }}">
            @csrf
            <div class="second-input-group">
                <select name="selector" id="selector">
                    <option value="Admin">Admin</option>
                    <option value="Alumno">Alumno</option>
                </select>
            </div>
            <button type="submit" id="search-button">Buscar</button>
        </form>
    </div>

    @if(session('user') && session('user')['type'] == 'Admin')
        
            <div class="admin-container">
                <h2>Herramientas del administrador</h2>
                <div class="admin-buttons">
                    <a href="{{ route('usuario.create') }}" class="button-link">Añadir usuario</a>
                </div>
            </div>
        
    @endif

    <div class="content-container">
        <h2>Usuarios</h2>
        <div class="usuario-grid">
            @foreach($usuarios as $usuario)
                <div class="usuario-card">
                    <div class="usuario-card-header">
                        <h3>{{ $usuario['username'] }}</h3>
                    </div>
                    <div class="usuario-card-body">
                        <p>ID: {{ $usuario['id'] }}</p>
                    </div>
                    <div class="usuario-card-footer">
                        <a href="{{ route('usuario.show',['id' => $usuario['id']]) }}" class="button-link">Ver</a>
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