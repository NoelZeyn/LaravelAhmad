<head>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
</head>
<body>
    <div id="map" style="height: 500px;"></div>
    <script>
        var map = L.map('map').setView([-7.250445, 112.768845], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        fetch('/api/recycling-centers')
            .then(response => response.json())
            .then(data => {
                data.forEach(center => {
                    L.marker([center.latitude, center.longitude])
                        .addTo(map)
                        .bindPopup(`<b>${center.name}</b><br>${center.address}`);
                });
            });
    </script>
</body>
