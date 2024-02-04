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
        <form class="general-form" method="POST" action="{{ route('usuario.store') }}">
          @csrf
          <h1>Egibide Netflix</h1>
          <p>Formulario para usuarios</p>
          <div class="input-group">
            <input type="text" id="username" name="username" placeholder="Usuario" required>
          </div>
          <div class="input-group">
            <input type="password" id="password" name="password" placeholder="Contraseña" required>
          </div>
            <div class="input-group">
                <p>Seleccionar tipo usuario:</p>
                <select name="Categoria" id="Categoria">
                    <option value="Admin">Admin</option>
                    <option value="Alumno">Alumno</option>
                </select>
            </div>
            <div class="input-group">
                <button type="submit">Añadir</button>
            
                <a href=" {{ route('usuario.store') }} " class="button-link">Volver</a>
            </div>
        </form>
      </div>
</body>
</html>