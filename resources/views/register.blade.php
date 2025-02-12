<!DOCTYPE html>  
<html lang="id">  
<head>  
    <meta charset="UTF-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    <title>Register</title>  
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">  
    <style>  
        body {  
            background-color: #f0f2f5;  
        }  
        .container {  
            max-width: 500px;  
            margin-top: 50px;  
            padding: 30px;  
            background-color: white;  
            border-radius: 10px;  
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);  
        }  
        h2 {  
            color: #007bff;  
            margin-bottom: 20px;  
        }  
        .alert {  
            margin-bottom: 20px;  
        }  
        .btn-primary {  
            background-color: #007bff;  
            border-color: #007bff;  
        }  
        .btn-primary:hover {  
            background-color: #0056b3;  
            border-color: #004085;  
        }  
    </style>  
</head>  
<body>  
    <div class="container">  
        <h2 class="text-center">Registrasi</h2>  

        @if(session('success'))  
            <div class="alert alert-success">{{ session('success') }}</div>  
        @endif  

        @if($errors->any())  
            <div class="alert alert-danger">  
                <ul>  
                    @foreach($errors->all() as $error)  
                        <li>{{ $error }}</li>  
                    @endforeach  
                </ul>  
            </div>  
        @endif  

        <form action="{{ route('register') }}" method="post">  
            @csrf  
            <div class="mb-3">  
                <label class="form-label">Nama Lengkap</label>  
                <input type="text" name="nama" class="form-control" required>  
            </div>  

            <div class="mb-3">  
                <label class="form-label">Username (Email)</label>  
                <input type="email" name="username" class="form-control" required>  
            </div>  

            <div class="mb-3">  
                <label class="form-label">Password</label>  
                <input type="password" name="password" class="form-control" required>  
            </div>  

            <div class="mb-3">  
                <label class="form-label">Konfirmasi Password</label>  
                <input type="password" name="password_confirmation" class="form-control" required>  
            </div>  

            <div class="mb-3">  
                <label class="form-label">Role</label>  
                <input type="text" class="form-control" value="User" disabled>  
            </div>  

            <button type="submit" class="btn btn-primary w-100">Daftar</button>  
            <p class="text-center mt-3">Sudah punya akun? <a href="{{ route('login') }}">Login di sini</a></p>  
        </form>  
    </div>  
</body>  
</html>