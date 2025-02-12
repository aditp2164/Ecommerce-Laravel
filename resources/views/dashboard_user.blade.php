<!DOCTYPE html>  
<html lang="id">  
<head>  
    <meta charset="UTF-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    <title>Dashboard User</title>  
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">  
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">  
    <style>  
        body {  
            background-color: #f8f9fa;  
            display: flex;  
            overflow-x: hidden;  
        }  
        .sidebar {  
            width: 250px;  
            height: 100vh;  
            background-color: #343a40;   
            color: white;  
            padding-top: 20px;  
            position: fixed;  
            transition: width 0.3s;  
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);   
        }  
        .sidebar a {  
            color: white;  
            padding: 15px;  
            display: flex;  
            align-items: center;  
            text-decoration: none;  
            transition: background-color 0.3s, color 0.3s;   
        }  
        .sidebar a:hover {  
            background-color: #495057;   
            color: #ffdd57;   
        }  
        .sidebar i {  
            width: 30px;  
            text-align: center;  
        }  
        .content {  
            margin-left: 250px;  
            padding: 20px;  
            width: calc(100% - 250px);  
            transition: margin-left 0.3s, width 0.3s;  
        }  
        .advertisement {  
            background-color: #e9ecef;  
            padding: 15px;  
            margin-bottom: 20px;  
            border-radius: 5px;  
            text-align: center;  
        }  
        .product-list {  
            display: grid;  
            grid-template-columns: repeat(3, 1fr);  
            gap: 15px;  
        }  
        .product-card {  
            background-color: white;  
            border: 1px solid #dee2e6;  
            border-radius: 5px;  
            padding: 15px;  
            text-align: center;  
            transition: transform 0.2s;  
        }  
        .product-card:hover {  
            transform: scale(1.05);  
        }  
        .product-image {  
            width: 100%;  
            height: auto;  
            border-radius: 5px;  
        }  

        .product-list {  
        display: flex; /* Tambahkan Flexbox untuk merapikan card */  
        flex-wrap: wrap; /* Agar produk bisa membungkus ke baris berikutnya */  
        justify-content: space-between; /* Meratakan card */  
    }  

    .product-card {  
        border: 1px solid #ccc; /* Memberikan border pada card */  
        border-radius: 8px; /* Membuat sudut card melengkung */  
        padding: 16px; /* Memberikan ruang di dalam card */  
        text-align: center; /* Mengatur teks di tengah */  
        width: calc(25% - 20px); /* Mengatur lebar card agar rapi */  
        margin-bottom: 20px; /* Memberikan jarak antar card di bawah */  
    }  

    .product-image {  
        max-width: 100%; /* Mengatur gambar agar responsif */  
        height: auto; /* Mengatur tinggi gambar otomatis */  
    }  

    .discount-price {  
        color: red; /* Mengatur warna harga diskon menjadi merah */  
        font-weight: bold; /* Memberikan ketebalan pada font diskon */  
    }  

    h5 {  
        font-family: Arial, sans-serif; /* Mengubah font judul produk */  
    }  

    p {  
        font-family: Arial, sans-serif; /* Mengubah font untuk paragraf */  
        margin: 5px 0; /* Mengatur jarak antara paragraf */  
    }  
    
    </style>  
</head>  
<body>  
    <div class="sidebar">  
        <h4 class="text-center">Dashboard User</h4>  
        <!-- <a href="#" class="d-flex align-items-center"><i class="fas fa-home"></i><span class="ms-2">Dashboard</span></a>   -->
        <a href="{{ route('performa') }}" class="d-flex align-items-center"><i class="fas fa-chart-line"></i><span class="ms-2">Performa</span></a>  
        <a href="{{ route('produk.perhitungan') }}" class="d-flex align-items-center"><i class="fas fa-box"></i><span class="ms-2">Produk Perhitungan</span></a>  
        <!-- <a href="#" class="d-flex align-items-center"><i class="fas fa-gift"></i><span class="ms-2">Cashback</span></a>  
        <a href="#" class="d-flex align-items-center"><i class="fas fa-receipt"></i><span class="ms-2">Transaksi</span></a>   -->
        <a href="{{ route('logout') }}" class="d-flex align-items-center text-danger"><i class="fas fa-sign-out-alt"></i><span class="ms-2">Logout</span></a>  
    </div>  

    <div class="content">  
        <h2>Selamat Datang, {{ $user }}</h2>  
        <h4>Anda login sebagai: <strong>{{ $role }}</strong></h4>  
        <p><i class="fas fa-shopping-cart" style="font-size: 24px; margin-right: 10px;"></i>Blonjo Halal Nan Murah</p>  

        <!-- Iklan Produk -->  
        <div class="advertisement">  
            <h5>Iklan Produk Spesial!</h5>  
            <p>Diskon hingga 50% untuk produk terpilih!</p>  
        </div>  

        <h3>Iklan Produk</h3>  
<div class="product-list">  
    <div class="product-card">  
        <img src="/images/compas.jpg" alt="Deskripsi Gambar" class="product-image">  
        <h5>Compas</h5>  
        <p><span style="text-decoration: line-through;">Harga: Rp 500.000</span></p>  
        <p class="discount-price">Harga Diskon: Rp 250.000</p>  
    </div>  
    <div class="product-card">  
        <img src="/images/adidas.jpg" alt="Deskripsi Gambar" class="product-image">  
        <h5>Adidas</h5>  
        <p><span style="text-decoration: line-through;">Harga: Rp 900.000</span></p>  
        <p class="discount-price">Harga Diskon: Rp 450.000</p>  
    </div>  
    <div class="product-card">  
        <img src="/images/ventela.jpg" alt="Deskripsi Gambar" class="product-image">  
        <h5>Ventela</h5>  
        <p><span style="text-decoration: line-through;">Harga: Rp 300.000</span></p>  
        <p class="discount-price">Harga Diskon: Rp 150.000</p>  
    </div>  
    <div class="product-card">  
        <img src="/images/johnson.jpg" alt="Deskripsi Gambar" class="product-image">  
        <h5>Johnson</h5>  
        <p><span style="text-decoration: line-through;">Harga: Rp 550.000</span></p>  
        <p class="discount-price">Harga Diskon: Rp 275.000</p>  
    </div>  
    <!-- Tambahkan lebih banyak produk sesuai kebutuhan -->  
</div> 
</body>  
</html>