<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MarketApp</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    @stack('styles')
</head>
<body>

    @auth
    <div class="wrapper">
        <aside class="sidebar-premium">
            <a class="brand-logo" href="#">
                 Market<span>App</span>
            </a>
            
            <ul class="sidebar-menu">
                <li class="sidebar-item">
                    <a href="{{ route('items.index') }}" class="sidebar-link {{ Request::is('items*') ? 'active' : '' }}">
                        <span class="sidebar-icon">📊</span> Data Barang
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="{{ route('categories.index') }}" class="sidebar-link {{ Request::is('categories*') ? 'active' : '' }}">
                        <span class="sidebar-icon">🏷️</span> Kategori
                    </a>
                </li>
            </ul>

            <div class="sidebar-footer">
                <div class="profile-box-premium mb-3">
                    <div class="text-muted" style="font-size: 0.75rem; font-weight: 600; letter-spacing: 0.5px; text-transform: uppercase;">Sebagai: {{ Auth::user()->role }}</div>
                    <a href="{{ route('profile') }}" class="text-decoration-none text-dark fw-bold d-block mt-1" style="font-size: 0.95rem;">
                        {{ Auth::user()->name }}
                    </a>
                </div>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-outline-danger w-100 fw-bold py-2.5" style="border-radius: 12px; font-size: 0.85rem; letter-spacing: 0.5px;">
                        LOGOUT
                    </button>
                </form>
            </div>
        </aside>

        <main class="main-content">
            @yield('content')
        </main>
    </div>
    @endauth

    @guest
    <div class="container d-flex flex-column justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="text-center mb-4">
            <h1 class="fw-bold text-white m-0" style="letter-spacing: -1.5px; font-size: 3.5rem; text-shadow: 0 4px 15px rgba(0, 0, 0, 0.6); line-height: 1;">
                Market<span style="color: #818cf8;">App</span>
            </h1>
        </div>
        
        <div class="w-100">
            @yield('content')
        </div>
    </div>
    @endguest

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: "{{ session('success') }}",
                showConfirmButton: false,
                timer: 2500,
                customClass: {
                    popup: 'premium-popup'
                }
            });
        @endif
    </script>
    @stack('scripts')
</body>
</html>