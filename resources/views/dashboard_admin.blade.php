<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-3 col-lg-2 d-md-block sidebar">
                <div class="position-sticky">
                    <h4 class="text-white text-center">Admin Panel</h4>
                    <a href="{{ route('admin.users') }}">
                        <i class="fas fa-users"></i> Lihat Daftar Pengguna
                    </a>
                    <a href="{{ route('logout') }}" class="text-danger">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                </div>
            </nav>
            
            <!-- Main Content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 d-flex justify-content-center align-items-center vh-100">
                <div class="col-md-6">
                    <div class="dashboard-card">
                        <h2>Selamat Datang, {{ $user }}</h2>
                        <h4>Anda login sebagai: <strong>{{ $role }}</strong></h4>
                        <p>
                            <i class="fas fa-shopping-cart"></i> Blonjo Halal Nan Murah
                        </p>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>
</html>
