<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accés - La Meva Llista</title>
    <style>
        body {
            font-family: system-ui, -apple-system, sans-serif;
            background-color: #111827;
            color: #f3f4f6;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .login-box {
            background-color: #1f2937;
            padding: 40px;
            border-radius: 12px;
            border: 1px solid #374151;
            box-shadow: 0 10px 25px rgba(0,0,0,0.5);
            text-align: center;
            width: 100%;
            max-width: 320px;
        }
        .login-box h1 { margin-top: 0; font-size: 24px; margin-bottom: 24px; }
        .login-input {
            width: 100%;
            padding: 12px;
            margin-bottom: 16px;
            background: #111827;
            border: 1px solid #4b5563;
            color: white;
            border-radius: 6px;
            box-sizing: border-box;
        }
        .login-btn {
            width: 100%;
            padding: 12px;
            background-color: #2563eb;
            color: white;
            border: none;
            border-radius: 6px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.2s;
        }
        .login-btn:hover { background-color: #1d4ed8; }
        .error-msg { color: #ef4444; margin-bottom: 16px; font-size: 14px; }
    </style>
</head>
<body>
    <div class="login-box">
        <h1>🛒 Accés Privat</h1>
        
        <?php if (isset($error_login)): ?>
            <div class="error-msg"><?= $error_login ?></div>
        <?php endif; ?>

        <form action="index.php?action=fer_login" method="POST">
            <input type="password" name="password" class="login-input" placeholder="Introdueix la contrasenya" required autofocus>
            <button type="submit" class="login-btn">Entrar</button>
        </form>
    </div>
</body>
</html>