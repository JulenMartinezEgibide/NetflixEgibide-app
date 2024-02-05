<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Netflix</title>
    @vite(['resources/css/styles.css', 'resources/js/app.js', 'resources/js/nav.js'])
</head>

<body>
    <div class="grid-container">
        <nav class="navbar">
            <ul class="navbar-menu">
                <li class="navbar-item"><a href="{{ route('pelicula.index') }}" class="navbar-link">Películas</a></li>
                <li class="navbar-item"><a href=" {{ route('serie.index') }} " class="navbar-link">Series</a></li>
                @if (session('user') && session('user')['type'] == 'Admin')
                    <li class="navbar-item"><a href="{{ route('usuario.index') }}" class="navbar-link">Usuarios</a></li>
                @endif
                <li class="navbar-item navbar-item-right"><a href=" {{ route('login.index') }} "
                        class="navbar-link">Cerrar sesión</a></li>
            </ul>
        </nav>

        <div class="content-container">
            <h2>Datos del usuario</h2>
            <div class="pelicula-details">

                <div class="pelicula-info">
                    <div class="info-title">
                        <h3>{{ $usuario['username'] }}</h3>
                    </div>
                    <div class="info-item">
                        <span>Id:</span>
                        <span>{{ $usuario['id'] }}</span>
                    </div>
                    <div class="info-item">
                        <span>Contraseña:</span>
                        <span>{{ $usuario['password'] }}</span>
                    </div>
                    <div class="info-item">
                        <span>Tipo cuenta:</span>
                        <span>{{ $usuario['type'] }}</span>
                    </div>
                    <div class="info-item">
                        <span>Ultima descarga:</span>
                        <span>{{ $usuario['ultima_busqueda'] }}</span>
                    </div>
                    <div class="info-buttons">
                        @if (session('user') && session('user')['type'] == 'Admin')
                            <form method="POST" action="{{ route('usuario.destroy', ['id' => $usuario['id']]) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit">Eliminar</button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <footer class="footer">
            <p>&copy; 2024 Egibide Netflix. All rights reserved.</p>
        </footer>
    </div>
</body>

</html>
