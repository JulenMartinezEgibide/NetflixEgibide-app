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
        <form class="general-form" method="POST" action="{{ route('login') }}">
            @csrf
            <h1>Egibide Netflix</h1>
            <p>Porfavor entre en su cuenta</p>
            <div class="input-group">
                <input type="text" id="username" name="username" placeholder="Username" required>
            </div>
            <div class="input-group">
                <input type="password" id="password" name="password" placeholder="Password" required>
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
            <button type="submit">Login</button>
        </form>
    </div>
</body>

</html>
