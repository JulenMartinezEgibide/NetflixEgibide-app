<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Netflix</title>
    @vite(['resources/css/styles.css', 'resources/js/app.js'])
</head>

<body>
    <div class="form-container">
        <form class="general-form" method="POST" action="{{ route('serie.store') }}" enctype="multipart/form-data">
            @csrf
            <h1>Egibide Netflix</h1>
            <p>Formulario para series</p>
            <div class="input-group">
                <input type="text" id="Nombre" name="Nombre" placeholder="Titulo" required>
            </div>
            <div class="input-group">
                <input type="text" id="Director" name="Director" placeholder="Director" required>
            </div>
            <div class="input-group">
                <p>Seleccionar categoria:</p>
                <select name="Categoria" id="Categoria">
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
            <div class="input-group">
                <p>Añadir imagen:</p>
                <input type="text" id="ArchivoImagen" name="ArchivoImagen" placeholder="Nombre imagen" required>
                <input type="file" id="img" name="img" required>
            </div>
            @if ($errors->any())
                <div class="input-group">

                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>

                </div>
            @endif
            <div class="input-group">
                <button type="submit">Añadir</button>

                <a href=" {{ route('serie.store') }} " class="button-link">Volver</a>
            </div>
        </form>
    </div>
</body>

</html>
