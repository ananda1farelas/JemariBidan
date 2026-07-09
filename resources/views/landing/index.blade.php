{{-- resources/views/landing/index.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="{{ asset('images/favicon.ico') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/apple-touch-icon.png') }}">
    <title>Jemari Bidan — Treatment Ibu & Anak Surabaya</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --forest: #1a472a;
            --sage: #4a7c59;
            --sage-light: #6b9b7a;
            --mint: #b8d4c0;
            --cream: #f8f6f0;
            --warm-white: #faf9f7;
            --charcoal: #2c2c2c;
            --gray: #6b7280;
            --light-gray: #e5e7eb;
            --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            --shadow-xl: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        /* ===== CUSTOM SCROLLBAR ===== */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: var(--cream);
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb {
            background: linear-gradient(180deg, var(--sage), var(--forest));
            border-radius: 4px;
            transition: background 0.2s;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(180deg, var(--sage-light), var(--sage));
        }

        /* Firefox */
        * {
            scrollbar-width: thin;
            scrollbar-color: var(--sage) var(--cream);
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }
        html { scroll-behavior: smooth; }
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background: var(--warm-white);
            color: var(--charcoal);
            line-height: 1.6;
            -webkit-font-smoothing: antialiased;
        }

        /* ===== NAVBAR ===== */
        .navbar {
            position: fixed;
            top: 0; left: 0; right: 0;
            z-index: 1000;
            background: rgba(250, 249, 247, 0.85);
            backdrop-filter: blur(20px) saturate(180%);
            -webkit-backdrop-filter: blur(20px) saturate(180%);
            border-bottom: 1px solid rgba(0,0,0,0.04);
            transition: all 0.3s ease;
        }
        .navbar.scrolled {
            box-shadow: var(--shadow-md);
            background: rgba(250, 249, 247, 0.95);
        }
        .navbar-inner {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 24px;
            height: 72px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
        }
        .brand-mark {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid rgba(74, 124, 89, 0.2);
            box-shadow: var(--shadow-sm);
        }
        .brand-text {
            font-family: 'Playfair Display', serif;
            font-size: 22px;
            font-weight: 700;
            color: var(--forest);
            letter-spacing: -0.5px;
        }
        .nav-links {
            display: flex;
            align-items: center;
            gap: 8px;
            list-style: none;
        }
        .nav-links a {
            text-decoration: none;
            color: var(--gray);
            font-size: 14px;
            font-weight: 500;
            padding: 8px 16px;
            border-radius: 8px;
            transition: all 0.2s ease;
        }
        .nav-links a:hover {
            color: var(--forest);
            background: rgba(74, 124, 89, 0.08);
        }
        .nav-cta {
            background: var(--forest);
            color: white !important;
            padding: 10px 24px !important;
            font-weight: 600 !important;
            border-radius: 10px !important;
            transition: all 0.2s ease;
            box-shadow: var(--shadow-sm);
        }
        .nav-cta:hover {
            background: var(--sage) !important;
            transform: translateY(-1px);
            box-shadow: var(--shadow-md);
        }
        .menu-toggle {
            display: none;
            background: none;
            border: none;
            font-size: 24px;
            cursor: pointer;
            color: var(--charcoal);
        }

        /* ===== HERO ===== */
        .hero {
            min-height: 100vh;
            display: flex;
            align-items: center;
            padding: 120px 24px 80px;
            background: linear-gradient(180deg, var(--warm-white) 0%, var(--cream) 100%);
            position: relative;
            overflow: hidden;
        }
        .hero::before {
            content: '';
            position: absolute;
            top: -20%; right: -10%;
            width: 700px; height: 700px;
            background: radial-gradient(circle, rgba(74, 124, 89, 0.08) 0%, transparent 70%);
            border-radius: 50%;
            animation: float 20s ease-in-out infinite;
        }
        .hero::after {
            content: '';
            position: absolute;
            bottom: -10%; left: -5%;
            width: 500px; height: 500px;
            background: radial-gradient(circle, rgba(184, 212, 192, 0.15) 0%, transparent 70%);
            border-radius: 50%;
            animation: float 25s ease-in-out infinite reverse;
        }
        @keyframes float {
            0%, 100% { transform: translate(0, 0) scale(1); }
            50% { transform: translate(30px, -30px) scale(1.05); }
        }
        .hero-inner {
            max-width: 1200px;
            margin: 0 auto;
            width: 100%;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 80px;
            align-items: center;
            position: relative;
            z-index: 1;
        }
        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(74, 124, 89, 0.1);
            color: var(--sage);
            padding: 8px 16px;
            border-radius: 100px;
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 24px;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }
        .hero-badge::before {
            content: '';
            width: 6px; height: 6px;
            background: var(--sage);
            border-radius: 50%;
            animation: pulse 2s ease-in-out infinite;
        }
        @keyframes pulse {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.5; transform: scale(1.2); }
        }
        .hero h1 {
            font-family: 'Playfair Display', serif;
            font-size: 56px;
            font-weight: 700;
            line-height: 1.15;
            color: var(--forest);
            margin-bottom: 24px;
            letter-spacing: -1px;
        }
        .hero h1 .accent {
            color: var(--sage);
            position: relative;
        }
        .hero h1 .accent::after {
            content: '';
            position: absolute;
            bottom: 4px; left: 0; right: 0;
            height: 8px;
            background: rgba(74, 124, 89, 0.15);
            border-radius: 4px;
            z-index: -1;
        }
        .hero-desc {
            font-size: 18px;
            color: var(--gray);
            line-height: 1.7;
            max-width: 480px;
            margin-bottom: 40px;
        }
        .hero-actions {
            display: flex;
            gap: 16px;
            align-items: center;
        }
        .btn-primary {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: var(--forest);
            color: white;
            padding: 16px 32px;
            border-radius: 12px;
            text-decoration: none;
            font-weight: 600;
            font-size: 15px;
            transition: all 0.3s ease;
            box-shadow: var(--shadow-md);
            border: none;
            cursor: pointer;
        }
        .btn-primary:hover {
            background: var(--sage);
            transform: translateY(-2px);
            box-shadow: var(--shadow-xl);
        }
        .btn-primary svg {
            transition: transform 0.3s ease;
        }
        .btn-primary:hover svg {
            transform: translateX(4px);
        }
        .btn-ghost {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: transparent;
            color: var(--forest);
            padding: 16px 32px;
            border-radius: 12px;
            text-decoration: none;
            font-weight: 600;
            font-size: 15px;
            border: 2px solid var(--mint);
            transition: all 0.3s ease;
        }
        .btn-ghost:hover {
            background: var(--cream);
            border-color: var(--sage);
            transform: translateY(-2px);
        }

        /* HERO VISUAL */
        .hero-visual {
            position: relative;
            display: inline-flex;
            justify-content: center;
            align-items: center;
        }
        .hero-img-wrapper {
            width: 400px;
            aspect-ratio: 3 / 4;
            border-radius: 48px;
            overflow: hidden;
            box-shadow: 0 25px 50px -12px rgba(0,0,0,0.15), 0 0 0 1px rgba(0,0,0,0.05);
            position: relative;
        }
        .hero-img-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center 20%;
        }
        .hero-visual-card {
            position: absolute;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            padding: 14px 18px;
            border-radius: 16px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            display: flex;
            align-items: center;
            gap: 12px;
            border: 1px solid rgba(0,0,0,0.05);
            min-width: 200px;
            transition: transform 0.3s ease;
        }
        .hero-visual-card:hover {
            transform: translateY(-4px);
        }
        .card-1 { top: 12%; right: -8%; animation: slideIn 1s ease-out 0.5s both; }
        .card-2 { bottom: 18%; left: -12%; animation: slideIn 1s ease-out 0.8s both; }
        @keyframes slideIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .card-icon {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            overflow: hidden;
            flex-shrink: 0;
        }
        .card-icon img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .card-info h4 {
            font-size: 14px;
            font-weight: 600;
            color: var(--charcoal);
            margin-bottom: 2px;
        }
        .card-info p {
            font-size: 12px;
            color: var(--gray);
        }

        /* ===== TRUST BAR ===== */
        .trust-bar {
            background: var(--forest);
            padding: 40px 24px;
        }
        .trust-inner {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 40px;
            text-align: center;
        }
        .trust-item h3 {
            font-family: 'Playfair Display', serif;
            font-size: 32px;
            font-weight: 700;
            color: white;
            margin-bottom: 4px;
        }
        .trust-item p {
            font-size: 14px;
            color: var(--mint);
            font-weight: 500;
        }

        /* ========== BASE STYLES (Mobile) ========== */
        .services {
            padding: 60px 20px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .section-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .section-label {
            display: inline-block;
            background: #ffe4e6; /* warna pink muda */
            color: #be185d;
            padding: 6px 16px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 12px;
        }

        .section-title {
            font-size: 1.75rem; /* 28px */
            color: #1f2937;
            margin-bottom: 12px;
            line-height: 1.3;
        }

        .section-subtitle {
            font-size: 1rem;
            color: #6b7280;
            max-width: 600px;
            margin: 0 auto;
            line-height: 1.6;
        }

        /* Grid: 1 kolom di mobile */
        .services-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 24px;
        }

        .service-card {
            background: #ffffff;
            border-radius: 16px;
            padding: 28px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            border: 1px solid #f3f4f6;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .service-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }

        .service-icon {
            width: 56px;
            height: 56px;
            margin-bottom: 16px;
        }

        .service-icon img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .service-card h3 {
            font-size: 1.25rem;
            color: #1f2937;
            margin-bottom: 10px;
        }

        .service-card > p {
            font-size: 0.95rem;
            color: #6b7280;
            line-height: 1.6;
            margin-bottom: 16px;
        }

        .service-features {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .service-features li {
            font-size: 0.9rem;
            color: #4b5563;
            padding: 6px 0;
            padding-left: 24px;
            position: relative;
        }

        /* Icon checkmark custom */
        .service-features li::before {
            content: "✓";
            position: absolute;
            left: 0;
            color: #10b981; /* hijau */
            font-weight: bold;
        }

        /* ========== TABLET (768px ke atas) ========== */
        @media (min-width: 768px) {
            .services-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .section-title {
                font-size: 2rem;
            }
        }

        /* ========== DESKTOP (1024px ke atas) ========== */
        @media (min-width: 1024px) {
            .services {
                padding: 80px 40px;
            }
            
            .services-grid {
                grid-template-columns: repeat(3, 1fr);
                gap: 32px;
            }
            
            .section-title {
                font-size: 2.25rem;
            }
            
            .service-card {
                padding: 32px;
            }
        }

        /* ===== WHY US ===== */
        .why-us {
            padding: 100px 24px;
            background: var(--cream);
        }
        .why-grid {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 80px;
            align-items: center;
        }
        .why-content .section-label { margin-bottom: 16px; }
        .why-content .section-title {
            text-align: left;
            margin-bottom: 24px;
        }
        .why-content > p {
            font-size: 17px;
            color: var(--gray);
            line-height: 1.8;
            margin-bottom: 40px;
        }
        .why-list {
            display: flex;
            flex-direction: column;
            gap: 24px;
        }
        .why-item {
            display: flex;
            gap: 20px;
            align-items: flex-start;
        }
        .why-item-icon {
            width: 52px;
            height: 52px;
            background: white;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            box-shadow: var(--shadow-sm);
            overflow: hidden;
            padding: 12px;
        }
        .why-item-icon img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }
        .why-item h4 {
            font-size: 17px;
            font-weight: 700;
            color: var(--forest);
            margin-bottom: 6px;
        }
        .why-item p {
            font-size: 15px;
            color: var(--gray);
            line-height: 1.6;
        }
        .why-visual {
            position: relative;
        }
        .why-visual-box {
            width: 100%;
            height: 500px;
            background: linear-gradient(135deg, var(--sage), var(--forest));
            border-radius: 24px;
            position: relative;
            overflow: hidden;
            box-shadow: var(--shadow-xl);
        }
        .why-visual-box::after {
            content: '';
            position: absolute;
            inset: 0;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }


        /* ===== CTA / CONTACT ===== */
        .cta {
            padding: 100px 24px;
            background: linear-gradient(135deg, var(--forest), var(--sage));
            position: relative;
            overflow: hidden;
        }
        .cta::before {
            content: '';
            position: absolute;
            top: -50%; right: -20%;
            width: 600px; height: 600px;
            background: radial-gradient(circle, rgba(255,255,255,0.05) 0%, transparent 70%);
            border-radius: 50%;
        }
        .cta-inner {
            max-width: 800px;
            margin: 0 auto;
            text-align: center;
            position: relative;
            z-index: 1;
        }
        .cta h2 {
            font-family: 'Playfair Display', serif;
            font-size: 42px;
            font-weight: 700;
            color: white;
            margin-bottom: 16px;
            letter-spacing: -0.5px;
        }
        .cta > .cta-inner > p {
            font-size: 18px;
            color: var(--mint);
            margin-bottom: 48px;
            line-height: 1.7;
        }
        .contact-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-bottom: 48px;
        }
        .contact-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.15);
            border-radius: 16px;
            padding: 28px 20px;
            transition: all 0.3s ease;
        }
        .contact-card:hover {
            background: rgba(255, 255, 255, 0.15);
            transform: translateY(-4px);
        }
        .contact-card .icon {
            width: 32px;
            height: 32px;
            margin: 0 auto 12px;
            opacity: 0.9;
        }
        .contact-card .icon img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            filter: brightness(0) invert(1);
        }
        .contact-card h4 {
            font-size: 15px;
            font-weight: 600;
            color: white;
            margin-bottom: 4px;
        }
        .contact-card a, .contact-card p {
            font-size: 14px;
            color: var(--mint);
            text-decoration: none;
            transition: color 0.2s;
        }
        .contact-card a:hover { color: white; }
        .cta-btn {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: white;
            color: var(--forest);
            padding: 18px 40px;
            border-radius: 14px;
            text-decoration: none;
            font-weight: 700;
            font-size: 16px;
            transition: all 0.3s ease;
            box-shadow: var(--shadow-lg);
        }
        .cta-btn:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow-xl);
            background: var(--cream);
        }

        /* ===== FOOTER ===== */
        .footer {
            background: var(--charcoal);
            padding: 60px 24px 30px;
        }
        .footer-inner {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr;
            gap: 60px;
            margin-bottom: 40px;
        }
        .footer-brand .brand-mark {
            margin-bottom: 16px;
        }
        .footer-brand .brand-text {
            color: white;
            display: block;
            margin-bottom: 16px;
        }
        .footer-brand p {
            font-size: 15px;
            color: #9ca3af;
            line-height: 1.7;
        }
        .footer-col h4 {
            font-size: 14px;
            font-weight: 700;
            color: white;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 20px;
        }
        .footer-col ul { list-style: none; }
        .footer-col li { margin-bottom: 12px; }
        .footer-col a {
            font-size: 15px;
            color: #9ca3af;
            text-decoration: none;
            transition: color 0.2s;
        }
        .footer-col a:hover { color: var(--mint); }
        .footer-bottom {
            max-width: 1200px;
            margin: 0 auto;
            padding-top: 30px;
            border-top: 1px solid rgba(255,255,255,0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .footer-bottom p {
            font-size: 14px;
            color: #6b7280;
        }
        .footer-social {
            display: flex;
            gap: 16px;
        }
        .footer-social a {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            transition: all 0.2s;
            overflow: hidden;
            padding: 10px;
            background: rgba(255,255,255,0.1);
        }
        .footer-social a:hover {
            background: var(--sage);
            transform: translateY(-2px);
        }
        .footer-social a img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            filter: brightness(0) invert(1);
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 1024px) {
            .hero-inner {
                grid-template-columns: 1fr;
                gap: 60px;
                text-align: center;
            }
            .hero h1 { font-size: 42px; }
            .hero-desc { margin: 0 auto 40px; }
            .hero-actions { justify-content: center; }
            .hero-visual { order: -1; }
            .hero-img-wrapper {
                width: 320px;
                margin: 0 auto;
            }
            .why-grid { grid-template-columns: 1fr; gap: 60px; }
            .why-visual-box { height: 400px; }
            .contact-grid { grid-template-columns: repeat(2, 1fr); }
            .footer-inner { grid-template-columns: 1fr 1fr; gap: 40px; }
        }
        @media (max-width: 640px) {
            .navbar-inner { height: 64px; }
            .nav-links {
                display: none;
                position: absolute;
                top: 100%; left: 0; right: 0;
                background: var(--warm-white);
                flex-direction: column;
                padding: 16px 24px;
                gap: 4px;
                box-shadow: var(--shadow-lg);
                border-top: 1px solid var(--light-gray);
            }
            .nav-links.active { display: flex; }
            .nav-links a { padding: 12px 16px; width: 100%; }
            .menu-toggle { display: block; }
            .hero { padding: 100px 20px 60px; }
            .hero h1 { font-size: 32px; }
            .hero-desc { font-size: 16px; }
            .hero-actions { flex-direction: column; width: 100%; }
            .btn-primary, .btn-ghost { width: 100%; justify-content: center; }
            .hero-img-wrapper { width: 280px; }
            .card-1 { right: -5%; top: 8%; }
            .card-2 { left: -5%; bottom: 12%; }
            .trust-inner { grid-template-columns: repeat(2, 1fr); gap: 24px; }
            .trust-item h3 { font-size: 24px; }
            .section-title { font-size: 32px; }
            .contact-grid { grid-template-columns: 1fr; }
            .footer-inner { grid-template-columns: 1fr; gap: 32px; }
            .footer-bottom { flex-direction: column; gap: 20px; text-align: center; }
        }

        /* ===== MODAL ===== */
        .modal-overlay {
            position: fixed;
            inset: 0;
            background: rgba(26, 71, 42, 0.6);
            backdrop-filter: blur(8px);
            z-index: 2000;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }

        .modal-overlay.active {
            opacity: 1;
            visibility: visible;
        }

        .modal-container {
            background: white;
            border-radius: 24px;
            width: 100%;
            max-width: 460px;
            max-height: 85vh;        /* ← Batasi tinggi modal */
            position: relative;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            transform: scale(0.95) translateY(20px);
            transition: all 0.3s ease;
            display: flex;           /* ← Flex untuk layout */
            flex-direction: column;  /* ← Column direction */
            overflow: hidden;        /* ← Sembunyikan overflow */
        }

        .modal-overlay.active .modal-container {
            transform: scale(1) translateY(0);
        }

        /* ===== SCROLL AREA ===== */
        .modal-scroll {
            overflow-y: auto;
            padding: 40px 36px;
            flex: 1;
            
            /* Sembunyiin scrollbar */
            scrollbar-width: none;
            -ms-overflow-style: none;
        }

        .modal-scroll::-webkit-scrollbar {
            width: 0;
            background: transparent;
        }

        /* Tambahin smooth scroll behavior */
        .modal-scroll {
            scroll-behavior: smooth;
            -webkit-overflow-scrolling: touch;  /* iOS smooth */
        }

        /* Close button tetap di atas */
        .modal-close {
            position: absolute;
            top: 16px;
            right: 20px;
            width: 36px;
            height: 36px;
            border: none;
            background: var(--cream);
            border-radius: 50%;
            font-size: 24px;
            color: var(--gray);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s;
            z-index: 10;             /* ← Di atas scroll area */
        }

        .modal-close:hover {
            background: var(--light-gray);
            color: var(--charcoal);
        }

        /* Brand padding diatur */
        .modal-brand {
            text-align: center;
            margin-bottom: 28px;
            flex-shrink: 0;          /* ← Jangan dikecilkan */
        }

        .modal-brand img {
            width: 52px;
            height: 52px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 12px;
            border: 2px solid rgba(74, 124, 89, 0.2);
        }

        .modal-brand h3 {
            font-family: 'Playfair Display', serif;
            font-size: 24px;
            color: var(--forest);
            margin-bottom: 4px;
        }

        .modal-brand p {
            font-size: 14px;
            color: var(--gray);
        }

        /* Form tetap sama */
        .auth-form {
            display: none;
        }

        .auth-form.active {
            display: block;
            animation: fadeIn 0.3s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Form dalam modal */
        .auth-form {
            display: none;
        }

        .auth-form.active {
            display: block;
            animation: fadeIn 0.3s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .auth-form .form-group {
            margin-bottom: 16px;
        }

        .auth-form .form-group label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: var(--charcoal);
            margin-bottom: 6px;
        }

        .auth-form .form-group input {
            width: 100%;
            padding: 12px 14px;
            border: 2px solid var(--light-gray);
            border-radius: 10px;
            font-size: 14px;
            font-family: 'Inter', sans-serif;
            transition: all 0.2s;
            background: var(--warm-white);
        }

        .auth-form .form-group input:focus {
            outline: none;
            border-color: var(--sage);
            background: white;
            box-shadow: 0 0 0 3px rgba(74, 124, 89, 0.1);
        }

        .auth-form .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
        }

        .auth-form .form-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            font-size: 13px;
        }

        .auth-form .remember {
            display: flex;
            align-items: center;
            gap: 6px;
            color: var(--gray);
            cursor: pointer;
        }

        .auth-form .remember input {
            width: 16px;
            height: 16px;
            accent-color: var(--sage);
        }

        .auth-form .forgot {
            color: var(--sage);
            text-decoration: none;
            font-weight: 500;
            font-size: 13px;
        }

        .auth-form .forgot:hover {
            color: var(--forest);
        }

        .auth-form .btn-submit {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, var(--forest), var(--sage));
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s;
        }

        .auth-form .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(26, 71, 42, 0.2);
        }

        .auth-form .switch-text {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
            color: var(--gray);
        }

        .auth-form .switch-text a {
            color: var(--sage);
            text-decoration: none;
            font-weight: 600;
        }

        .auth-form .switch-text a:hover {
            color: var(--forest);
        }

        @media (max-width: 480px) {
            .modal-container {
                padding: 32px 24px;
                border-radius: 20px;
            }
            .auth-form .form-row {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>

<div id="loader" style="
    position: fixed;
    inset: 0;
    background: var(--forest);
    z-index: 9999;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    transition: opacity 0.8s ease, visibility 0.8s ease;
    padding: 20px;
">
    <!-- Wrapper logo -->
    <div style="
        position: relative;
        width: 110px;
        height: 110px;
        display: flex;
        align-items: center;
        justify-content: center;
    ">
        <!-- SVG lingkaran tipis, gak pake border tebel -->
        <svg width="110" height="110" viewBox="0 0 110 110" style="
            position: absolute;
            top: 0;
            left: 0;
        ">
            <circle cx="55" cy="55" r="52" fill="none" stroke="rgba(255,255,255,0.3)" stroke-width="1" 
                stroke-dasharray="327" stroke-dashoffset="327" 
                style="animation: drawCircle 1.2s ease forwards;"/>
        </svg>
        
        <!-- Logo - HAPUS border, biar border native dari PNG aja -->
        <img src="{{ asset('images/logo/logo-jemari.png') }}" 
             alt="Jemari Bidan"
             style="
                 width: 88px;
                 height: 88px;
                 border-radius: 50%;
                 object-fit: cover;
                 opacity: 0;
                 animation: logoFadeIn 0.6s ease 0.8s forwards;
                 position: relative;
                 z-index: 2;
             ">
    </div>

    <!-- Tulisan -->
    <div style="
        margin-top: 24px;
        text-align: center;
        opacity: 0;
        animation: textSlideUp 0.6s ease 1.2s forwards;
    ">
        <span style="
            display: block;
            font-family: 'Playfair Display', serif;
            font-size: 22px;
            font-weight: 700;
            color: white;
            letter-spacing: -0.5px;
            line-height: 1.2;
        ">Jemari Bidan</span>
        <span style="
            display: block;
            font-family: 'Inter', sans-serif;
            font-size: 12px;
            font-weight: 400;
            color: rgba(255,255,255,0.75);
            margin-top: 6px;
            letter-spacing: 0.5px;
            line-height: 1.4;
        ">Treatment Ibu & Anak Surabaya</span>
    </div>
</div>

<style>
@keyframes drawCircle {
    to { stroke-dashoffset: 0; }
}
@keyframes logoFadeIn {
    to { opacity: 1; }
}
@keyframes textSlideUp {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}
#loader.hidden {
    opacity: 0;
    visibility: hidden;
}

/* ===== RESPONSIVE ===== */
@media (max-width: 640px) {
    #loader > div:first-child {
        width: 100px;
        height: 100px;
    }
    #loader > div:first-child svg {
        width: 100px;
        height: 100px;
    }
    #loader > div:first-child img {
        width: 80px;
        height: 80px;
    }
    #loader > div:last-child span:first-child {
        font-size: 20px;
    }
    #loader > div:last-child span:last-child {
        font-size: 11px;
    }
}
</style>

<script>
window.addEventListener('load', () => {
    setTimeout(() => {
        document.getElementById('loader').classList.add('hidden');
    }, 2600);
});
</script>

    <!-- Navbar -->
    <nav class="navbar" id="navbar">
        <div class="navbar-inner">
            <a href="/" class="brand">
                <img src="{{ url('images/logo/logo-jemari.png') }}" alt="Jemari Bidan" class="brand-mark">
                <span class="brand-text">Jemari Bidan</span>
            </a>
            <ul class="nav-links" id="navLinks">
                <li><a href="#beranda">Beranda</a></li>
                <li><a href="#layanan">Layanan</a></li>
                <li><a href="#tentang">Tentang Kami</a></li>
                <li><a href="#kontak">Kontak</a></li>
                <li><a href="#" class="nav-cta" onclick="openModal('login'); return false;">Masuk</a></li>
            </ul>
            <button class="menu-toggle" onclick="toggleMenu()" aria-label="Toggle menu">☰</button>
        </div>
    </nav>

    <!-- Hero -->
    <section class="hero" id="beranda">
        <div class="hero-inner">
            <div class="hero-content">
                <div class="hero-badge">Homecare Services</div>
                <h1>Perawatan <span class="accent">Ibu & Anak</span> Terbaik di Surabaya</h1>
                <p class="hero-desc">
                    Layanan treatment profesional untuk ibu dan bayi Anda. Didampingi oleh bidan berpengalaman dengan pendekatan penuh kasih sayang, langsung di kenyamanan rumah Anda.
                </p>
                <div class="hero-actions">
                    <a href="#kontak" class="btn-primary">Hubungi Kami</a>
                    <a href="#" class="btn-ghost" onclick="openModal('login'); return false;">Lihat Katalog Layanan</a>
                </div>
            </div>
            <div class="hero-visual">
                <div class="hero-img-wrapper">
                    <img src="{{ url('images/hero/treatment.png') }}" alt="Treatment Ibu dan Anak">
                </div>
                <div class="hero-visual-card card-1">
                    <div class="card-icon">
                        <img src="{{ url('images/hero/baby.png') }}" alt="Baby Treatment">
                    </div>
                    <div class="card-info">
                        <h4>Baby Treatment</h4>
                        <p>Perawatan bayi profesional</p>
                    </div>
                </div>
                <div class="hero-visual-card card-2">
                    <div class="card-icon">
                        <img src="{{ url('images/hero/mom.png') }}" alt="Mom Treatment">
                    </div>
                    <div class="card-info">
                        <h4>Mom Treatment</h4>
                        <p>Perawatan pasca melahirkan</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Trust Bar -->
    <section class="trust-bar">
        <div class="trust-inner">
            <div class="trust-item">
                <h3>500+</h3>
                <p>Ibu & Bayi Terlayani</p>
            </div>
            <div class="trust-item">
                <h3>5+</h3>
                <p>Tahun Pengalaman</p>
            </div>
            <div class="trust-item">
                <h3>98%</h3>
                <p>Tingkat Kepuasan</p>
            </div>
            <div class="trust-item">
                <h3>24/7</h3>
                <p>Layanan Homecare</p>
            </div>
        </div>
    </section>

    <!-- Services -->
    <section class="services" id="layanan">
        <div class="section-header">
            <span class="section-label">Layanan Kami</span>
            <h2 class="section-title">Treatment Profesional untuk Keluarga Anda</h2>
            <p class="section-subtitle">
                Setiap treatment dirancang khusus untuk memastikan kesejahteraan ibu dan tumbuh kembang bayi yang optimal.
            </p>
        </div>
        <div class="services-grid">
            <div class="service-card">
                <div class="service-icon">
                    <img src="{{ asset('images/layanan/icon-mom.svg') }}" alt="Mom Treatment">
                </div>
                <h3>Mom Treatment</h3>
                <p>Perawatan komprehensif untuk ibu pasca melahirkan termasuk massage, laktasi counseling, dan pemulihan fisik.</p>
                <ul class="service-features">
                    <li>Postnatal massage</li>
                    <li>Konseling laktasi</li>
                    <li>Pemulihan perineum</li>
                    <li>Monitoring kesehatan ibu</li>
                </ul>
            </div>
            <div class="service-card">
                <div class="service-icon">
                    <img src="{{ asset('images/layanan/icon-baby.svg') }}" alt="Baby Treatment">
                </div>
                <h3>Baby Treatment</h3>
                <p>Perawatan bayi holistik dari newborn care, baby massage, hingga monitoring tumbuh kembang oleh bidan bersertifikat.</p>
                <ul class="service-features">
                    <li>Newborn care & umbilical care</li>
                    <li>Baby massage & tummy time</li>
                    <li>Monitoring tumbuh kembang</li>
                    <li>Imunisasi tracking</li>
                </ul>
            </div>
            <div class="service-card">
                <div class="service-icon">
                    <img src="{{ asset('images/layanan/icon-homecare.svg') }}" alt="Homecare">
                </div>
                <h3>Homecare Services</h3>
                <p>Layanan datang ke rumah dengan jadwal fleksibel. Area layanan: Surabaya Timur dan sekitarnya.</p>
                <ul class="service-features">
                    <li>Jadwal fleksibel</li>
                    <li>Alat steril medis</li>
                    <li>Protokol hygiene ketat</li>
                    <li>Report per session</li>
                </ul>
            </div>
        </div>
    </section>

    <!-- Why Us -->
    <section class="why-us" id="tentang">
        <div class="why-grid">
            <div class="why-content">
                <span class="section-label">Mengapa Kami</span>
                <h2 class="section-title">Kepercayaan Ribuan Keluarga di Surabaya</h2>
                <p>
                    Jemari Bidan hadir dengan komitmen memberikan layanan kesehatan ibu dan anak berkualitas tinggi dengan pendekatan personal dan profesional.
                </p>
                <div class="why-list">
                    <div class="why-item">
                        <div class="why-item-icon">
                            <img src="{{ asset('images/why-us/icon-sertifikat.svg') }}" alt="Bidan Bersertifikat">
                        </div>
                        <div>
                            <h4>Bidan Bersertifikat</h4>
                            <p>Tim bidan berpengalaman dengan sertifikasi resmi dan training berkala.</p>
                        </div>
                    </div>
                    <div class="why-item">
                        <div class="why-item-icon">
                            <img src="{{ asset('images/why-us/icon-hygiene.svg') }}" alt="Protokol Keamanan">
                        </div>
                        <div>
                            <h4>Protokol Keamanan</h4>
                            <p>Standard hygiene hospital-grade untuk setiap kunjungan homecare.</p>
                        </div>
                    </div>
                    <div class="why-item">
                        <div class="why-item-icon">
                            <img src="{{ asset('images/why-us/icon-holistic.svg') }}" alt="Pendekatan Holistik">
                        </div>
                        <div>
                            <h4>Pendekatan Holistik</h4>
                            <p>Tidak hanya treatment fisik, tapi juga edukasi dan dukungan emosional.</p>
                        </div>
                    </div>
                    <div class="why-item">
                        <div class="why-item-icon">
                            <img src="{{ asset('images/why-us/icon-digital.svg') }}" alt="Layanan Digital">
                        </div>
                        <div>
                            <h4>Layanan Digital</h4>
                            <p>Booking online, reminder jadwal, dan laporan perkembangan via aplikasi.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="why-visual">
                <div class="why-visual-box">
                    <img src="{{ asset('images/why-us/tim-bidan.jpg') }}" 
                        alt="Tim Bidan Jemari Bidan"
                        style="width:100%; height:100%; object-fit:cover; border-radius:24px;">
                </div>
            </div>
        </div>
    </section>

    <!-- CTA / Contact -->
    <section class="cta" id="kontak">
        <div class="cta-inner">
            <h2>Siap Memberikan yang Terbaik untuk Keluarga Anda</h2>
            <p>Konsultasi gratis untuk treatment ibu dan anak. Hubungi kami sekarang dan rasakan perbedaannya.</p>
            <div class="contact-grid">
                <div class="contact-card">
                    <div class="icon">
                        <img src="{{ asset('images/footer/icon-location.svg') }}" alt="Lokasi">
                    </div>
                    <h4>Lokasi</h4>
                    <p>Surabaya Timur, Jawa Timur</p>
                </div>
                <div class="contact-card">
                    <div class="icon">
                        <img src="{{ asset('images/footer/icon-whatsapp.svg') }}" alt="WhatsApp">
                    </div>
                    <h4>WhatsApp</h4>
                    <a href="https://wa.me/6282231267718">+62 822-3126-7718</a>
                </div>
                <div class="contact-card">
                    <div class="icon">
                        <img src="{{ asset('images/footer/icon-email.svg') }}" alt="Email">
                    </div>
                    <h4>Email</h4>
                    <a href="mailto:jemari.bidan@gmail.com">jemari.bidan@gmail.com</a>
                </div>
                <div class="contact-card">
                    <div class="icon">
                        <img src="{{ asset('images/footer/icon-instagram.svg') }}" alt="Instagram">
                    </div>
                    <h4>Instagram</h4>
                    <a href="https://instagram.com/jemari.bidan">@jemari.bidan</a>
                </div>
            </div>
            <a href="https://wa.me/6282231267718" class="cta-btn" target="_blank">
                Konsultasi Gratis via WhatsApp
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
            </a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-inner">
            <div class="footer-brand">
                <img src="{{ asset('images/logo/logo-jemari.png') }}" alt="Jemari Bidan" class="brand-mark">
                <span class="brand-text">Jemari Bidan</span>
                <p>Layanan treatment profesional ibu dan anak dengan pendekatan homecare di Surabaya. Kepercayaan ribuan keluarga sejak 2019.</p>
            </div>
            <div class="footer-col">
                <h4>Layanan</h4>
                <ul>
                <li><a href="#" onclick="openModal('login'); return false;">Mom Treatment</a></li>
                <li><a href="#" onclick="openModal('login'); return false;">Baby Treatment</a></li>
                <li><a href="#" onclick="openModal('login'); return false;">Homecare</a></li>
                <li><a href="#" onclick="openModal('login'); return false;">Konsultasi</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>Perusahaan</h4>
                <ul>
                    <li><a href="#">Tentang Kami</a></li>
                    <li><a href="#">Tim Bidan</a></li>
                    <li><a href="#">Karir</a></li>
                    <li><a href="#">Blog</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>Bantuan</h4>
                <ul>
                    <li><a href="#">FAQ</a></li>
                    <li><a href="#">Cara Booking</a></li>
                    <li><a href="#">Kebijakan Privasi</a></li>
                    <li><a href="#">Syarat & Ketentuan</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <p>© 2024 Jemari Bidan. Treatment Ibu & Anak Surabaya.</p>
            <div class="footer-social">
                <a href="#">
                    <img src="{{ asset('images/footer/social-facebook.svg') }}" alt="Facebook">
                </a>
                <a href="https://instagram.com/jemari.bidan">
                    <img src="{{ asset('images/footer/social-instagram.svg') }}" alt="Instagram">
                </a>
                <a href="#">
                    <img src="{{ asset('images/footer/social-youtube.svg') }}" alt="YouTube">
                </a>
            </div>
        </div>
    </footer>
    <div class="modal-overlay" id="modalOverlay" onclick="closeModal(event)">
        <div class="modal-container" onclick="event.stopPropagation()">
            <button class="modal-close" onclick="closeModal()">&times;</button>
            
            <!-- Wrapper yang bisa scroll -->
            <div class="modal-scroll">
                <div class="modal-brand">
                    <img src="{{ asset('images/logo/logo-jemari.png') }}" alt="Jemari Bidan">
                    <h3 id="modalTitle">Selamat Datang Kembali</h3>
                    <p id="modalSubtitle">Masuk untuk melihat katalog treatment kami</p>
                </div>
            <!-- LOGIN FORM -->
            <form id="loginForm" method="POST" action="{{ route('login') }}" class="auth-form active">
                @csrf
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" placeholder="nama@email.com" required>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" placeholder="••••••••" required>
                </div>
                <div class="form-options">
                    <label class="remember">
                        <input type="checkbox" name="remember">
                        <span>Ingat saya</span>
                    </label>
                    <a href="#" class="forgot">Lupa password?</a>
                </div>
                <button type="submit" class="btn-submit">Masuk</button>
                <p class="switch-text">Belum punya akun? <a href="#" onclick="switchForm('register')">Daftar</a></p>
            </form>

            <!-- REGISTER FORM -->
            <form id="registerForm" method="POST" action="{{ route('register') }}" class="auth-form">
                @csrf
                <div class="form-row">
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" name="nama" placeholder="Nama lengkap" required>
                    </div>
                    <div class="form-group">
                        <label>No. WhatsApp</label>
                        <input type="tel" name="no_hp" placeholder="0812-3456-7890">
                    </div>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" placeholder="nama@email.com" required>
                </div>
                <div class="form-group">
                    <label>Alamat</label>
                    <input type="text" name="alamat" placeholder="Alamat untuk homecare">
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" placeholder="Min. 8 karakter" required>
                    </div>
                    <div class="form-group">
                        <label>Konfirmasi</label>
                        <input type="password" name="password_confirmation" placeholder="Ulangi password" required>
                    </div>
                </div>
                <button type="submit" class="btn-submit">Daftar Sekarang</button>
                <p class="switch-text">Sudah punya akun? <a href="#" onclick="switchForm('login')">Masuk</a></p>
            </form>
        </div>
    </div>

    <script>
        window.addEventListener('scroll', () => {
            const navbar = document.getElementById('navbar');
            if (window.scrollY > 50) navbar.classList.add('scrolled');
            else navbar.classList.remove('scrolled');
        });

        function toggleMenu() {
            document.getElementById('navLinks').classList.toggle('active');
        }

        document.querySelectorAll('.nav-links a').forEach(link => {
            link.addEventListener('click', () => {
                document.getElementById('navLinks').classList.remove('active');
            });
        });
            // Navbar scroll
        window.addEventListener('scroll', () => {
            const navbar = document.getElementById('navbar');
            if (window.scrollY > 50) navbar.classList.add('scrolled');
            else navbar.classList.remove('scrolled');
        });

        // Mobile menu
        function toggleMenu() {
            document.getElementById('navLinks').classList.toggle('active');
        }
        document.querySelectorAll('.nav-links a').forEach(link => {
            link.addEventListener('click', () => {
                document.getElementById('navLinks').classList.remove('active');
            });
        });

        // ===== MODAL FUNCTIONS =====
        const modal = document.getElementById('modalOverlay');
        const loginForm = document.getElementById('loginForm');
        const registerForm = document.getElementById('registerForm');
        const modalTitle = document.getElementById('modalTitle');
        const modalSubtitle = document.getElementById('modalSubtitle');

        function openModal(form = 'login') {
            modal.classList.add('active');
            document.body.style.overflow = 'hidden'; // Lock scroll
            switchForm(form);
        }

        function closeModal(e) {
            if (e && e.target !== modal && !e.target.classList.contains('modal-close')) return;
            modal.classList.remove('active');
            document.body.style.overflow = '';
        }

        function switchForm(type) {
            if (type === 'login') {
                loginForm.classList.add('active');
                registerForm.classList.remove('active');
                modalTitle.textContent = 'Selamat Datang Kembali';
                modalSubtitle.textContent = 'Masuk untuk melihat katalog treatment kami';
            } else {
                loginForm.classList.remove('active');
                registerForm.classList.add('active');
                modalTitle.textContent = 'Buat Akun Baru';
                modalSubtitle.textContent = 'Bergabung untuk akses katalog treatment eksklusif';
            }
        }

        // Escape key to close
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') closeModal();
        });

        @if(session('open_modal'))
            document.addEventListener('DOMContentLoaded', function() {
                openModal('{{ session('open_modal') }}');
            });
        @endif

        // Show login error
        @if(session('login_error'))
            document.addEventListener('DOMContentLoaded', function() {
                openModal('login');
            });
        @endif
    </script>

</body>
</html>