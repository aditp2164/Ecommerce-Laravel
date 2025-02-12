<!DOCTYPE html>  
<html lang="id">  
<head>  
    <meta charset="UTF-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    <title>Login</title>  
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">  
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">  

    <style>  
        body {  
            background: url("{{ asset('images/keranjang.jpg') }}") no-repeat center center fixed;  
            background-size: cover;  
            display: flex;  
            justify-content: center;  
            align-items: center;  
            height: 100vh;  
            position: relative;  
        }  

        /* Overlay untuk meningkatkan keterbacaan teks */
        body::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5); /* Hitam transparan */
            z-index: 1;
        }

        .container {  
            max-width: 400px;  
            width: 100%;  
            padding: 30px;  
            background-color: rgba(255, 255, 255, 0.9); /* Transparan agar menyatu dengan background */
            border-radius: 10px;  
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);  
            position: relative;  
            z-index: 2; /* Agar tetap di atas overlay */
        }  

        h1 {  
            font-size: 24px;  
            text-align: center;  
            margin-bottom: 20px;  
            font-weight: bold;  
        }  

        label {  
            margin-bottom: 5px;  
        }  

        .btn-primary {  
            background-color: #007bff;  
            border-color: #007bff;  
        }  

        .btn-primary:hover {  
            background-color: #0056b3;  
            border-color: #004085;  
        }  

        .text-center a {  
            color: #007bff;  
        }  

        .text-center a:hover {  
            text-decoration: underline;  
        }  
    </style>  
</head>  
<body>  
    <div class="container">  
        <h1>  
            <i class="fas fa-shopping-cart" style="font-size: 24px; margin-right: 10px;"></i>  
            Blonjo Halal Nan Murah  
        </h1>  

        @if(session('success'))  
            <div class="alert alert-success">{{ session('success') }}</div>  
        @endif  

        <form action="{{ route('login') }}" method="post">  
            @csrf  
            <div class="mb-3">  
                <label class="form-label">Email</label>  
                <input type="email" name="username" class="form-control" required>  
            </div>  
            <div class="mb-3">  
                <label class="form-label">Password</label>  
                <input type="password" name="password" class="form-control" required>  
            </div>  
            <div class="mb-3 form-check">  
                <input type="checkbox" class="form-check-input" id="rememberMe">  
                <label class="form-check-label" for="rememberMe">Remember me</label>  
            </div>  
            <button type="submit" class="btn btn-primary w-100">LOGIN</button>  
            <p class="text-center mt-3">Belum punya akun? <a href="{{ route('register') }}">Daftar</a></p>  
        </form>  
    </div>  
</body>  
</html>
