<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Logout Berhasil</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        * {
            box-sizing: border-box;
            font-family: 'Inter', 'Segoe UI', sans-serif;
        }

        body {
            margin: 0;
            height: 100vh;
            background:
                radial-gradient(circle at top right, #e0f2fe, transparent 45%),
                radial-gradient(circle at bottom left, #ecfeff, transparent 45%),
                linear-gradient(180deg, #eef5f4, #eaf5f3);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #1f2937;
        }

        .logout-card {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(12px);
            border-radius: 28px;
            padding: 48px 44px;
            width: 420px;
            text-align: center;
            box-shadow:
                0 30px 60px rgba(15, 23, 42, 0.15),
                inset 0 1px 0 rgba(255, 255, 255, 0.7);
            animation: fadeUp 0.7s ease forwards;
        }

        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* ICON */
        .icon-wrap {
            width: 84px;
            height: 84px;
            margin: 0 auto 24px;
            border-radius: 22px;
            background: linear-gradient(135deg, #ef4444, #dc2626);
            display: flex;
            align-items: center;
            justify-content: center;
            animation: pulse 1.6s infinite;
        }

        @keyframes pulse {
            0% { box-shadow: 0 0 0 0 rgba(239,68,68,.45); }
            70% { box-shadow: 0 0 0 18px rgba(239,68,68,0); }
            100% { box-shadow: 0 0 0 0 rgba(239,68,68,0); }
        }

        .icon-wrap svg {
            width: 34px;
            height: 34px;
            color: white;
        }

        h1 {
            font-size: 22px;
            margin: 0 0 8px;
            font-weight: 600;
            color: #18244d;
        }

        p {
            font-size: 14px;
            color: #64748b;
            margin-bottom: 32px;
        }

        .redirect {
            font-size: 13px;
            color: #94a3b8;
        }

        .loader {
            margin: 18px auto 0;
            width: 32px;
            height: 32px;
            border-radius: 50%;
            border: 3px solid #e5e7eb;
            border-top-color: #ef4444;
            animation: spin 0.8s linear infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }
    </style>
</head>
<body>

<div class="logout-card">
    <div class="icon-wrap">
        <i data-lucide="log-out"></i>
    </div>

    <h1>Anda Telah Logout</h1>
    <p>Terima kasih telah menggunakan Smart Campus.<br>
       Anda akan diarahkan kembali ke halaman login.</p>

    <div class="redirect">Mengalihkan ke login...</div>
    <div class="loader"></div>
</div>

<!-- LUCIDE -->
<script src="https://unpkg.com/lucide@latest"></script>
<script>
    lucide.createIcons();

    // Auto redirect
    setTimeout(() => {
        window.location.href = "/login";
    }, 2500);
</script>

</body>
</html>
