<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Pengguna;
use App\Models\Produk;

class AuthController extends Controller
{
    // Menampilkan form login
    public function showLoginForm()
    {
        return view('login');
    }

    // Menampilkan form registrasi
    public function showRegisterForm()
    {
        return view('register');
    }

    // Proses registrasi user
    public function register(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'username' => 'required|email|unique:pengguna,username',
            'password' => 'required|min:6|confirmed',
        ]);

        Pengguna::create([
            'nama' => $request->nama,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role' => 'user', // Default role untuk pendaftar baru
        ]);

        return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan login.');
    }

    // Proses login
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|email',
            'password' => 'required',
        ]);

        $user = Pengguna::where('username', $request->username)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()->withErrors(['username' => 'Username atau password salah.']);
        }

        // Simpan session login
        session([
            'logged_in' => true,
            'user_id' => $user->id,
            'user_name' => $user->nama,
            'user_role' => $user->role
        ]);

        return redirect()->route('dashboard');
    }

    // Logout
    public function logout()
    {
        session()->flush();
        return redirect()->route('login')->with('success', 'Berhasil logout.');
    }

    // Dashboard setelah login
    public function dashboard()
    {
    if (!session('logged_in')) {
        return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
    }

    $role = session('user_role');
    $user = session('user_name');

    if ($role == 'admin') {
        return view('dashboard_admin', compact('user', 'role'));
    } else {
        $produk = Produk::all();  
        return view('dashboard_user', compact('user', 'role'));
    }
    }

    // Menampilkan form edit user
    public function editUser($id)
    {
        if (!session('logged_in') || session('user_role') !== 'admin') {
            return redirect()->route('dashboard')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        }

        $user = Pengguna::findOrFail($id);
        return view('admin.edit_user', compact('user'));
    }

    // Memproses update user
    public function updateUser(Request $request, $id)
    {
        if (!session('logged_in') || session('user_role') !== 'admin') {
            return redirect()->route('dashboard')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        }

        $request->validate([
            'nama' => 'required|string|max:255',
            'username' => 'required|email|unique:pengguna,username,' . $id,
            'role' => 'required|in:admin,librarian,user',
        ]);

        $user = Pengguna::findOrFail($id);
        $user->update([
            'nama' => $request->nama,
            'username' => $request->username,
            'role' => $request->role,
        ]);

        return redirect()->route('admin.users')->with('success', 'Data pengguna berhasil diperbarui.');
    }

    // Menghapus user
    public function deleteUser($id)
    {
        if (!session('logged_in') || session('user_role') !== 'admin') {
            return redirect()->route('dashboard')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        }

        $user = Pengguna::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.users')->with('success', 'Pengguna berhasil dihapus.');
    }

    // Menampilkan daftar pengguna (Hanya untuk Admin)
    public function listUsers()
    {
        if (!session('logged_in') || session('user_role') !== 'admin') {
            return redirect()->route('dashboard')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        }

        $users = Pengguna::all(); // Mengambil semua data pengguna

        return view('admin.users', compact('users'));
    }

    public function showProdukPerhitungan()
    {
        return view('perhitungan');
    }

    public function storeProduk(Request $request)
    {
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'satuan_berat' => 'required|string',
            'deskripsi' => 'nullable|string',
            'kategori' => 'required|string',
            'berat' => 'required|numeric',
            'harga' => 'required|numeric',
            'komponen' => 'required|array', // Ubah validasi menjadi array
            'persentase' => 'required|array', // Ubah validasi menjadi array
            'nominal' => 'required|array',    // Ubah validasi menjadi array
            'margin' => 'required|array'
        ]);

        $namaProduk = $request->input('nama_produk');
        $satuanBerat = $request->input('satuan_berat');
        $deskripsi = $request->input('deskripsi');
        $kategori = $request->input('kategori');
        $berat = $request->input('berat');
        $harga = $request->input('harga');
        $komponen = $request->input('komponen');
        $persentase = $request->input('persentase');
        $nominal = $request->input('nominal');
        $margin = $request->input('margin');

        // Loop melalui setiap komponen dan simpan datanya
        foreach ($komponen as $key => $value) {
            $data = [
                'nama_produk' => $namaProduk,
                'satuan_berat' => $satuanBerat,
                'deskripsi' => $deskripsi,
                'kategori' => $kategori,
                'berat' => $berat,
                'harga' => $harga,
                'komponen' => $komponen[$key],
                'persentase' => $persentase[$key],
                'nominal' => $nominal[$key],
                'margin' => $margin[$key],
            ];

            // Simpan data ke database
            Produk::create($data);
        }

        return redirect()->route('produk.perhitungan')->with('success', 'Produk berhasil disimpan!');
    }

    public function export()  
    {  
        $produk = Produk::all(); // Ambil semua data produk (atau filter sesuai kebutuhan)  

        // Buat file CSV (atau format lain yang Anda inginkan)  
        $filename = 'produk.csv';  
        $headers = [  
            'Content-Type' => 'text/csv',  
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',  
        ];  

        $callback = function() use ($produk) {  
            $file = fopen('php://output', 'w');  

            // Tambahkan header CSV  
            fputcsv($file, ['Nama Produk', 'Kategori', 'Berat', 'Harga']); // Ganti dengan kolom yang sesuai  

            // Tambahkan data  
            foreach ($produk as $row) {  
                fputcsv($file, [  
                    $row->nama_produk,  
                    $row->kategori,  
                    $row->berat,  
                    $row->harga  
                ]); // Ganti dengan kolom yang sesuai  
            }  

            fclose($file);  
        };  

        return response()->stream($callback, 200, $headers);  
    }  

    public function showPerforma()  
{  
    $produk = Produk::all();  
    $totalPenjualan = Produk::sum('harga') * 1000; // Mengalikan total dengan 1000  
    $totalCashback = Produk::sum('nominal') * 1000;
    $feeAplikasi = $totalPenjualan * 0.05; // Jika fee 5%
    $totalMargin = $totalPenjualan - $feeAplikasi * 1.00;

    // Ambil data dari tabel produksi
    $total_presentase = Produk::sum('persentase');
    $total_margin = Produk::sum('margin');


    // Buat array data untuk dikirim ke Blade
    $chartData = [
        'labels' => ['Cashback Pelanggan', 'Margin'],
        'data' => [(float) $total_presentase, (float) $total_margin]
    ];    

    return view('performa', compact('produk', 'totalPenjualan','totalCashback', 'feeAplikasi', 'totalMargin', 'chartData'));  
}

    
}
