<!DOCTYPE html>
<html lang="az">
<head>
    <meta charset="utf-8">
    <title>LingoAZ — İngilis dili öyrən</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="LingoAZ — Azərbaycanlılar üçün ən ağıllı ingilis dili öyrənmə tətbiqi">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }

        :root {
            --primary: #6C63FF;
            --primary-dark: #4C46B8;
            --secondary: #FF6584;
            --accent: #43E97B;
            --dark: #0A0A1A;
            --card-bg: rgba(255,255,255,0.05);
            --border: rgba(255,255,255,0.1);
            --text-muted: rgba(255,255,255,0.55);
        }

        html { scroll-behavior: smooth; }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--dark);
            color: #fff;
            overflow-x: hidden;
        }

        /* ── Background ── */
        .bg-orbs {
            position: fixed;
            inset: 0;
            pointer-events: none;
            z-index: 0;
            overflow: hidden;
        }
        .orb {
            position: absolute;
            border-radius: 50%;
            filter: blur(80px);
            opacity: 0.35;
            animation: float 12s ease-in-out infinite;
        }
        .orb-1 { width: 600px; height: 600px; background: var(--primary); top: -200px; left: -150px; animation-delay: 0s; }
        .orb-2 { width: 500px; height: 500px; background: var(--secondary); bottom: -150px; right: -100px; animation-delay: 4s; }
        .orb-3 { width: 350px; height: 350px; background: var(--accent); top: 40%; left: 50%; transform: translate(-50%,-50%); animation-delay: 8s; }

        @keyframes float {
            0%,100% { transform: translateY(0) scale(1); }
            50% { transform: translateY(-40px) scale(1.05); }
        }

        /* ── Layout ── */
        .wrapper { position: relative; z-index: 1; }

        /* ── Navbar ── */
        nav {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 24px 48px;
            border-bottom: 1px solid var(--border);
            backdrop-filter: blur(12px);
            position: sticky;
            top: 0;
            z-index: 100;
            background: rgba(10,10,26,0.6);
        }
        .nav-logo {
            font-size: 1.5rem;
            font-weight: 800;
            letter-spacing: -0.5px;
            background: linear-gradient(90deg, #fff 0%, rgba(255,255,255,0.6) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .nav-logo span { color: var(--primary); -webkit-text-fill-color: var(--primary); }
        .nav-cta {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: var(--primary);
            color: #fff;
            text-decoration: none;
            padding: 10px 22px;
            border-radius: 50px;
            font-size: 0.875rem;
            font-weight: 600;
            transition: all 0.2s;
        }
        .nav-cta:hover { background: var(--primary-dark); transform: translateY(-1px); }

        /* ── Hero ── */
        .hero {
            min-height: 90vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 80px 24px 60px;
        }
        .badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(108,99,255,0.15);
            border: 1px solid rgba(108,99,255,0.4);
            border-radius: 50px;
            padding: 6px 16px;
            font-size: 0.8rem;
            font-weight: 600;
            color: #a89fff;
            margin-bottom: 28px;
            animation: fadeUp 0.6s ease both;
        }
        .badge-dot {
            width: 6px; height: 6px;
            background: var(--accent);
            border-radius: 50%;
            animation: pulse 2s ease infinite;
        }
        @keyframes pulse {
            0%,100% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.4; transform: scale(1.5); }
        }

        .hero-title {
            font-size: clamp(2.8rem, 7vw, 5.5rem);
            font-weight: 900;
            line-height: 1.05;
            letter-spacing: -2px;
            animation: fadeUp 0.6s 0.1s ease both;
        }
        .hero-title .highlight {
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .hero-desc {
            margin-top: 24px;
            max-width: 560px;
            font-size: clamp(1rem, 2vw, 1.2rem);
            color: var(--text-muted);
            line-height: 1.7;
            font-weight: 400;
            animation: fadeUp 0.6s 0.2s ease both;
        }

        .hero-actions {
            display: flex;
            gap: 16px;
            margin-top: 44px;
            flex-wrap: wrap;
            justify-content: center;
            animation: fadeUp 0.6s 0.3s ease both;
        }

        .btn-primary {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: var(--primary);
            color: #fff;
            text-decoration: none;
            padding: 16px 32px;
            border-radius: 50px;
            font-size: 1rem;
            font-weight: 700;
            transition: all 0.25s;
            box-shadow: 0 8px 40px rgba(108,99,255,0.45);
        }
        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 16px 50px rgba(108,99,255,0.55);
            background: #7c75ff;
        }
        .btn-primary svg { flex-shrink: 0; }

        .btn-secondary {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: var(--card-bg);
            border: 1px solid var(--border);
            color: #fff;
            text-decoration: none;
            padding: 16px 32px;
            border-radius: 50px;
            font-size: 1rem;
            font-weight: 600;
            transition: all 0.25s;
            backdrop-filter: blur(8px);
        }
        .btn-secondary:hover {
            background: rgba(255,255,255,0.1);
            transform: translateY(-3px);
        }

        .hero-stats {
            display: flex;
            gap: 48px;
            margin-top: 64px;
            animation: fadeUp 0.6s 0.4s ease both;
            flex-wrap: wrap;
            justify-content: center;
        }
        .stat { text-align: center; }
        .stat-num {
            font-size: 2rem;
            font-weight: 800;
            background: linear-gradient(135deg, #fff 0%, rgba(255,255,255,0.6) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .stat-label { font-size: 0.8rem; color: var(--text-muted); margin-top: 4px; font-weight: 500; }

        /* ── Features ── */
        .section {
            padding: 100px 24px;
            max-width: 1100px;
            margin: 0 auto;
        }
        .section-label {
            text-align: center;
            font-size: 0.8rem;
            font-weight: 700;
            letter-spacing: 2px;
            color: var(--primary);
            text-transform: uppercase;
            margin-bottom: 16px;
        }
        .section-title {
            text-align: center;
            font-size: clamp(1.8rem, 4vw, 2.8rem);
            font-weight: 800;
            letter-spacing: -1px;
            line-height: 1.2;
            margin-bottom: 16px;
        }
        .section-desc {
            text-align: center;
            color: var(--text-muted);
            font-size: 1rem;
            max-width: 480px;
            margin: 0 auto 60px;
            line-height: 1.7;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
        }

        .feature-card {
            background: var(--card-bg);
            border: 1px solid var(--border);
            border-radius: 20px;
            padding: 32px;
            backdrop-filter: blur(8px);
            transition: all 0.3s;
            position: relative;
            overflow: hidden;
        }
        .feature-card::before {
            content: '';
            position: absolute;
            inset: 0;
            border-radius: 20px;
            background: linear-gradient(135deg, rgba(108,99,255,0.08) 0%, transparent 60%);
            opacity: 0;
            transition: opacity 0.3s;
        }
        .feature-card:hover { transform: translateY(-6px); border-color: rgba(108,99,255,0.4); }
        .feature-card:hover::before { opacity: 1; }

        .feature-icon {
            width: 52px; height: 52px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-bottom: 20px;
        }
        .feature-title {
            font-size: 1.1rem;
            font-weight: 700;
            margin-bottom: 10px;
        }
        .feature-desc {
            font-size: 0.9rem;
            color: var(--text-muted);
            line-height: 1.65;
        }

        /* ── Download ── */
        .download-section {
            padding: 100px 24px;
            text-align: center;
        }
        .download-card {
            max-width: 700px;
            margin: 0 auto;
            background: linear-gradient(135deg, rgba(108,99,255,0.2) 0%, rgba(255,101,132,0.1) 100%);
            border: 1px solid rgba(108,99,255,0.3);
            border-radius: 32px;
            padding: 64px 40px;
            backdrop-filter: blur(16px);
            position: relative;
            overflow: hidden;
        }
        .download-card::after {
            content: '';
            position: absolute;
            top: -80px; right: -80px;
            width: 300px; height: 300px;
            background: radial-gradient(circle, rgba(108,99,255,0.3) 0%, transparent 70%);
            pointer-events: none;
        }
        .download-title {
            font-size: clamp(1.8rem, 4vw, 2.5rem);
            font-weight: 800;
            letter-spacing: -1px;
            margin-bottom: 16px;
        }
        .download-desc {
            color: var(--text-muted);
            font-size: 1rem;
            line-height: 1.7;
            margin-bottom: 40px;
            max-width: 420px;
            margin-left: auto;
            margin-right: auto;
        }
        .download-btns {
            display: flex;
            gap: 16px;
            justify-content: center;
            flex-wrap: wrap;
        }
        .store-btn {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            background: #fff;
            color: #0A0A1A;
            text-decoration: none;
            padding: 14px 28px;
            border-radius: 16px;
            font-weight: 700;
            transition: all 0.25s;
            min-width: 180px;
        }
        .store-btn:hover { transform: translateY(-3px); box-shadow: 0 12px 40px rgba(0,0,0,0.3); }
        .store-btn-icon { font-size: 1.8rem; line-height: 1; }
        .store-btn-text { text-align: left; }
        .store-btn-small { font-size: 0.7rem; font-weight: 500; color: #555; display: block; }
        .store-btn-name { font-size: 1rem; font-weight: 800; display: block; }

        /* ── Footer ── */
        footer {
            border-top: 1px solid var(--border);
            padding: 32px 48px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 16px;
        }
        .footer-logo {
            font-size: 1.2rem;
            font-weight: 800;
            letter-spacing: -0.5px;
        }
        .footer-logo span { color: var(--primary); }
        footer p { font-size: 0.8rem; color: var(--text-muted); }

        /* ── Animations ── */
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(24px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        /* ── Responsive ── */
        @media (max-width: 768px) {
            nav { padding: 18px 20px; }
            .hero { padding: 60px 20px 40px; }
            .hero-stats { gap: 32px; }
            .section { padding: 70px 20px; }
            footer { padding: 24px 20px; }
            .download-card { padding: 48px 24px; }
        }
    </style>
</head>
<body>

<div class="bg-orbs">
    <div class="orb orb-1"></div>
    <div class="orb orb-2"></div>
    <div class="orb orb-3"></div>
</div>

<div class="wrapper">

    <!-- Navbar -->
    <nav>
        <div class="nav-logo">Lingo<span>AZ</span></div>
        <a href="#download" class="nav-cta">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
            Tətbiqi yüklə
        </a>
    </nav>

    <!-- Hero -->
    <section class="hero">
        <div class="badge">
            <span class="badge-dot"></span>
            Azərbaycanlılar üçün hazırlanıb
        </div>

        <h1 class="hero-title">
            İngilis dilini<br>
            <span class="highlight">ağıllı şəkildə</span> öyrən
        </h1>

        <p class="hero-desc">
            LingoAZ — şəxsi lüğət, cümlə quruluşu, qeydlər və günün sözü ilə ingilis dilini öz sürətiylə öyrənmək üçün hazırlanmış tətbiq.
        </p>

        <div class="hero-actions">
            <a href="#download" class="btn-primary">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                İndi yüklə — Pulsuz
            </a>
            <a href="#features" class="btn-secondary">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polygon points="10 8 16 12 10 16 10 8"/></svg>
                Xüsusiyyətlər
            </a>
        </div>

        <div class="hero-stats">
            <div class="stat">
                <div class="stat-num">10K+</div>
                <div class="stat-label">İstifadəçi</div>
            </div>
            <div class="stat">
                <div class="stat-num">50K+</div>
                <div class="stat-label">Öyrənilən söz</div>
            </div>
            <div class="stat">
                <div class="stat-num">4.8★</div>
                <div class="stat-label">Ortalama reytinq</div>
            </div>
            <div class="stat">
                <div class="stat-num">100%</div>
                <div class="stat-label">Pulsuz</div>
            </div>
        </div>
    </section>

    <!-- Features -->
    <section class="section" id="features">
        <p class="section-label">Niyə LingoAZ?</p>
        <h2 class="section-title">Öyrənməyi asanlaşdıran<br>xüsusiyyətlər</h2>
        <p class="section-desc">Hər xüsusiyyət sənin öyrənmə sürətini artırmaq üçün düşünülüb.</p>

        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon" style="background: rgba(108,99,255,0.15);">📚</div>
                <h3 class="feature-title">Şəxsi lüğət</h3>
                <p class="feature-desc">Öyrəndiyin sözləri qruplara böl, kateqoriyalara ayır və istənilən vaxt geri qayıt. Sözlər öz lüğətin — öz nizamın.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon" style="background: rgba(67,233,123,0.15);">🔊</div>
                <h3 class="feature-title">Audio tələffüz</h3>
                <p class="feature-desc">Hər sözün düzgün tələffüzünü eşit. Öz audio yazılarını da əlavə edə bilərsən — öyrənmə daha effektiv olur.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon" style="background: rgba(255,101,132,0.15);">✍️</div>
                <h3 class="feature-title">Cümlə lüğəti</h3>
                <p class="feature-desc">Sözü kontekstdə öyrən. Öz cümlələrini yaz, saxla və qruplara ayır. Cümlə ilə öyrənmək yadda saxlamağı asanlaşdırır.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon" style="background: rgba(255,200,60,0.15);">📝</div>
                <h3 class="feature-title">Qeydlər</h3>
                <p class="feature-desc">Qrammatika qaydaları, faydalı ifadələr, şəxsi notlar — hamısı bir yerdə. Qeydlərini qruplara ayır, asanlıqla tap.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon" style="background: rgba(0,200,255,0.12);">⭐</div>
                <h3 class="feature-title">Günün sözü</h3>
                <p class="feature-desc">Hər gün yeni bir söz öyrən. Mənası, nümunə cümlələri və audio tələffüzü ilə birlikdə — gündə bir söz, ildə 365 söz.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon" style="background: rgba(108,99,255,0.15);">🗂️</div>
                <h3 class="feature-title">Qruplar və kateqoriyalar</h3>
                <p class="feature-desc">Sözlərini mövzulara görə təşkil et — iş lüğəti, səyahət, texnologiya. Öyrənmə daha sistematik, nəticə daha güclü olur.</p>
            </div>
        </div>
    </section>

    <!-- Download -->
    <section class="download-section" id="download">
        <div class="download-card">
            <h2 class="download-title">Öyrənməyə bu gün başla</h2>
            <p class="download-desc">
                LingoAZ-ı yüklə, hesabını yarat və şəxsi lüğətini qurmağa başla. Tamamilə pulsuzdur.
            </p>
            <div class="download-btns">
                <a href="#" class="store-btn">
                    <span class="store-btn-icon">🍎</span>
                    <span class="store-btn-text">
                        <span class="store-btn-small">App Store-da yüklə</span>
                        <span class="store-btn-name">App Store</span>
                    </span>
                </a>
                <a href="#" class="store-btn">
                    <span class="store-btn-icon">▶️</span>
                    <span class="store-btn-text">
                        <span class="store-btn-small">Google Play-də yüklə</span>
                        <span class="store-btn-name">Google Play</span>
                    </span>
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="footer-logo">Lingo<span>AZ</span></div>
        <p>© {{ date('Y') }} LingoAZ. Bütün hüquqlar qorunur.</p>
    </footer>

</div>

</body>
</html>
