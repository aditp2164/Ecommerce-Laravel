<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blonjo Halal</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script>

            document.addEventListener("DOMContentLoaded", function () {
            document.querySelector('input[name="harga"]').addEventListener("input", hitungTotal);
            document.getElementById("tableBody").addEventListener("input", hitungTotal);
        });
        
        function hitungNominal(row) {
            let harga = parseFloat(document.querySelector('input[name="harga"]').value) || 0;
            let persentase = parseFloat(row.querySelector('input[name="persentase[]"]').value) || 0;
            let nominal = (harga * persentase / 100) + harga; // Hitung nominal: (harga * persentase/100) + harga
            row.querySelector('input[name="nominal[]"]').value = nominal.toFixed(2);
            hitungTotal(); // Panggil hitungTotal setelah setiap perubahan
        }

        function hitungTotal() {
        let hargaProduk = parseFloat(document.querySelector('input[name="harga"]').value) || 0;
        let totalPersentase = 0;
        let totalMargin = 0;
        let totalNominal = 0;

        document.querySelectorAll('#tableBody tr').forEach(row => {
            let persentaseInput = row.querySelector('input[name="persentase[]"]');
            let marginInput = row.querySelector('input[name="margin[]"]');
            let nominalInput = row.querySelector('input[name="nominal[]"]');

            let persentase = parseFloat(persentaseInput.value) || 0;
            let margin = parseFloat(marginInput.value) || 0;
            let nominal = hargaProduk * (1 + (persentase + margin) / 100);

            nominalInput.value = nominal.toFixed(2);

            totalPersentase += persentase;
            totalMargin += margin;
            totalNominal += nominal;
        });

            document.getElementById('totalPersentase').textContent = totalPersentase.toFixed(2);
            document.getElementById('totalMargin').textContent = totalMargin.toFixed(2);
            document.getElementById('totalNominal').textContent = totalNominal.toFixed(2);
        }

        function tambahKomponen() {
        let tableBody = document.getElementById("tableBody");
        let newRow = document.createElement("tr");

        newRow.innerHTML = `
            <td class="p-2 border">
                <input type="text" name="komponen[]" class="w-full p-2 border rounded-lg" required>
            </td>
            <td class="p-2 border">
                <input type="number" step="0.01" name="persentase[]" class="w-full p-2 border rounded-lg" required oninput="hitungTotal()">
            </td>
            <td class="p-2 border">
                <input type="number" step="0.01" name="margin[]" class="w-full p-2 border rounded-lg" required oninput="hitungTotal()">
            </td>
            <td class="p-2 border">
                <input type="number" step="0.01" name="nominal[]" class="w-full p-2 border rounded-lg" required readonly>
            </td>
        `;

        tableBody.appendChild(newRow);
    }


        function exportData() {
            window.location.href = "{{ route('produk.export') }}";
        }

        function printPage() {
            window.print();
        }
    </script>
</head>

<body class="bg-white-100 font-sans">
    <div class="container mx-auto p-4">
        <header class="mb-6">
            <h1 class="text-3xl font-bold">Blonjo Halal</h1>
            <p class="text-gray-500">Dashboard Detail Produk & Perhitungan</p>
        </header>
        <div class="bg-white shadow rounded-lg p-4 mb-6">
            <form action="{{ route('produk.store') }}" method="POST">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div> 
                    <label class="block text-gray-700">Nama Produk</label>
                        <input type="text" name="nama_produk" class="w-full p-2 border rounded-lg"
                            placeholder="Masukkan Nama Produk" required>
                    </div>
                    <div>
                        <label class="block text-gray-700">Kategori Produk</label>
                        <select name="kategori" class="w-full p-2 border rounded-lg" required>
                            <option value="makanan">Makanan</option>
                            <option value="elektronik">Elektronik</option>
                            <option value="alat rumah tangga">Alat Rumah Tangga</option>
                            <option value="baju">Baju</option>
                            <option value="sepatu">Sepatu</option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label class="block text-gray-700">Satuan Berat</label>
                        <select name="satuan_berat" class="w-full p-2 border rounded-lg" required>
                            <option value="mg">Miligram</option>
                            <option value="cg">Sentigram</option>
                            <option value="gram">Gram</option>
                            <option value="kg">Kilogram</option>
                            <option value="kintal">Kintal</option>
                            <option value="ton">Ton</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-gray-700">Berat</label>
                        <input type="number" step="0.01" name="berat" class="w-full p-2 border rounded-lg" value="0"
                            required>
                    </div>
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700">Deskripsi Produk</label>
                    <textarea name="deskripsi" class="w-full p-2 border rounded-lg"
                        placeholder="Masukkan Deskripsi Produk"></textarea>
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700">Harga Produk</label>
                    <input type="number" step="0.01" name="harga" class="w-full p-2 border rounded-lg"
                        placeholder="Masukkan Harga Produk" required oninput="hitungTotal()">
                </div>

                <table id="komponenTable" class="w-full border-collapse border border-gray-300 mb-6">
            <thead>
                <tr class="bg-gray-200">
                    <th class="p-2 border">Komponen</th>
                    <th class="p-2 border">Persentase (%)</th>
                    <th class="p-2 border">Margin (%)</th>
                    <th class="p-2 border">Nominal (Rp)</th>
                </tr>
            </thead>
            <tbody id="tableBody">
                <tr>
                    <td class="p-2 border">
                        <input type="text" name="komponen[]" class="w-full p-2 border rounded-lg" required>
                    </td>
                    <td class="p-2 border">
                        <input type="number" step="0.01" name="persentase[]" class="w-full p-2 border rounded-lg" required oninput="hitungTotal()">
                    </td>
                    <td class="p-2 border">
                        <input type="number" step="0.01" name="margin[]" class="w-full p-2 border rounded-lg" required oninput="hitungTotal()">
                    </td>
                    <td class="p-2 border">
                        <input type="number" step="0.01" name="nominal[]" class="w-full p-2 border rounded-lg" required readonly>
                    </td>
                </tr>
            </tbody>
            <tfoot>
                <tr class="bg-gray-100">
                    <td class="p-2 border font-bold">Total</td>
                    <td class="p-2 border font-bold" id="totalPersentase">0</td>
                    <td class="p-2 border font-bold" id="totalMargin">0</td>
                    <td class="p-2 border font-bold" id="totalNominal">0</td>
                </tr>
            </tfoot>
        </table>


                <button type="button" onclick="tambahKomponen()"
                    class="flex items-center space-x-2 bg-green-500 text-white px-4 py-2 rounded-lg shadow hover:bg-green-600 mb-6">
                    <i class="fas fa-plus"></i>
                    <span>Tambah Komponen</span>
                </button>

                <div class="flex space-x-4">
                    <button type="submit"
                        class="flex items-center space-x-2 bg-black text-white px-4 py-2 rounded-lg shadow hover:bg-gray-800">
                        <i class="fas fa-save"></i>
                        <span>Simpan</span>
                    </button>
                    <button type="reset"
                        class="flex items-center space-x-2 bg-gray-300 px-4 py-2 rounded-lg shadow hover:bg-gray-400">
                        <i class="fas fa-sync-alt"></i>
                        <span>Reset</span>
                    </button>
                    <button type="button" onclick="exportData()"
                        class="flex items-center space-x-2 bg-gray-300 px-4 py-2 rounded-lg shadow hover:bg-gray-400">
                        <i class="fas fa-file-export"></i>
                        <span>Ekspor</span>
                    </button>
                    <button type="button" onclick="printPage()"
                        class="flex items-center space-x-2 bg-gray-300 px-4 py-2 rounded-lg shadow hover:bg-gray-400">
                        <i class="fas fa-print"></i>
                        <span>Cetak</span>
                    </button>
                    <a href="{{ route('dashboard') }}"
                        class="flex items-center space-x-2 bg-gray-300 px-4 py-2 rounded-lg shadow hover:bg-gray-400">
                        <i class="fas fa-arrow-left"></i>
                        <span>Kembali</span>
                    </a>
                </div>
            </form>
        </div>

    </div>
</body>

</html>
                        