<!DOCTYPE html>  
<html lang="en">  

<head>  
    <meta charset="UTF-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    <title>Blonjo Halal</title>  
    <script src="https://cdn.tailwindcss.com"></script>  
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>  
</head>  

<body class="bg-white-100 font-sans">  
    <div class="container mx-auto p-4">  
        <!-- Header -->  
        <header class="mb-6 flex justify-between items-center">  
            <!-- Kiri: Judul -->  
            <div class="flex flex-col">  
                <h1 class="text-3xl font-bold">Blonjo Halal</h1>  
                <p class="text-gray-500">Dasbor Laporan Penjualan & Cashback</p>  
            </div>  

            <!-- Kanan: Dropdown dan Tombol -->  
            <div class="flex items-center space-x-4">  
                <!-- Dropdown Bulan Tahun -->  
                <select id="monthSelect" class="border border-gray-300 rounded-lg py-2 px-3 bg-white shadow-sm text-gray-700">    
                    <option>Januari 2025</option>  
                    <option>Februari 2025</option>  
                    <option>Maret 2025</option>  
                    <option>April 2025</option>  
                    <option>Mei 2025</option>  
                    <option>Juni 2025</option>  
                    <option>Juli 2025</option>  
                    <option>Agustus 2025</option>  
                    <option>September 2025</option>  
                    <option>Oktober 2025</option>  
                    <option>November 2025</option>  
                    <option>Desember 2025</option>  
                </select>  

                <!-- Tombol Export Laporan -->  
                <button class="bg-blue-500 text-white font-semibold py-2 px-4 rounded-lg shadow hover:bg-blue-600"  
                    onclick="exportToCSV('laporan_produk.csv', 'productTable')">  
                    Export Laporan  
                </button>  
            </div>  
        </header>  

        <!-- Statistik Cards -->  
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">  
            <div class="bg-white shadow rounded-lg p-4 flex items-center">  
                <div class="text-blue-500 mr-4">  
                    <!-- Path diperbarui -->  
                    <img src="{{ asset('images/Cart.svg') }}" alt="Cart Icon" class="w-12 h-12">  
                </div>  
                <div>  
                    <p class="text-gray-500">Total Penjualan</p> 
                    <p class="text-xl font-semibold text-gray-900">Rp {{ number_format($totalPenjualan, 0, ',', '.') }}</p>
                </div>  
            </div>  
            <div class="bg-white shadow rounded-lg p-4 flex items-center">  
                <div class="text-indigo-500 mr-4">  
                    <!-- Path diperbarui -->  
                    <img src="{{ asset('images/Chart.svg') }}" alt="Chart Icon" class="w-12 h-12">  
                </div>  
                <div>  
                    <p class="text-gray-500">Total Margin</p>  
                    <p class="text-xl font-semibold text-gray-900">Rp {{ number_format($totalMargin, 0, ',', '.') }}</p>
                </div>  
            </div>  
            <div class="bg-white shadow rounded-lg p-4 flex items-center">  
                <div class="text-green-500 mr-4">  
                    <!-- Path diperbarui -->  
                    <img src="{{ asset('images/Wallet.svg') }}" alt="Cart Icon" class="w-12 h-12">  
                </div>  
                <div>  
                    <p class="text gray-500">Total Cashback</p>  
                    <p class="text-xl font-semibold text-gray-900">Rp {{ number_format($totalCashback, 0, ',', '.') }}</p>
                </div>  
            </div>  
            <div class="bg-white shadow rounded-lg p-4 flex items-center">  
                <div class="text-purple-500 mr-4">  
                    <!-- Path diperbarui -->  
                    <img src="{{ asset('images/ECoin.svg') }}" alt="Cart Icon" class="w-12 h-12">  
                </div>  
                <div>  
                    <p class="text-gray-500">Fee Aplikasi</p>  
                    <p class="text-xl font-semibold text-gray-900">Rp {{ number_format($feeAplikasi, 0, ',', '.') }}</p>
                </div>  
            </div>  
        </div>  

        <!-- Tabel Produk -->  
        <div class="bg-white shadow rounded-lg p-4 mb-6">  
            <div class="flex justify-between mb-4">  
                <input type="text" class="border rounded-lg p-2 w-full max-w-xs" placeholder="Cari Produk...">  
                <select class="border rounded-lg p-2 w-full max-w-xs">  
                    <option>Semua Kategori</option>  
                </select>  
            </div>  
            <table id="productTable" class="table-auto w-full text-left border-collapse">  
                <thead>  
                    <tr class="bg-gray-200">  
                        <th class="p-2 border">Produk</th>  
                        <th class="p-2 border">Kategori</th>  
                        <th class="p-2 border">Harga</th>  
                        <th class="p-2 border">Cashback</th>  
                        <th class="p-2 border">Margin</th>  
                        <th class="p-2 border">Berat</th>  
                    </tr>  
                </thead>  
                <tbody>  
                    @foreach($produk as $item)  
                    <tr>  
                        <td class="p-2 border">{{ $item->nama_produk }}</td>  
                        <td class="p-2 border">{{ $item->kategori }}</td>  
                        <td class="p-2 border">{{ $item->harga }}</td>  
                        <td class="p-2 border">{{ $item->komponen }}</td>  
                        <td class="p-2 border">{{ $item->margin }}</td>  
                        <td class="p-2 border">{{ $item->berat }} {{ $item->satuan_berat }}</td>  
                    </tr>  
                    @endforeach  
                </tbody>  
            </table>  
        </div>  

        <div class="bg-white shadow rounded-lg p-6 mb-6 border border-gray-300">  
            <h2 class="text-xl font-bold mb-6">Detail Cashback & Margin</h2>  

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">  
                <!-- Cashback Members -->  
                <div class="bg-white shadow rounded-lg p-4 border border-gray-300">  
                    <h2 class="text-lg font-bold mb-4">Cashback Members</h2>  
                    <table class="w-full">  
                        @foreach($produk as $item)  
                        <tr>  
                            <td class="p-2 border">{{ $item->komponen }}</td>  
                            <td class="p-2 border">{{ $item->harga }}</td>  
                        </tr>  
                        @endforeach  
                    </table>  
                </div>  

                <!-- Margin Distribution -->  
                <div class="bg-white shadow rounded-lg p-4 border border-gray-300">  
                    <h2 class="text-lg font-bold mb-4">Margin Distribution</h2>  
                    <table class="w-full">  
                    @foreach($produk as $item)  
                        <tr>  
                            <td class="p-2 border">{{ $item->margin }}</td>  
                        </tr>  
                        @endforeach 
                    </table>  
                </div>  

                <!-- Chart Section   -->
                <div class="bg-white shadow rounded-lg p-4" style="width: 400px; height: 350px;">
                <h2 class="text-lg font-bold mb-4">Pie Chart</h2>
                    <canvas id="marginChart"></canvas>
                </div>
            </div>  
        </div>  

        <!-- Tombol Kembali ke Dashboard -->  
        <div class="mt-6">  
            <a href="{{ route('dashboard') }}" class="bg-gray-500 text-white font-semibold py-2 px-4 rounded-lg shadow hover:bg-gray-600">  
                Kembali ke Dashboard  
            </a>  
        </div>  
    </div>  

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
        document.addEventListener("DOMContentLoaded", function () {
        var marginLabels = {!! json_encode($chartData['labels']) !!};
        var marginValues = {!! json_encode($chartData['data']) !!};

        console.log("Labels: ", marginLabels);
        console.log("Data: ", marginValues);

        var marginChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: marginLabels,
                datasets: [{
                    data: marginValues,
                    backgroundColor: ['#ff6384', '#36a2eb']
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        align: 'center',
                        labels: {
                            boxWidth: 20,
                            padding: 10
                        }
                    }
                }
            }
        });
    });
</script>


<canvas id="marginChart"></canvas>

    <script>  
        function exportToCSV(filename, tableId) {  
            var table = document.getElementById(tableId);  
            var csv = [];  

            // Loop untuk setiap baris dalam tabel  
            for (var i = 0; i < table.rows.length; i++) {  
                var row = [];  
                var cells = table.rows[i].cells;  

                // Loop untuk setiap sel dalam baris  
                for (var j = 0; j < cells.length; j++) {  
                    row.push(cells[j].innerText);  
                }  

                csv.push(row.join(","));  
            }  

            // Download file CSV  
            downloadCSV(filename, csv.join("\n"));  
        }  

        function downloadCSV(filename, csv) {  
            var csvFile;  
            var downloadLink;  

            // CSV file  
            csvFile = new Blob([csv], { type: "text/csv" });  

            // Download link  
            downloadLink = document.createElement("a");  

            // Nama file  
            downloadLink.download = filename;  

            // Membuat link ke file  
            downloadLink.href = window.URL.createObjectURL(csvFile);  

            // Menyembunyikan link  
            downloadLink.style.display = "none";  

            // Menambahkan link ke dokumen  
            document.body.appendChild(downloadLink);  

            // Klik link  
            downloadLink.click();  
        }  

        const ctx = document.getElementById('marginChart').getContext('2d');  
        new Chart(ctx, {  
            type: 'pie',  
            data: {  
                labels: ['Cashback', 'Promo', 'Manager', 'Toko'],  
                datasets: [{  
                    data: [250000, 300000, 500000, 800000],  
                    backgroundColor: ['#ff6384', '#36a2eb', '#ffce56', '#4bc0c0']  
                }]  
            },  
            options: {  
                responsive: true,  
                maintainAspectRatio: false,  
                aspectRatio: 1,  
                plugins: {  
                    legend: {  
                        position: 'bottom',  
                        align: 'center',  
                        labels: {  
                            boxWidth: 20,  
                            padding: 10  
                        }  
                    }  
                },  
                layout: {  
                    padding: {  
                        top: 20,  
                        bottom: 20  
                    }  
                }  
            }  
        });  

    </script>  

</body>  

</html>