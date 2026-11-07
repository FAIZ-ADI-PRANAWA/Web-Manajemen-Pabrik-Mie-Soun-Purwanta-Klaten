<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SounManager</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: 'Outfit', sans-serif;
            background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 3rem;
            width: 100%;
            max-width: 450px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.2);
        }
        .btn-primary {
            background: #4e73df;
            border: none;
            padding: 0.8rem;
            border-radius: 12px;
            font-weight: 600;
            width: 100%;
        }
        .form-control {
            border-radius: 12px;
            padding: 0.8rem 1rem;
            background: #f8f9fc;
            border: 1px solid #e3e6f0;
        }
        .brand-icon {
            font-size: 3rem;
            color: #4e73df;
            margin-bottom: 1rem;
        }
    </style>
</head>
<body>
    <div class="login-card text-center fade-in">
        <div class="brand-icon">
            <i class="fas fa-mortar-pestle"></i>
        </div>
        <h3 class="fw-bold mb-1">Selamat Datang</h3>
        <p class="text-muted mb-4">Silakan masuk ke akun Anda</p>

        @if(session('error'))
            <div class="alert alert-danger small">{{ session('error') }}</div>
        @endif

        <form action="{{ route('login.post') }}" method="POST">
            @csrf
            <div class="mb-3 text-start">
                <label class="form-label small fw-bold">Email</label>
                <input type="email" name="email" class="form-control" placeholder="admin@pabrik.com" required>
            </div>
            <div class="mb-4 text-start">
                <label class="form-label small fw-bold">Password</label>
                <input type="password" name="password" class="form-control" placeholder="••••••••" required>
            </div>
            <button type="submit" class="btn btn-primary shadow">
                Masuk ke Dashboard
            </button>
        </form>
        
        <div class="mt-4 small text-muted">
            &copy; 2026 SounManager Enterprise
        </div>
    </div>
</body>
</html>
