<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .dashboard-card {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .dashboard-card h2 {
            color: #333;
            font-weight: bold;
        }
        .dashboard-card h4 {
            color: #555;
        }
        .dashboard-card p {
            font-size: 18px;
            color: #222;
        }
        .dashboard-card .btn {
            width: 100%;
            font-size: 16px;
            padding: 10px;
        }
        .dashboard-icon {
            font-size: 24px;
            color: rgb(0, 6, 90);
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="col-md-6">
            <div class="dashboard-card">
                <h2>Selamat Datang, {{ $user }}</h2>
                <h4>Anda login sebagai: <strong>{{ $role }}</strong></h4>
                
                <p>
                    <i class="fas fa-shopping-cart dashboard-icon"></i>  
                    Blonjo Halal Nan Murah
                </p>

                <a href="{{ route('admin.users') }}" class="btn btn-primary mb-2">
                    <i class="fas fa-users"></i> Lihat Daftar Pengguna
                </a>
                <a href="{{ route('logout') }}" class="btn btn-danger">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
            </div>
        </div>
    </div>
</body>
</html>
