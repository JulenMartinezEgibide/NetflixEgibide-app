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
            <h2>Datos del episodio</h2>
            <div class="pelicula-details">
                <img src="{{ $episodio['ArchivoImagen'] }}" alt="{{ $episodio['Nombre'] }}" class="pelicula-image">
                <div class="pelicula-info">
                    <div class="info-title">
                        <h3>{{ $episodio['Nombre'] }}</h3>
                    </div>
                    <div class="info-item">
                        <span>Descripcion:</span>
                        <span>{{ $episodio['Descripcion'] }}</span>
                    </div>
                    <div class="info-item">
                        <span>Duracion:</span>
                        <span>{{ $episodio['Duracion'] }}</span>
                    </div>
                    <div class="info-buttons">
                        @if (session('user') && session('user')['type'] == 'Admin')
                            <form method="POST"
                                action="{{ route('episodio.destroy', ['id' => $serie['id'], 'id_ep' => $episodio['id']]) }}">
                                @csrf
                                @method('DELETE')

                                <button type="submit">Eliminar</button>
                            </form>
                        @endif
                        <a href="{{ route('episodio.descargar', ['id' => $serie['id'], 'id_ep' => $episodio['id']]) }}"
                            class="button-link">Descargar</a>
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
