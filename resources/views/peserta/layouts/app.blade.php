<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>STARNAS ASASI 2026 & ICoABCD 2026 - Seminar Teknologi dan Sains Nasional</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        emerald: {
                            50: '#ecfdf5',
                            100: '#d1fae5',
                            200: '#a7f3d0',
                            300: '#6ee7b7',
                            400: '#34d399',
                            500: '#10b981',
                            600: '#059669',
                            700: '#047857',
                            800: '#065f46',
                            900: '#064e3b',
                            950: '#022c22',
                        }
                    }
                }
            }
        }
    </script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <style>
        :root {
            --primary: #059669;    /* Vibrant Emerald */
            --primary-glow: #10b981;
            --secondary: #6366f1;  /* Cyber Indigo */
            --accent: #f59e0b;     /* Solar Gold */
            --dark: #050b14;       /* Obsidian Night */
        }

        body {
            font-family: 'Poppins', sans-serif;
            overflow-x: hidden;
            background: #f6faf8;
        }

        .gradient-bg {
            background: linear-gradient(135deg, #050b14 0%, #061c1a 35%, #063c30 70%, #091a2d 100%);
        }

        .glass-effect {
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
            border: 1px solid rgba(16, 185, 129, 0.25);
        }

        .floating {
            animation: floating 6s ease-in-out infinite;
        }

        @keyframes floating {
            0% {
                transform: translate(0, 0px);
            }

            50% {
                transform: translate(0, -15px);
            }

            100% {
                transform: translate(0, 0px);
            }
        }

        .section-title {
            position: relative;
            display: inline-block;
            margin-bottom: 2rem;
        }

        .section-title:after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(to right, #10b981, #6366f1, #f59e0b);
            border-radius: 2px;
        }

        .speaker-card {
            transition: all 0.4s ease;
            background: linear-gradient(145deg, #ffffff, #f0f4f8);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.08);
            border-radius: 20px;
            overflow: hidden;
            position: relative;
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .speaker-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
        }

        .speaker-badge {
            position: absolute;
            top: 20px;
            right: 20px;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 700;
            z-index: 10;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }

        .badge-keynote {
            background: linear-gradient(135deg, #f59e0b, #fbbf24);
            color: white;
        }

        .badge-invited {
            background: linear-gradient(135deg, #06b6d4, #22d3ee);
            color: white;
        }

        .badge-welcoming {
            background: linear-gradient(135deg, #10b981, #34d399);
            color: white;
        }

        .hover-lift {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .hover-lift:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.12);
        }

        .text-gradient {
            background: linear-gradient(135deg, #34d399 0%, #22d3ee 50%, #fbbf24 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        /* PERBAIKAN NAVBAR: Responsif Mobile */
        .nav-link {
            position: relative;
            font-weight: 500;
            text-transform: uppercase;
            font-size: 0.8rem;
            letter-spacing: 0.5px;
        }

        .nav-link:after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -6px;
            left: 0;
            background: linear-gradient(to right, #10b981, #6366f1);
            transition: width 0.4s ease;
            border-radius: 2px;
        }

        .nav-link:hover:after {
            width: 100%;
        }

        .btn-primary {
            background: linear-gradient(135deg, #10b981, #059669);
            color: #ffffff;
            font-weight: 700;
            transition: all 0.3s ease;
            font-size: 0.8rem;
            padding: 0.5rem 1rem;
            box-shadow: 0 4px 15px rgba(16, 185, 129, 0.4);
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(16, 185, 129, 0.55);
            background: linear-gradient(135deg, #34d399, #059669);
            color: #ffffff;
        }

        .btn-secondary {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            border: 2px solid rgba(16, 185, 129, 0.6);
            color: #ffffff;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-secondary:hover {
            background: rgba(16, 185, 129, 0.15);
            border-color: #34d399;
            color: #34d399;
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(16, 185, 129, 0.3);
        }

        .logo-container {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .logo-image {
            width: 45px;
            height: 45px;
            object-fit: contain;
        }

        @media (min-width: 768px) {
            .logo-image {
                width: 50px;
                height: 50px;
            }
        }

        /* Removed Logo Text Styles as requested */

        .hero-particles {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: 1;
        }

        .particle {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.3);
            animation: float-particle 15s infinite linear;
        }

        @keyframes float-particle {
            0% {
                transform: translateY(0) translateX(0);
                opacity: 0;
            }

            10% {
                opacity: 1;
            }

            90% {
                opacity: 1;
            }

            100% {
                transform: translateY(-1000%) translateX(100%);
                opacity: 0;
            }
        }

        /* Mobile Menu Styles - DIPERBAIKI */
        .mobile-menu {
            position: fixed;
            top: 0;
            right: -100%;
            width: 320px;
            height: 100vh;
            background: white;
            box-shadow: -5px 0 15px rgba(0, 0, 0, 0.1);
            transition: right 0.3s ease-in-out;
            z-index: 1001;
        }

        .mobile-menu.active {
            right: 0;
        }

        .mobile-menu-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease-in-out;
            z-index: 1000;
        }

        .mobile-menu-overlay.active {
            opacity: 1;
            visibility: visible;
        }

        /* Dropdown Animation - DIPERBAIKI */
        .mobile-dropdown-content {
            max-height: 0;
            opacity: 0;
            overflow: hidden;
            transition: all 0.3s ease-in-out;
        }

        /* PERBAIKAN: Menghapus max-height: 200px agar ditangani JS */
        .mobile-dropdown-content.active {
            opacity: 1;
        }

        .dropdown-arrow {
            transition: transform 0.3s ease;
        }

        .mobile-dropdown.active .dropdown-arrow {
            transform: rotate(180deg);
        }

        /* Smooth transitions for all interactive elements */
        .mobile-nav-link {
            transition: all 0.2s ease-in-out;
        }

        .mobile-nav-link:active {
            transform: scale(0.98);
        }

        /* Custom scrollbar for mobile menu */
        .mobile-menu::-webkit-scrollbar {
            width: 4px;
        }

        .mobile-menu::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        .mobile-menu::-webkit-scrollbar-thumb {
            background: #c1c1c1;
            border-radius: 10px;
        }

        .mobile-menu::-webkit-scrollbar-thumb:hover {
            background: #a8a8a8;
        }

        /* PERBAIKAN: Padding untuk konten agar tidak tertutup navbar */
        .content-padding {
            padding-top: 5rem;
        }

        .benefit-icon {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            font-size: 1.5rem;
        }

        .speaker-portrait {
            height: 280px;
            overflow: hidden;
            position: relative;
            flex-shrink: 0;
        }

        .speaker-portrait img {
            transition: transform 0.5s ease;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .speaker-card:hover .speaker-portrait img {
            transform: scale(1.05);
        }

        .price-card {
            min-height: 280px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .speaker-role {
            color: #6b7280;
            font-size: 0.9rem;
            font-weight: 500;
            margin-bottom: 0.5rem;
            line-height: 1.4;
        }

        .speaker-organization {
            color: #3b82f6;
            font-weight: 600;
            font-size: 1rem;
            line-height: 1.4;
        }

        .speaker-bio {
            display: none;
        }

        .speaker-name {
            font-size: 1.25rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            color: #1f2937;
            line-height: 1.3;
        }

        /* PERBAIKAN SLIDER: Ukuran lebih kecil dan responsif */
        .hero-slider {
            position: relative;
            width: 100%;
            height: 250px;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            aspect-ratio: 16/9;
        }

        @media (min-width: 768px) {
            .hero-slider {
                height: 320px;
            }
        }

        @media (min-width: 1024px) {
            .hero-slider {
                height: 380px;
                max-width: 90%;
                margin: 0 auto;
            }
        }

        @media (min-width: 1280px) {
            .hero-slider {
                height: 350px;
                max-width: 85%;
            }
        }

        .slide {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            transition: opacity 0.8s ease-in-out;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        .slide.active {
            opacity: 1;
        }

        .slider-nav {
            position: absolute;
            bottom: 15px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: 8px;
            z-index: 10;
        }

        .slider-dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.5);
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .slider-dot.active {
            background: white;
            transform: scale(1.1);
        }

        .slider-arrow {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(255, 255, 255, 0.2);
            border: none;
            color: white;
            width: 35px;
            height: 35px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            z-index: 10;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
            font-size: 0.9rem;
        }

        .slider-arrow:hover {
            background: rgba(255, 255, 255, 0.3);
        }

        .slider-arrow.prev {
            left: 15px;
        }

        .slider-arrow.next {
            right: 15px;
        }

        /* PERBAIKAN: Menghilangkan teks pada slider */
        .hero-slider .slide .absolute.bottom-0 {
            display: none !important;
        }

        /* Co-host Section Styles */
        .cohost-logo {
            width: 120px;
            height: 120px;
            object-fit: contain;
            transition: all 0.3s ease;
        }

        @media (min-width: 768px) {
            .cohost-logo {
                width: 150px;
                height: 150px;
            }
        }

        .cohost-card {
            transition: all 0.3s ease;
        }

        .cohost-card:hover {
            transform: translateY(-5px);
        }

        .cohost-card:hover .cohost-logo {
            transform: scale(1.1);
        }

        /* Efek tambahan untuk hero section */
        .hero-glow {
            box-shadow: 0 0 50px rgba(16, 185, 129, 0.4);
        }

        .countdown-item {
            background: rgba(255, 255, 255, 0.07);
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
            border: 1px solid rgba(16, 185, 129, 0.3);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.25);
            transition: all 0.3s ease;
        }

        .countdown-item:hover {
            transform: translateY(-4px);
            border-color: rgba(52, 211, 153, 0.6);
            box-shadow: 0 15px 35px rgba(16, 185, 129, 0.25);
        }

        /* Animasi untuk badge trending */
        @keyframes bounce {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        .animate-bounce {
            animation: bounce 2s infinite;
        }

        /* Gradient text yang lebih menarik */
        .text-gradient {
            background: linear-gradient(135deg, #f59e0b, #fbbf24, #06b6d4);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-size: 200% 200%;
            animation: gradient-shift 3s ease infinite;
        }

        @keyframes gradient-shift {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }

        /* PERBAIKAN RESPONSIVITAS TIMELINE UNTUK HP */
        @media (max-width: 768px) {
            #timeline .container {
                padding-left: 1rem;
                padding-right: 1rem;
            }

            #timeline .text-center h2 {
                font-size: 1.75rem !important;
                margin-bottom: 1rem !important;
            }

            #timeline .text-center p {
                font-size: 0.9rem !important;
                padding: 0 0.5rem;
            }

            /* Timeline utama - layout vertikal */
            #timeline .bg-gradient-to-r {
                border-radius: 1rem !important;
            }

            #timeline .bg-white\/10.backdrop-blur-sm.p-8 {
                padding: 1.5rem !important;
            }

            #timeline .bg-white\/10.backdrop-blur-sm.p-8 h3 {
                font-size: 1.25rem !important;
            }

            #timeline .bg-white\/10.backdrop-blur-sm.p-8 p {
                font-size: 0.9rem !important;
            }

            /* Timeline items - layout mobile */
            #timeline .space-y-6 .flex.items-center {
                flex-direction: column !important;
                text-align: center !important;
                padding: 1.25rem !important;
            }

            #timeline .space-y-6 .flex.items-center .flex-shrink-0 {
                width: 100% !important;
                margin-bottom: 1rem;
            }

            #timeline .space-y-6 .flex.items-center .flex-1 {
                margin-left: 0 !important;
                padding-left: 0 !important;
                border-left: none !important;
                border-top: 2px solid rgba(255, 255, 255, 0.3);
                padding-top: 1rem;
                width: 100%;
            }

            #timeline .space-y-6 .flex.items-center .flex-shrink-0.ml-4 {
                position: absolute;
                top: 1rem;
                right: 1rem;
                margin-left: 0 !important;
            }

            /* Timeline footer */
            #timeline .bg-white\/5.backdrop-blur-sm.p-6 {
                padding: 1rem !important;
            }

            #timeline .bg-white\/5.backdrop-blur-sm.p-6 .flex {
                flex-wrap: wrap;
                gap: 0.75rem;
                justify-content: center;
            }

            #timeline .bg-white\/5.backdrop-blur-sm.p-6 .flex>div {
                flex: 0 0 auto;
            }

            /* Additional info cards */
            #timeline .grid.grid-cols-1.md\:grid-cols-3.gap-6 {
                gap: 1rem !important;
            }

            #timeline .grid.grid-cols-1.md\:grid-cols-3.gap-6 .bg-white {
                padding: 1.25rem !important;
            }

            #timeline .grid.grid-cols-1.md\:grid-cols-3.gap-6 .bg-white h4 {
                font-size: 1rem !important;
            }

            #timeline .grid.grid-cols-1.md\:grid-cols-3.gap-6 .bg-white p {
                font-size: 0.8rem !important;
            }
        }

        /* Untuk layar sangat kecil (mobile portrait) */
        @media (max-width: 480px) {
            #timeline .space-y-6 .flex.items-center {
                padding: 1rem !important;
            }

            #timeline .space-y-6 .flex.items-center .flex-shrink-0 .text-2xl {
                font-size: 1.5rem !important;
            }

            #timeline .space-y-6 .flex.items-center .flex-shrink-0 .text-lg {
                font-size: 1rem !important;
            }

            #timeline .space-y-6 .flex.items-center .flex-1 h4 {
                font-size: 1.1rem !important;
            }

            #timeline .space-y-6 .flex.items-center .flex-1 p {
                font-size: 0.85rem !important;
            }

            /* Timeline footer legend lebih kecil */
            #timeline .bg-white\/5.backdrop-blur-sm.p-6 .flex>div {
                font-size: 0.75rem;
            }

            #timeline .bg-white\/5.backdrop-blur-sm.p-6 .flex>div .w-3 {
                width: 0.5rem;
                height: 0.5rem;
            }
        }

        /* Untuk landscape mode di mobile */
        @media (max-width: 768px) and (orientation: landscape) {
            #timeline .space-y-6 .flex.items-center {
                flex-direction: row !important;
                text-align: left !important;
                padding: 1rem !important;
            }

            #timeline .space-y-6 .flex.items-center .flex-shrink-0 {
                width: 25% !important;
                margin-bottom: 0;
            }

            #timeline .space-y-6 .flex.items-center .flex-1 {
                margin-left: 1rem !important;
                padding-left: 1rem !important;
                border-left: 2px solid rgba(255, 255, 255, 0.3) !important;
                border-top: none !important;
                padding-top: 0;
                width: auto;
            }

            #timeline .space-y-6 .flex.items-center .flex-shrink-0.ml-4 {
                position: static;
                margin-left: 1rem !important;
            }
        }

        /* PERBAIKAN: Pastikan gambar slider tidak terlalu besar di mobile */
        @media (max-width: 768px) {
            .hero-slider {
                height: 200px !important;
                min-height: 200px;
                border-radius: 12px;
            }

            .slide {
                background-size: cover !important;
                background-position: center !important;
            }

            .slider-arrow {
                width: 30px;
                height: 30px;
                font-size: 0.8rem;
            }

            .slider-arrow.prev {
                left: 10px;
            }

            .slider-arrow.next {
                right: 10px;
            }

            .slider-nav {
                bottom: 10px;
            }

            .content-padding {
                padding-top: 5rem;
            }

            .container {
                max-width: 100%;
                padding-left: 1rem;
                padding-right: 1rem;
                overflow-x: hidden;
            }

            h1 {
                font-size: 2rem !important;
                line-height: 1.2 !important;
            }

            h2 {
                font-size: 1.5rem !important;
                line-height: 1.3 !important;
            }

            h3 {
                font-size: 1.25rem !important;
            }

            .btn-primary,
            .btn-secondary {
                padding: 0.75rem 1.5rem;
                font-size: 0.9rem;
                width: 100%;
                text-align: center;
            }

            .grid-cols-1 {
                grid-template-columns: 1fr;
            }

            .grid-cols-2 {
                grid-template-columns: 1fr;
            }

            .countdown-item {
                padding: 0.75rem;
                min-width: 60px;
            }

            img {
                max-width: 100%;
                height: auto;
            }
        }

        /* PERBAIKAN: Untuk landscape di mobile */
        @media (max-width: 768px) and (orientation: landscape) {
            .hero-slider {
                height: 180px !important;
            }

            .content-padding {
                padding-top: 4rem;
            }

            .hero-section {
                min-height: auto;
                padding-top: 3rem;
                padding-bottom: 3rem;
            }

            .grid-cols-1-md-landscape {
                grid-template-columns: 1fr 1fr;
            }

            .flex-col-landscape {
                flex-direction: row;
            }

            .text-center-landscape {
                text-align: left;
            }

            .countdown-container {
                flex-wrap: wrap;
                justify-content: center;
            }

            .countdown-item {
                min-width: 70px;
                margin: 0.25rem;
            }
        }

        @media (max-width: 480px) {
            .content-padding {
                padding-top: 4.5rem;
            }

            h1 {
                font-size: 1.75rem !important;
            }

            h2 {
                font-size: 1.35rem !important;
            }

            .container {
                padding-left: 0.75rem;
                padding-right: 0.75rem;
            }

            .btn-primary,
            .btn-secondary {
                padding: 0.875rem 1.25rem;
                font-size: 0.875rem;
            }
        }

        /* Mobile Dropdown Styles - DIPERBAIKI */
        .mobile-dropdown-toggle {
            transition: all 0.3s ease;
        }

        .mobile-dropdown-toggle.active {
            background-color: #ecfdf5;
            color: #059669;
        }

        .mobile-dropdown-toggle.active i {
            transform: rotate(180deg);
        }

        .mobile-dropdown-content {
            transition: all 0.3s ease;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* FIX: Prevent horizontal scroll */
        html,
        body {
            max-width: 100%;
            overflow-x: hidden;
        }

        * {
            box-sizing: border-box;
        }

        /* NEW: Rundown Section Styles */
        .timeline-item {
            transition: all 0.3s ease;
            border-left: 3px solid transparent;
        }

        .timeline-item:hover {
            border-left-color: #10b981;
            background: rgba(16, 185, 129, 0.05);
        }

        .session-badge {
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.7rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .badge-keynote-session {
            background: linear-gradient(135deg, #f59e0b, #fbbf24);
            color: white;
        }

        .badge-invited-session {
            background: linear-gradient(135deg, #06b6d4, #22d3ee);
            color: white;
        }

        .badge-parallel-session {
            background: linear-gradient(135deg, #0d9488, #14b8a6);
            color: white;
        }

        .badge-workshop-session {
            background: linear-gradient(135deg, #10b981, #34d399);
            color: white;
        }

        .badge-special-session {
            background: linear-gradient(135deg, #d97706, #f59e0b);
            color: white;
        }

        .badge-welcoming-session {
            background: linear-gradient(135deg, #059669, #10b981);
            color: white;
        }

        .day-indicator {
            position: relative;
            display: inline-block;
            padding: 8px 20px;
            border-radius: 25px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 2rem;
        }

        .day-1 {
            background: linear-gradient(135deg, #059669, #10b981);
            color: white;
        }

        .day-2 {
            background: linear-gradient(135deg, #f59e0b, #d97706);
            color: white;
        }

        /* Animasi untuk timeline */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .timeline-animate {
            animation: fadeInUp 0.6s ease-out;
        }

        /* Responsive adjustments for rundown section */
        @media (max-width: 768px) {
            .session-time {
                min-width: 100px !important;
            }
            
            .timeline-item {
                padding: 1rem !important;
            }
            
            .session-badge {
                font-size: 0.65rem;
                padding: 3px 10px;
            }
        }
    </style>
</head>

<body class="bg-gray-50">

    <header class="fixed w-full z-50 bg-white/95 backdrop-blur-md shadow-sm border-b border-gray-100">
        <div class="container mx-auto px-4 py-3">
            <div class="flex justify-between items-center">
                <div class="logo-container">
                    <img src="/storage/starnas.png" alt="Logo STARNAS" class="logo-image rounded-lg">
                    <img src="/storage/logo-asasi.png" alt="Logo Partner" class="logo-image rounded-lg">
                    <img src="/storage/pnm.png" alt="Logo PNM" class="logo-image rounded-lg">
                </div>

                <nav class="hidden lg:flex space-x-2 xl:space-x-3 text-xs xl:text-sm font-medium items-center">

                    <a href="{{ route('home') }}"
                        class="nav-link text-gray-700 hover:text-emerald-600 transition-colors duration-300 whitespace-nowrap">BERANDA</a>

                    <a href="{{ route('home') }}#tentang"
                        class="nav-link text-gray-700 hover:text-emerald-600 transition-colors duration-300 whitespace-nowrap">TENTANG</a>

                    <div class="relative group" id="rundown-dropdown">
                        <button
                            class="nav-link text-gray-700 hover:text-emerald-600 transition-colors duration-300 flex items-center focus:outline-none whitespace-nowrap">
                            RUNDOWN
                            <i
                                class="fas fa-chevron-down ml-1 text-xs transition-transform duration-300 group-hover:rotate-180"></i>
                        </button>

                        <div
                            class="absolute top-full left-1/2 transform -translate-x-1/2 mt-2 w-48 bg-white rounded-lg shadow-xl border border-gray-200 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 -translate-y-2 group-hover:translate-y-0 z-50">
                            <div class="py-2">
                                <a href="{{ route('rundown.starnas') }}"
                                    class="block px-4 py-3 text-sm text-gray-700 hover:bg-emerald-50 hover:text-emerald-600 transition-colors duration-200 border-b border-gray-100">
                                    <i class="fas fa-microphone mr-3 w-4 text-center text-emerald-500"></i>
                                    STARNAS
                                </a>
                                <a href="{{ route('rundown.rakornas') }}"
                                    class="block px-4 py-3 text-sm text-gray-700 hover:bg-emerald-50 hover:text-emerald-600 transition-colors duration-200">
                                    <i class="fas fa-users mr-3 w-4 text-center text-teal-500"></i>
                                    RAKORNAS
                                </a>
                            </div>
                        </div>
                    </div>

                    <a href="{{ route('home') }}#agenda"
                        class="nav-link text-gray-700 hover:text-emerald-600 transition-colors duration-300 whitespace-nowrap">AGENDA</a>

                    <a href="{{ route('home') }}#timeline"
                        class="nav-link text-gray-700 hover:text-emerald-600 transition-colors duration-300 whitespace-nowrap">TIMELINE</a>

                    <a href="{{ route('home') }}#biaya"
                        class="nav-link text-gray-700 hover:text-emerald-600 transition-colors duration-300 whitespace-nowrap">BIAYA</a>

                    <a href="{{ route('home') }}#lokasi"
                        class="nav-link text-gray-700 hover:text-emerald-600 transition-colors duration-300 whitespace-nowrap">LOKASI</a>

                    <a href="{{ route('home') }}#cohost"
                        class="nav-link text-gray-700 hover:text-emerald-600 transition-colors duration-300 whitespace-nowrap">CO-HOST</a>

                    <div class="relative group" id="penulis-dropdown">
                        <button
                            class="nav-link text-gray-700 hover:text-emerald-600 transition-colors duration-300 flex items-center focus:outline-none whitespace-nowrap">
                            UNTUK PENULIS
                            <i
                                class="fas fa-chevron-down ml-1 text-xs transition-transform duration-300 group-hover:rotate-180"></i>
                        </button>

                        <div
                            class="absolute top-full left-1/2 transform -translate-x-1/2 mt-2 w-48 bg-white rounded-lg shadow-xl border border-gray-200 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 -translate-y-2 group-hover:translate-y-0 z-50">
                            <div class="py-2">
                                <a href="{{ route('panduan.penulisan') }}"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-emerald-50 hover:text-emerald-600 transition-colors duration-200">
                                    <i class="fas fa-book mr-3 w-4 text-center text-emerald-500"></i>
                                    Panduan
                                </a>
                                <a href="{{ route('peer.review') }}"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-emerald-50 hover:text-emerald-600 transition-colors duration-200">
                                    <i class="fas fa-check-circle mr-3 w-4 text-center text-teal-500"></i>
                                    Peer Review
                                </a>
                                <a href="{{ route('komite') }}"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-emerald-50 hover:text-emerald-600 transition-colors duration-200">
                                    <i class="fas fa-check-circle mr-3 w-4 text-center text-emerald-500"></i>
                                    Komite
                                </a>
                                <a href="/storage/Manuscript-Template.docx" download="Manuscript Template.docx"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-emerald-50 hover:text-emerald-600 transition-colors duration-200">
                                    <i class="fas fa-info-circle mr-3 w-4 text-center text-amber-500"></i>
                                    Template
                                </a>
                             <a href="https://asasijournal.com/index.php/starnas" target="_blank"
                                    class="block px-4 py-3 text-sm font-bold bg-gradient-to-r from-emerald-500 to-teal-600 text-white rounded-md mx-2 my-2 text-center transition-all duration-300 transform hover:scale-105 hover:shadow-xl hover:from-emerald-600 hover:to-teal-700 border-2 border-emerald-400">
                                    <i class="fas fa-paper-plane mr-2 animate-pulse"></i>
                                    SUBMIT PAPER
                                </a>
                            </div>
                        </div>
                    </div>

                    <a href="{{ route('register') }}"
                        class="btn-primary py-2 px-3 rounded-lg text-xs whitespace-nowrap ml-1">
                        <i class="fas fa-user-plus mr-1"></i>PENDAFTARAN
                    </a>
                </nav>

                <button id="menu-toggle" class="lg:hidden text-gray-700 p-2">
                    <i class="fas fa-bars text-xl"></i>
                </button>
            </div>
        </div>
    </header>

    <div id="mobile-menu-overlay" class="mobile-menu-overlay"></div>

    <div id="mobile-menu" class="mobile-menu">
        <div class="p-4 border-b border-gray-200 flex justify-between items-center bg-white">
            <span class="font-bold text-lg">MENU</span>
            <button id="menu-close"
                class="text-gray-700 p-2 hover:bg-gray-100 rounded-lg transition-colors duration-200">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>
        <div class="p-4 space-y-2 bg-white h-full overflow-y-auto">
            <a href="{{ route('home') }}"
                class="block py-3 px-4 text-gray-700 hover:bg-emerald-50 hover:text-emerald-600 rounded-lg uppercase font-medium text-sm transition-all duration-200 border-l-4 border-transparent hover:border-emerald-500 mobile-nav-link">
                <i class="fas fa-home mr-3 w-4 text-center"></i>
                BERANDA
            </a>

            <a href="{{ route('home') }}#tentang"
                class="block py-3 px-4 text-gray-700 hover:bg-emerald-50 hover:text-emerald-600 rounded-lg uppercase font-medium text-sm transition-all duration-200 border-l-4 border-transparent hover:border-emerald-500 mobile-nav-link">
                <i class="fas fa-info-circle mr-3 w-4 text-center"></i>
                TENTANG
            </a>

            <div class="mobile-dropdown">
                <button
                    class="mobile-dropdown-toggle w-full text-left py-3 px-4 text-gray-700 hover:bg-emerald-50 hover:text-emerald-600 rounded-lg uppercase font-medium text-sm flex justify-between items-center transition-all duration-200 border-l-4 border-transparent">
                    <span class="flex items-center">
                        <i class="fas fa-calendar-alt mr-3 w-4 text-center"></i>
                        RUNDOWN
                    </span>
                    <i class="fas fa-chevron-down text-xs transition-transform duration-300 dropdown-arrow"></i>
                </button>
                <div class="mobile-dropdown-content mt-2 space-y-1 transition-all duration-300 overflow-hidden">
                    <a href="{{ route('rundown.starnas') }}"
                        class="block py-2.5 px-6 text-gray-600 hover:bg-emerald-50 hover:text-emerald-600 rounded-lg text-sm transition-all duration-200 border-l-2 border-emerald-300 ml-4 flex items-center mobile-nav-link">
                        <i class="fas fa-microphone mr-3 w-4 text-center text-emerald-500"></i>
                        STARNAS
                    </a>
                    <a href="{{ route('rundown.rakornas') }}"
                        class="block py-2.5 px-6 text-gray-600 hover:bg-emerald-50 hover:text-emerald-600 rounded-lg text-sm transition-all duration-200 border-l-2 border-teal-300 ml-4 flex items-center mobile-nav-link">
                        <i class="fas fa-users mr-3 w-4 text-center text-teal-500"></i>
                        RAKORNAS
                    </a>
                </div>
            </div>

            <a href="{{ route('home') }}#agenda"
                class="block py-3 px-4 text-gray-700 hover:bg-emerald-50 hover:text-emerald-600 rounded-lg uppercase font-medium text-sm transition-all duration-200 border-l-4 border-transparent hover:border-emerald-500 mobile-nav-link">
                <i class="fas fa-calendar-alt mr-3 w-4 text-center"></i>
                AGENDA
            </a>

            <a href="{{ route('home') }}#timeline"
                class="block py-3 px-4 text-gray-700 hover:bg-emerald-50 hover:text-emerald-600 rounded-lg uppercase font-medium text-sm transition-all duration-200 border-l-4 border-transparent hover:border-emerald-500 mobile-nav-link">
                <i class="fas fa-clock mr-3 w-4 text-center"></i>
                TIMELINE
            </a>

            <a href="{{ route('home') }}#biaya"
                class="block py-3 px-4 text-gray-700 hover:bg-emerald-50 hover:text-emerald-600 rounded-lg uppercase font-medium text-sm transition-all duration-200 border-l-4 border-transparent hover:border-emerald-500 mobile-nav-link">
                <i class="fas fa-tag mr-3 w-4 text-center"></i>
                BIAYA
            </a>

            <a href="{{ route('home') }}#lokasi"
                class="block py-3 px-4 text-gray-700 hover:bg-emerald-50 hover:text-emerald-600 rounded-lg uppercase font-medium text-sm transition-all duration-200 border-l-4 border-transparent hover:border-emerald-500 mobile-nav-link">
                <i class="fas fa-map-marker-alt mr-3 w-4 text-center"></i>
                LOKASI
            </a>

            <a href="{{ route('home') }}#cohost"
                class="block py-3 px-4 text-gray-700 hover:bg-emerald-50 hover:text-emerald-600 rounded-lg uppercase font-medium text-sm transition-all duration-200 border-l-4 border-transparent hover:border-emerald-500 mobile-nav-link">
                <i class="fas fa-handshake mr-3 w-4 text-center"></i>
                CO-HOST
            </a>

            <div class="mobile-dropdown mt-4 pt-4 border-t border-gray-100">
                <button
                    class="mobile-dropdown-toggle w-full text-left py-3 px-4 text-gray-700 hover:bg-emerald-50 hover:text-emerald-600 rounded-lg uppercase font-medium text-sm flex justify-between items-center transition-all duration-200 border-l-4 border-transparent">
                    <span class="flex items-center">
                        <i class="fas fa-pen-fancy mr-3 w-4 text-center"></i>
                        UNTUK PENULIS
                    </span>
                    <i class="fas fa-chevron-down text-xs transition-transform duration-300 dropdown-arrow"></i>
                </button>
                <div class="mobile-dropdown-content mt-2 space-y-1 transition-all duration-300 overflow-hidden">
                    <a href="{{ route('panduan.penulisan') }}"
                        class="block py-2.5 px-6 text-gray-600 hover:bg-emerald-50 hover:text-emerald-600 rounded-lg text-sm transition-all duration-200 border-l-2 border-emerald-300 ml-4 flex items-center mobile-nav-link">
                        <i class="fas fa-book mr-3 w-4 text-center text-emerald-500"></i>
                        Panduan
                    </a>
                    <a href="{{ route('peer.review') }}"
                        class="block py-2.5 px-6 text-gray-600 hover:bg-emerald-50 hover:text-emerald-600 rounded-lg text-sm transition-all duration-200 border-l-2 border-emerald-300 ml-4 flex items-center mobile-nav-link">
                        <i class="fas fa-check-circle mr-3 w-4 text-center text-teal-500"></i>
                        Peer Review
                    </a>
                    <a href="{{ route('komite') }}"
                        class="block py-2.5 px-6 text-gray-600 hover:bg-emerald-50 hover:text-emerald-600 rounded-lg text-sm transition-all duration-200 border-l-2 border-emerald-300 ml-4 flex items-center mobile-nav-link">
                        <i class="fas fa-users mr-3 w-4 text-center text-emerald-500"></i>
                        Komite
                    </a>
                    <a href="/storage/Manuscript-Template.docx" download="Manuscript Template.docx"
                        class="block py-2.5 px-6 text-gray-600 hover:bg-emerald-50 hover:text-emerald-600 rounded-lg text-sm transition-all duration-200 border-l-2 border-emerald-300 ml-4 flex items-center mobile-nav-link">
                        <i class="fas fa-file-download mr-3 w-4 text-center text-amber-500"></i>
                        Template
                    </a>
                    <a href="https://asasijournal.com/index.php/starnas" target="_blank"
                        class="block py-2.5 px-6 text-gray-600 hover:bg-emerald-50 hover:text-emerald-600 rounded-lg text-sm transition-all duration-200 border-l-2 border-emerald-300 ml-4 flex items-center mobile-nav-link">
                        <i class="fas fa-upload mr-3 w-4 text-center text-emerald-500"></i>
                        Submission
                    </a>
                </div>
            </div>

            <a href="{{ route('register') }}"
                class="block py-3 px-4 bg-gradient-to-r from-yellow-400 to-amber-500 text-gray-900 font-bold rounded-lg mt-6 text-center text-sm transition-all duration-300 transform hover:scale-105 hover:shadow-lg mobile-nav-link">
                <i class="fas fa-user-plus mr-2"></i>PENDAFTARAN
            </a>
        </div>
    </div>

    <main class="relative z-10">
        @yield('content')
    </main>

    <footer class="bg-gradient-to-r from-slate-950 via-emerald-950 to-slate-950 text-white py-12 relative z-10 border-t border-emerald-500/20">
        <div class="container mx-auto px-6">
            <div class="flex flex-col items-center text-center">
                <div class="mb-6">
                    <h2 class="text-2xl md:text-3xl font-bold mb-2 bg-gradient-to-r from-emerald-400 via-teal-200 to-amber-300 bg-clip-text text-transparent">STARNAS ASASI 2026 & ICoABCD 2026</h2>
                    <p class="text-emerald-200 text-base md:text-lg">Seminar Teknologi dan Sains Nasional</p>
                </div>
                <div class="border-t border-emerald-900/60 pt-6 w-full max-w-md">
                    <p class="text-emerald-400/80 text-sm">© 2026 STARNAS ASASI & ICoABCD. All rights reserved.</p>
                </div>
            </div>
        </div>
    </footer>

    <script>
        // Initialize AOS (Animate On Scroll)
        AOS.init({
            duration: 1000,
            once: true,
            offset: 100
        });

        // Mobile Menu Functionality - SIMPLIFIED VERSION
        document.addEventListener('DOMContentLoaded', function () {
            // Mobile menu elements
            const menuToggle = document.getElementById('menu-toggle');
            const menuClose = document.getElementById('menu-close');
            const mobileMenu = document.getElementById('mobile-menu');
            const mobileOverlay = document.getElementById('mobile-menu-overlay');
            const body = document.body;

            // Mobile dropdown elements
            const mobileDropdownToggles = document.querySelectorAll('.mobile-dropdown-toggle');

            // Simple mobile menu toggle functions
            function openMobileMenu() {
                mobileMenu.classList.add('active');
                mobileOverlay.classList.add('active');
                body.style.overflow = 'hidden';
            }

            function closeMobileMenu() {
                mobileMenu.classList.remove('active');
                mobileOverlay.classList.remove('active');
                body.style.overflow = 'auto';
                // Close all dropdowns when closing menu
                closeAllDropdowns();
            }

            // Simple dropdown functionality
            function toggleDropdown(dropdownToggle) {
                const dropdownContent = dropdownToggle.nextElementSibling;
                const dropdownArrow = dropdownToggle.querySelector('.dropdown-arrow');
                const isActive = dropdownContent.classList.contains('active');

                // Close all dropdowns first
                closeAllDropdowns();

                if (!isActive) {
                    // Open this dropdown
                    dropdownContent.classList.add('active');
                    if (dropdownArrow) {
                        dropdownArrow.style.transform = 'rotate(180deg)';
                    }
                    // Set max-height for smooth animation
                    dropdownContent.style.maxHeight = dropdownContent.scrollHeight + 'px';
                }
            }

            function closeAllDropdowns() {
                mobileDropdownToggles.forEach(toggle => {
                    const dropdownContent = toggle.nextElementSibling;
                    const dropdownArrow = toggle.querySelector('.dropdown-arrow');

                    if (dropdownContent && dropdownContent.classList.contains('mobile-dropdown-content')) {
                        dropdownContent.classList.remove('active');
                        dropdownContent.style.maxHeight = '0';
                    }

                    if (dropdownArrow) {
                        dropdownArrow.style.transform = 'rotate(0deg)';
                    }
                });
            }

            // Event Listeners - Simple and direct
            if (menuToggle) {
                menuToggle.addEventListener('click', openMobileMenu);
            }

            if (menuClose) {
                menuClose.addEventListener('click', closeMobileMenu);
            }

            if (mobileOverlay) {
                mobileOverlay.addEventListener('click', closeMobileMenu);
            }

            // Dropdown toggles
            mobileDropdownToggles.forEach(toggle => {
                toggle.addEventListener('click', function (e) {
                    e.preventDefault();
                    e.stopPropagation();
                    toggleDropdown(this);
                });
            });

            // Close mobile menu when clicking on nav links (except dropdown toggles)
            document.querySelectorAll('.mobile-nav-link').forEach(link => {
                if (!link.classList.contains('mobile-dropdown-toggle')) {
                    link.addEventListener('click', closeMobileMenu);
                }
            });

            // Close dropdowns when clicking outside
            document.addEventListener('click', function (e) {
                if (!e.target.closest('.mobile-dropdown')) {
                    closeAllDropdowns();
                }
            });

            // Handle escape key
            document.addEventListener('keydown', function (e) {
                if (e.key === 'Escape') {
                    if (mobileMenu.classList.contains('active')) {
                        closeMobileMenu();
                    } else {
                        closeAllDropdowns();
                    }
                }
            });

            // Smooth transition for dropdowns
            document.querySelectorAll('.mobile-dropdown-content').forEach(content => {
                content.addEventListener('transitionend', function () {
                    if (!this.classList.contains('active')) {
                        // Ini akan dijalankan setelah transisi selesai
                        // '0' lebih aman daripada 'null'
                    }
                });
            });

            // NEW: Initialize rundown animations
            initRundownAnimations();
        });

        // Smooth Scrolling for Anchor Links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                // Don't prevent default for dropdown toggles
                if (this.classList.contains('mobile-dropdown-toggle')) {
                    return;
                }

                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Add scroll effect to header
        window.addEventListener('scroll', function () {
            const header = document.querySelector('header');
            if (window.scrollY > 100) {
                header.classList.add('shadow-lg');
            } else {
                header.classList.remove('shadow-lg');
            }
        });

        // Create animated particles in hero section
        function createParticles() {
            const container = document.getElementById('particles-container');
            if (!container) return;

            const particleCount = 12;

            for (let i = 0; i < particleCount; i++) {
                const particle = document.createElement('div');
                particle.classList.add('particle');

                const size = Math.random() * 15 + 5;
                particle.style.width = `${size}px`;
                particle.style.height = `${size}px`;

                particle.style.left = `${Math.random() * 100}%`;
                particle.style.top = `${Math.random() * 100}%`;

                particle.style.animationDelay = `${Math.random() * 15}s`;

                container.appendChild(particle);
            }
        }

        // Panggil createParticles jika elemennya ada
        if (document.getElementById('particles-container')) {
            createParticles();
        }

        // Countdown Timer untuk 1 Desember 2026
        const countdown = () => {
            const countDate = new Date('2026-12-01T08:00:00+07:00').getTime();
            const now = new Date().getTime();
            const gap = countDate - now;

            const daysEl = document.getElementById('days');
            const hoursEl = document.getElementById('hours');
            const minutesEl = document.getElementById('minutes');
            const secondsEl = document.getElementById('seconds');

            if (!daysEl || !hoursEl || !minutesEl || !secondsEl) {
                return; // Berhenti jika elemen tidak ditemukan
            }

            if (gap < 0) {
                daysEl.innerText = '00';
                hoursEl.innerText = '00';
                minutesEl.innerText = '00';
                secondsEl.innerText = '00';
                return;
            }

            const second = 1000;
            const minute = second * 60;
            const hour = minute * 60;
            const day = hour * 24;

            const textDay = Math.floor(gap / day);
            const textHour = Math.floor((gap % day) / hour);
            const textMinute = Math.floor((gap % hour) / minute);
            const textSecond = Math.floor((gap % minute) / second);

            daysEl.innerText = textDay < 10 ? '0' + textDay : textDay;
            hoursEl.innerText = textHour < 10 ? '0' + textHour : textHour;
            minutesEl.innerText = textMinute < 10 ? '0' + textMinute : textMinute;
            secondsEl.innerText = textSecond < 10 ? '0' + textSecond : textSecond;
        };

        // Panggil countdown hanya jika elemen-elemennya ada
        if (document.getElementById('days')) {
            countdown();
            setInterval(countdown, 1000);
        }

        // Function untuk preload images untuk menghindari flicker
        function preloadSliderImages() {
            const images = [
                '/storage/sembalun.jpg',
                '/storage/konferensi.png',
                '/storage/pidato.png'
            ];

            images.forEach(src => {
                const img = new Image();
                img.src = src;
            });
        }

        // Panggil preload
        preloadSliderImages();

        // Hero Slider Functionality
        function initHeroSlider() {
            const slides = document.querySelectorAll('.slide');
            const dots = document.querySelectorAll('.slider-dot');
            const prevBtn = document.querySelector('.slider-arrow.prev');
            const nextBtn = document.querySelector('.slider-arrow.next');

            if (slides.length === 0) return;

            let currentSlide = 0;
            let slideInterval;

            function showSlide(n) {
                slides.forEach(slide => slide.classList.remove('active'));
                dots.forEach(dot => dot.classList.remove('active'));

                currentSlide = (n + slides.length) % slides.length;

                slides[currentSlide].classList.add('active');
                if (dots[currentSlide]) {
                    dots[currentSlide].classList.add('active');
                }
            }

            function nextSlide() {
                showSlide(currentSlide + 1);
            }

            function prevSlide() {
                showSlide(currentSlide - 1);
            }

            function startSlider() {
                // Hentikan interval sebelumnya jika ada
                clearInterval(slideInterval);
                slideInterval = setInterval(nextSlide, 3000);
            }

            function stopSlider() {
                clearInterval(slideInterval);
            }

            // Event Listeners
            if (nextBtn) nextBtn.addEventListener('click', () => {
                stopSlider();
                nextSlide();
                startSlider();
            });

            if (prevBtn) prevBtn.addEventListener('click', () => {
                stopSlider();
                prevSlide();
                startSlider();
            });

            dots.forEach((dot, index) => {
                dot.addEventListener('click', () => {
                    stopSlider();
                    showSlide(index);
                    startSlider();
                });
            });

            // Pause slider on hover
            const slider = document.querySelector('.hero-slider');
            if (slider) {
                slider.addEventListener('mouseenter', stopSlider);
                slider.addEventListener('mouseleave', startSlider);

                // Juga pause ketika touch di mobile
                slider.addEventListener('touchstart', stopSlider);
                slider.addEventListener('touchend', startSlider);
            }

            // Tampilkan slide pertama & Mulai slider
            showSlide(0);
            startSlider();
        }

        // Initialize slider when DOM is loaded
        document.addEventListener('DOMContentLoaded', function () {
            // Beri sedikit waktu agar semua elemen dimuat
            setTimeout(initHeroSlider, 100);
        });

        // NEW: Rundown animations
        function initRundownAnimations() {
            const timelineItems = document.querySelectorAll('.timeline-item');
            
            timelineItems.forEach((item, index) => {
                // Add animation delay for staggered effect
                item.style.animationDelay = `${index * 0.1}s`;
                item.classList.add('timeline-animate');
            });
        }

        // Prevent horizontal scroll
        window.addEventListener('resize', function () {
            if (window.innerWidth > document.documentElement.clientWidth) {
                document.body.style.overflowX = 'hidden';
            }
        });

        // Detect orientation changes and adjust layout
        window.addEventListener('orientationchange', function () {
            setTimeout(function () {
                window.dispatchEvent(new Event('resize'));
                // Inisialisasi ulang slider jika orientasi berubah
                initHeroSlider();
            }, 500);
        });
    </script>
</body>

</html>