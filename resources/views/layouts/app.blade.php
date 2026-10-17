<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | Serenity Yoga Studio</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:wght@500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/yoga.css') }}">
</head>
<body>
<header class="navbar">
    <div class="container nav-inner">
        <a href="{{ route('home') }}" class="brand">
            <span class="brand-mark" aria-hidden="true">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none"><path d="M12 20V11M12 15C6 15 4 11 4 7C9 7 12 10 12 15ZM12 12C12 7 15 4 20 4C20 9 17 12 12 12Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </span>
            Serenity
        </a>
        <button class="menu-toggle" id="menuToggle" type="button" aria-expanded="false" aria-controls="navLinks">Menu</button>
        <nav class="nav-links" id="navLinks" aria-label="Menu utama">
            <a href="{{ route('classes.index') }}" class="{{ request()->routeIs('classes.*', 'bookings.*') ? 'active' : '' }}">Jadwal kelas</a>
            <a href="{{ route('purchases.index') }}" class="{{ request()->routeIs('purchases.*') ? 'active' : '' }}">Paket kredit</a>
            <a href="{{ route('history.index') }}" data-history class="{{ request()->routeIs('history.*') ? 'active' : '' }}">Riwayat</a>
            <span class="code-chip" id="codeChip"></span>
        </nav>
    </div>
</header>

<main class="page">
    <div class="container">
        @if (session('success'))<div class="alert alert-ok">{{ session('success') }}</div>@endif
        @if (session('warning'))<div class="alert alert-warn">{{ session('warning') }}</div>@endif
        @if ($errors->any())
            <div class="alert alert-err" role="alert">@foreach ($errors->all() as $error)<p>{{ $error }}</p>@endforeach</div>
        @endif
        @yield('content')
    </div>
</main>

<footer class="footer">
    <div class="container">
        <span>© {{ date('Y') }} Serenity Yoga Studio</span>
        <span>Reschedule maksimal 12 jam sebelum kelas dimulai.</span>
    </div>
</footer>

<script>
    // Menu mobile
    const toggle = document.getElementById('menuToggle'), links = document.getElementById('navLinks');
    toggle.addEventListener('click', () => toggle.setAttribute('aria-expanded', links.classList.toggle('open')));

    // Ingat kode pelanggan di browser supaya tidak perlu mengetik ulang
    const KEY = 'yogaCode';
    const marker = document.querySelector('[data-save-code]');
    if (marker) localStorage.setItem(KEY, marker.dataset.saveCode);
    const code = localStorage.getItem(KEY);
    if (code) {
        document.querySelectorAll('input[name=customer_code]').forEach(i => { if (!i.value) i.value = code; });
        const chip = document.getElementById('codeChip');
        chip.textContent = code; chip.style.display = 'inline-block';
        document.querySelectorAll('a[data-history]').forEach(a => a.href += '?customer_code=' + encodeURIComponent(code));
    }
    document.querySelectorAll('form').forEach(f => f.addEventListener('submit', () => {
        const i = f.querySelector('input[name=customer_code]');
        if (i && i.value.trim()) localStorage.setItem(KEY, i.value.trim().toUpperCase());
    }));
</script>
@stack('scripts')
</body>
</html>
