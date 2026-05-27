<!DOCTYPE html>
<html lang="az">
<head>
    <meta charset="utf-8">
    <title>lingoaz</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="lingoaz — Ingilis dili öyrənmə platforması">
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            color: #fff;
            padding: 24px;
        }

        .name {
            font-size: clamp(3rem, 10vw, 6rem);
            font-weight: 800;
            letter-spacing: -2px;
            color: #fff;
            line-height: 1;
        }

        .tagline {
            margin-top: 16px;
            font-size: clamp(1rem, 3vw, 1.25rem);
            color: rgba(255,255,255,0.75);
            font-weight: 400;
            letter-spacing: 0.5px;
        }

        .divider {
            width: 48px;
            height: 3px;
            background: rgba(255,255,255,0.4);
            border-radius: 2px;
            margin: 32px auto;
        }

        .features {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 12px;
            max-width: 480px;
        }

        .feature {
            background: rgba(255,255,255,0.12);
            border: 1px solid rgba(255,255,255,0.2);
            border-radius: 40px;
            padding: 8px 20px;
            font-size: 0.875rem;
            color: rgba(255,255,255,0.9);
            backdrop-filter: blur(8px);
            font-weight: 500;
        }

        .footer {
            position: fixed;
            bottom: 24px;
            font-size: 0.75rem;
            color: rgba(255,255,255,0.4);
        }
    </style>
</head>
<body>
    <div style="text-align:center">
        <div class="name">lingoaz</div>
        <div class="tagline">Ingilis dili öyrənmə platforması</div>
        <div class="divider"></div>
        <div class="features">
            <span class="feature">Şəxsi lüğət</span>
            <span class="feature">Söz öyrən</span>
            <span class="feature">Cümlə lüğəti</span>
            <span class="feature">Qeydlər</span>
            <span class="feature">Günün sözü</span>
            <span class="feature">Audio tələffüz</span>
        </div>
    </div>

    <div class="footer">© {{ date('Y') }} lingoaz</div>
</body>
</html>
