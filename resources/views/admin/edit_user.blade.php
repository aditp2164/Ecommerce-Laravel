<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pengguna</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        body {
            background-color: #f4f6f9;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .card {
            width: 450px;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
            background: white;
        }
        .card-title {
            font-weight: bold;
            color: #002147;
            text-align: center;
            margin-bottom: 15px;
        }
        .form-label {
            font-weight: 500;
            color: rgb(50, 50, 50);
        }
        .form-control {
            border-radius: 8px;
        }
        .btn-primary {
            background-color: #002147;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            padding: 10px;
            width: 100%;
        }
        .btn-primary:hover {
            background-color: #001b36;
        }
        .btn-secondary {
            background-color: #6c757d;
            border-radius: 8px;
            font-size: 16px;
            padding: 10px;
            width: 100%;
        }
    </style>
</head>
<body>
    <div class="card">
        <h2 class="card-title">Edit Pengguna</h2>

        <form action="{{ route('admin.updateUser', $user->id) }}" method="POST">
        @csrf
        @method('PUT') <!-- Tambahkan ini untuk mengganti method menjadi PUT -->

        <div class="mb-3">
            <label class="form-label">Nama</label>
            <input type="text" class="form-control" name="nama" value="{{ $user->nama }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Username</label>
            <input type="text" class="form-control" name="username" value="{{ $user->username }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Role</label>
            <select class="form-control" name="role">
                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
    </form>

        <div class="text-center mt-3">
            <a href="{{ route('admin.users') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Batal
            </a>
        </div>
    </div>
</body>
</html>
