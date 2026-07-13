<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MarketApp</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f8fafc; /* Slate background super clean */
            color: #0f172a;
            overflow-x: hidden;
        }

        @auth
        /* Layout Pembagian Sidebar & Konten Utama */
        .wrapper {
            display: flex;
            align-items: stretch;
            min-height: 100vh;
        }
        
        /*  SIDEBAR */
        .sidebar-premium {
            min-width: 260px;
            max-width: 260px;
            background: #ffffff;
            border-right: 1px solid #e2e8f0;
            padding: 2.5rem 1.25rem;
            display: flex;
            flex-direction: column;
            position: fixed;
            height: 100vh;
            z-index: 999; /* Z-index tinggi agar selalu di atas konten */
            
            transform: translateX(-260px); 
            transition: transform 0.35s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 0 0 rgba(0,0,0,0);
        }

        /* AREA PEMICU: Garis gaib di paling kiri layar untuk memancing mouse */
        .sidebar-premium::before {
            content: '';
            position: fixed;
            top: 0;
            left: 260px; /* Diletakkan pas di ujung luar sidebar yang sembunyi */
            width: 20px; /* Lebar area sensitif sensor mouse */
            height: 100vh;
            background: transparent;
            cursor: pointer;
        }

        /* Ketika mouse mendekat ke kiri layar / menyentuh pemicu, sidebar meluncur keluar */
        .sidebar-premium:hover {
            transform: translateX(0);
            box-shadow: 10px 0 50px rgba(15, 23, 42, 0.15); /* Bayangan mewah saat aktif */
        }

        /* Konten utama nempel full ke kiri saat sidebar ngumpet */
        .main-content {
            width: 100%;
            padding: 2.5rem 3rem;
            margin-left: 0; /* Fullscreen total tanpa gap */
            background-color: #f8fafc;
        }
        @endauth

        /* Logo Brand Sleek */
        .brand-logo {
            font-weight: 800;
            font-size: 1.65rem;
            letter-spacing: -1px;
            color: #0f172a;
            text-decoration: none !important;
            margin-bottom: 3rem;
            display: block;
            text-align: center;
            white-space: nowrap;
            line-height: 1;
            width: 100%;
        }
        .brand-logo span {
            color: #4f46e5; /* Indigo accent */
        }

        /* Navigasi Menu List */
        .sidebar-menu {
            list-style: none;
            padding: 0;
            margin: 0;
            flex-grow: 1;
        }
        .sidebar-item {
            margin-bottom: 0.5rem;
        }
        .sidebar-link {
            display: flex;
            align-items: center;
            padding: 0.85rem 1.1rem;
            color: #64748b;
            font-weight: 600;
            font-size: 0.95rem;
            text-decoration: none;
            border-radius: 12px;
            transition: all 0.25s ease;
        }
        .sidebar-link:hover {
            color: #4f46e5;
            background-color: #f1f5f9;
        }
        .sidebar-link.active {
            color: #4f46e5;
            background-color: #e0e7ff; 
            box-shadow: inset 4px 0 0 #4f46e5;
        }
        .sidebar-icon {
            margin-right: 12px;
            font-size: 1.2rem;
        }

        /* User Profile Box Kiri Bawah */
        .sidebar-footer {
            border-top: 1px solid #f1f5f9;
            padding-top: 1.5rem;
            margin-top: auto;
        }
        .profile-box-premium {
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 14px;
            padding: 12px 16px;
        }

        /* Premium Container Box Modifikasi */
        .card-premium {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 20px;
            box-shadow: 0 4px 18px rgba(15, 23, 42, 0.03);
            padding: 1.75rem;
        }

        /* Desain Elemen Form Global Modern */
        .form-control-premium {
            border-radius: 12px;
            padding: 0.75rem 1rem;
            border: 1px solid #cbd5e1;
            font-size: 0.95rem;
            transition: all 0.2s ease;
        }
        .form-control-premium:focus {
            border-color: #4f46e5;
            box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.12);
        }

        /* Tombol Utama Luxury */
        .btn-premium-primary {
            background: linear-gradient(135deg, #4f46e5, #4338ca);
            color: #ffffff !important;
            font-weight: 600;
            font-size: 0.95rem;
            border-radius: 12px;
            padding: 0.7rem 1.5rem;
            border: none;
            box-shadow: 0 4px 12px rgba(79, 70, 229, 0.25);
            transition: all 0.25s ease;
        }
        .btn-premium-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(79, 70, 229, 0.35);
        }

        /* Kustomisasi Khusus Pop-up SweetAlert agar serasi dengan Plus Jakarta Sans */
        .premium-popup {
            border-radius: 16px !important;
            font-family: 'Plus Jakarta Sans', sans-serif !important;
        }
    </style>
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
</body>
</html>