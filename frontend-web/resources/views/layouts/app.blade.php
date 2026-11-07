<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SounManager - Enterprise Mie Soun</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --primary: #4e73df;
            --secondary: #858796;
            --success: #1cc88a;
            --info: #36b9cc;
            --warning: #f6c23e;
            --danger: #e74a3b;
            --dark: #1b1b18;
            --sidebar-width: 260px;
        }

        body {
            font-family: 'Outfit', sans-serif;
            background-color: #f8f9fc;
            color: var(--dark);
            overflow-x: hidden;
        }

        /* Sidebar Style */
        #sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            background: linear-gradient(180deg, #4e73df 10%, #224abe 100%);
            color: white;
            transition: all 0.3s;
            z-index: 1000;
            box-shadow: 4px 0 10px rgba(0,0,0,0.1);
        }

        #sidebar .sidebar-header {
            padding: 2rem 1.5rem;
            text-align: center;
        }

        #sidebar ul.components {
            padding: 1rem 0;
        }

        #sidebar ul li a {
            padding: 0.8rem 1.5rem;
            display: block;
            color: rgba(255,255,255,0.8);
            text-decoration: none;
            transition: 0.2s;
            font-weight: 400;
            margin: 0.2rem 1rem;
            border-radius: 10px;
        }

        #sidebar ul li a:hover {
            color: white;
            background: rgba(255,255,255,0.1);
        }

        #sidebar ul li.active > a {
            color: white;
            background: rgba(255,255,255,0.2);
            font-weight: 600;
        }

        #sidebar ul li a i {
            margin-right: 10px;
            width: 20px;
            text-align: center;
        }

        /* Main Content */
        #content {
            margin-left: var(--sidebar-width);
            width: calc(100% - var(--sidebar-width));
            min-height: 100vh;
            transition: all 0.3s;
        }

        /* Topbar */
        .topbar {
            height: 70px;
            background: white;
            display: flex;
            align-items: center;
            padding: 0 2rem;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            margin-bottom: 2rem;
        }

        /* Card Customization */
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
        }

        .card-header {
            background-color: transparent;
            border-bottom: 1px solid #f1f1f1;
            padding: 1rem 1.5rem;
            font-weight: 700;
            color: var(--primary);
        }

        .btn-primary {
            background-color: var(--primary);
            border: none;
            border-radius: 10px;
            padding: 0.6rem 1.5rem;
            font-weight: 600;
        }

        .form-control, .form-select {
            border-radius: 10px;
            padding: 0.6rem 1rem;
            border: 1px solid #d1d3e2;
        }

        .form-control:focus {
            box-shadow: 0 0 0 0.25rem rgba(78, 115, 223, 0.1);
        }

        /* Animations */
        .fade-in {
            animation: fadeIn 0.5s ease-in;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
    @stack('styles')
</head>
<body>

    <!-- Sidebar -->
    <nav id="sidebar">
        <div class="sidebar-header">
            <h5 class="mb-0 fw-bold" style="font-size: 1.1rem;"><i class="fas fa-industry me-2"></i>SOUN <span class="fw-light">PURWANTA</span></h5>
        </div>

        <ul class="list-unstyled components">
            <li class="{{ Request::is('/') ? 'active' : '' }}">
                <a href="{{ url('/') }}"><i class="fas fa-chart-line"></i> Dashboard</a>
            </li>
            <li class="{{ Request::is('bahan-baku*') ? 'active' : '' }}">
                <a href="{{ route('bahan-baku.index') }}"><i class="fas fa-boxes-stacked"></i> Bahan Baku</a>
            </li>
            <li class="{{ Request::is('produksi*') ? 'active' : '' }}">
                <a href="{{ route('produksi.index') }}"><i class="fas fa-industry"></i> Produksi</a>
            </li>
            <li class="{{ Request::is('transaksi*') ? 'active' : '' }}">
                <a href="{{ route('transaksi.index') }}"><i class="fas fa-exchange-alt"></i> Transaksi</a>
            </li>
            <li class="{{ Request::is('laporan*') ? 'active' : '' }}">
                <a href="{{ route('laporan.index') }}"><i class="fas fa-file-invoice"></i> Laporan</a>
            </li>
            <li class="{{ Request::is('harga-jual*') ? 'active' : '' }}">
                <a href="{{ route('harga-jual.index') }}"><i class="fas fa-tags"></i> Pengaturan Harga</a>
            </li>
        </ul>

        <div class="p-4 mt-auto">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-outline-light w-100 rounded-pill">
                    <i class="fas fa-sign-out-alt me-2"></i> Keluar
                </button>
            </form>
        </div>
    </nav>

    <!-- Page Content -->
    <div id="content">
        <!-- Topbar -->
        <div class="topbar">
            <h5 class="mb-0 text-gray-800 fw-bold">
                @yield('page_title', 'Dashboard')
            </h5>
            <div class="ms-auto d-flex align-items-center">
                <span class="me-3 text-gray-600 d-none d-lg-inline small">{{ session('user_name', 'Administrator') }}</span>
                <img class="img-profile rounded-circle" src="https://ui-avatars.com/api/?name=Admin&background=4e73df&color=fff" width="40">
            </div>
        </div>

        <div class="container-fluid px-4 fade-in">
            @yield('content')
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @stack('scripts')
</body>
</html>
