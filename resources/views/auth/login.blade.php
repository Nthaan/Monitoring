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

            <form id="loginForm">
                <label>SSO</label>
                <input type="text" id="sso" placeholder="Masukkan ID SSO" required>

                <label>Password</label>
                <input type="password" placeholder="Masukkan password" required>

                <button type="submit">Login</button>
            </form>
        </div>

    </div>
</div>

<script>
document.getElementById('loginForm').addEventListener('submit', function (e) {
    e.preventDefault();

    const sso = document.getElementById('sso').value.toLowerCase().trim();

    let role = 'mahasiswa'; 

    if (sso.includes('admin')) {
        role = 'admin';
    } else if (sso.includes('dosen')) {
        role = 'dosen';
    }

    localStorage.setItem('role', role);

    window.location.href = '/dashboard';
});
</script>

</body>
</html>
