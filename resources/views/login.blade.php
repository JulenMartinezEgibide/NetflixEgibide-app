<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    @vite(['resources/css/styles.css', 'resources/js/app.js'])
</head>
<body>
    <div class="login-container">
        <form class="login-form">
          <h1>Egibide Netflix</h1>
          <p>Porfavor entre en su cuenta</p>
          <div class="input-group">
            <input type="text" id="username" name="username" placeholder="Username" required>
          </div>
          <div class="input-group">
            <input type="password" id="password" name="password" placeholder="Password" required>
          </div>
          <button type="submit">Login</button>
        </form>
      </div>
</body>
</html>