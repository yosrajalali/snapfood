<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>جستجوی رستوران‌های نزدیک</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.2/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        #map { width: 100%; height: 400px; }
    </style>
</head>
<body class="bg-gray-200">
<div class="container mx-auto px-4 py-6">
    <h1 class="text-4xl font-bold text-center text-gray-800 mb-5">جستجوی رستوران‌های نزدیک</h1>
    <div class="mb-4">
        <label for="city" class="block text-gray-700">شهر خود را انتخاب کنید:</label>
        <select id="city" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm">
            <option value="" disabled selected>انتخاب شهر</option>

        </select>
    </div>
    <div id="map"></div>
    <form id="locationForm" method="POST" action="{{ route('search-restaurants') }}">
        @csrf
        <input type="hidden" name="latitude" id="latitude">
        <input type="hidden" name="longitude" id="longitude">
        <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded mt-4">جستجوی رستوران‌های نزدیک</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        $('#city').select2();

        var map = L.map('map').setView([35.6892, 51.3890], 12);
        var marker = L.marker([35.6892, 51.3890], { draggable: true }).addTo(map);
        var updating = false;

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        function updateMarker(lat, lon, updateMap = true) {
            if (updating) return;
            updating = true;
            marker.setLatLng([lat, lon]);
            if (updateMap) {
                map.setView([lat, lon], 12);
            }
            document.getElementById('latitude').value = lat;
            document.getElementById('longitude').value = lon;
            setTimeout(() => updating = false, 200); // To prevent infinite loop
        }

        $('#city').on('change', function () {
            var selectedOption = $(this).find('option:selected');
            var lat = parseFloat(selectedOption.data('lat'));
            var lon = parseFloat(selectedOption.data('lon'));
            console.log('Selected city:', selectedOption.text());
            console.log('Coordinates:', lat, lon);
            if (!isNaN(lat) && !isNaN(lon)) {
                updateMarker(lat, lon);
            } else {
                console.error('Invalid coordinates for the selected city.');
                alert('مختصات معتبر برای شهر انتخاب شده وجود ندارد.');
            }
            $(this).select2('close');
        });

        map.on('moveend', function () {
            if (updating) return;
            var center = map.getCenter();
            updateMarker(center.lat, center.lng, false);
        });

        marker.on('dragend', function () {
            var latLng = marker.getLatLng();
            updateMarker(latLng.lat, latLng.lng, false);
        });

        fetchCities();

        async function fetchCities() {
            try {
                const response = await fetch('https://iran-locations-api.ir/api/v1/fa/cities');
                const data = await response.json();
                console.log('Fetched cities:', data);
                const citySelect = $('#city');
                data.forEach(city => {
                    if (city.latitude && city.longitude) {
                        const option = $('<option></option>')
                            .val(city.name)
                            .data('lat', city.latitude)
                            .data('lon', city.longitude)
                            .text(city.name);
                        citySelect.append(option);
                    } else {
                        console.error('Invalid coordinates for city:', city.name);
                    }
                });
            } catch (error) {
                console.error('Error fetching cities:', error);
            }
        }
    });
</script>
</body>
</html>
