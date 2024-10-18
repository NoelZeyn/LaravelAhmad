<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recycling Centers</title>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/@tensorflow/tfjs"></script>
<script src="https://cdn.jsdelivr.net/npm/@tensorflow-models/coco-ssd"></script>

</head>
<body class="bg-gray-900 text-gray-100 font-sans antialiased">
    @include('layouts.navigation')
    <div class="py-12 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold mb-4">Bank Sampah</h1>

        <div class="bg-gray-800 p-4 rounded shadow-md ">
            <h2 class="text-xl font-semibold mb-4">Tambah Bank Sampah</h2>

            <form id="add-center-form" class="space-y-4">
                <div>
                    <label class="block text-gray-300">Nama</label>
                    <input type="text" id="name" class="w-full px-3 py-2 border rounded bg-gray-700 text-gray-100" required>
                </div>

                <div>
                    <label class="block text-gray-300">Alamat</label>
                    <input type="text" id="address" class="w-full px-3 py-2 border rounded bg-gray-700 text-gray-100" required>
                </div>

                <div class="flex space-x-4">
                    <div class="w-1/2">
                        <label class="block text-gray-300">Latitude</label>
                        <input type="number" step="any" id="latitude" class="w-full px-3 py-2 border rounded bg-gray-700 text-gray-100" required>
                    </div>

                    <div class="w-1/2">
                        <label class="block text-gray-300">Longitude</label>
                        <input type="number" step="any" id="longitude" class="w-full px-3 py-2 border rounded bg-gray-700 text-gray-100" required>
                    </div>
                </div>

                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Tambah</button>
            </form>
        </div>

        <div class="bg-gray-800 mt-6 p-4 rounded shadow-md">
            <h2 class="text-xl font-semibold mb-4">Daftar Bank Sampah</h2>

            <table class="w-full text-left table-auto">
                <thead>
                    <tr class="text-gray-300">
                        <th class="px-4 py-2">Nama</th>
                        <th class="px-4 py-2">Alamat</th>
                        <th class="px-4 py-2">Latitude</th>
                        <th class="px-4 py-2">Longitude</th>
                        <th class="px-4 py-2">Aksi</th>
                    </tr>
                </thead>
                <tbody id="center-list" class="text-gray-100">
                    <!-- Data akan dimasukkan di sini oleh JavaScript -->
                </tbody>
            </table>
        </div>
    </div>

    <script>
        document.getElementById('add-center-form').addEventListener('submit', function(event) {
            event.preventDefault();

            axios.post('/api/recycling-centers', {
                name: document.getElementById('name').value,
                address: document.getElementById('address').value,
                latitude: document.getElementById('latitude').value,
                longitude: document.getElementById('longitude').value
            }).then(function (response) {
                alert('Bank sampah berhasil ditambahkan!');
                loadCenters();
            }).catch(function (error) {
                alert('Terjadi kesalahan: ' + error.response.data.message);
            });
        });

        function loadCenters() {
            axios.get('/api/recycling-centers')
                .then(function(response) {
                    var centers = response.data;
                    var tbody = document.getElementById('center-list');
                    tbody.innerHTML = ''; // Clear table

                    centers.forEach(function(center) {
                        var row = '<tr>' +
                                    '<td class="border px-4 py-2">' + center.name + '</td>' +
                                    '<td class="border px-4 py-2">' + center.address + '</td>' +
                                    '<td class="border px-4 py-2">' + center.latitude + '</td>' +
                                    '<td class="border px-4 py-2">' + center.longitude + '</td>' +
                                    '<td class="border px-4 py-2">' +
                                        '<button class="bg-red-500 text-white px-2 py-1 rounded" onclick="deleteCenter(' + center.id + ')">Hapus</button>' +
                                    '</td>' +
                                  '</tr>';
                        tbody.innerHTML += row;
                    });
                });
        }

        function deleteCenter(id) {
            axios.delete('/api/recycling-centers/' + id)
                .then(function(response) {
                    alert('Bank sampah berhasil dihapus!');
                    loadCenters();
                }).catch(function (error) {
                    alert('Terjadi kesalahan: ' + error.response.data.message);
                });
        }

        // Load centers when the page loads
        loadCenters();
    </script>
</body>
</html>
