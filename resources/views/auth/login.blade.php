<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>

<div class="container">
    <div class="login-card">

        <div class="left-panel">
            <img src="{{ asset('images/nairaanjay.png') }}">
        </div>

        <div class="right-panel">
            <h2>Welcome to<br>
                <span>Smart Campus Workflow Monitoring System</span>
            </h2>

            <form>
                <label>SSO</label>
                <input type="text" placeholder="Masukkan ID SSO">

                <label>Password</label>
                <input type="password" placeholder="Masukkan password">

            </form>

            <form action="/dashboard">
                <button type="submit">Login</button>
            </form>

        </div>

    </div>
</div>

</body>
</html>
