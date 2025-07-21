@extends('layouts.app')
@section('title', 'Peta Menara')

@section('content')
<div class="container mt-4">
    <h3>Peta Lokasi Menara Saya</h3>
    <div id="map" style="height: 500px;" class="rounded shadow mt-3"></div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
@endpush

@push('scripts')
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@turf/turf@6/turf.min.js"></script>

<script>
    const map = L.map('map').setView([-6.55902, 106.79122], 11);

    // Basemap
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: 'Map &copy; OpenStreetMap contributors'
    }).addTo(map);

    // Custom Icon Menara
    const towerIcon = L.icon({
        iconUrl: 'https://cdn-icons-png.flaticon.com/512/684/684908.png',
        iconSize: [32, 32],
        iconAnchor: [16, 32],
        popupAnchor: [0, -30],
    });

    // Data Menara dari Laravel
    const menaras = @json($menaras);
    let bounds = [];

    menaras.forEach(m => {
        if (m.latitude && m.longitude) {
            const marker = L.marker([m.latitude, m.longitude], { icon: towerIcon }).addTo(map);
            marker.bindPopup(`
                <strong>${m.site_name}</strong><br>
                Site Code: ${m.site_code}<br>
                Koordinat: (${m.latitude}, ${m.longitude})<br>

            `);
            bounds.push([m.latitude, m.longitude]);
        }
    });

    // Fit peta ke semua titik
    if (bounds.length > 0) {
        map.fitBounds(bounds, { padding: [50, 50] });
    }

    // Layer GeoJSON Kecamatan
    const kecamatanLayer = L.geoJSON(null, {
        style: feature => ({
            color: feature.properties.warna || '#3388ff',
            weight: 1,
            fillOpacity: 0.2
        }),
        onEachFeature: (feature, layer) => {
            if (!feature.properties.kecamatan && feature.properties.Name) {
                feature.properties.kecamatan = feature.properties.Name;
            }
            layer.bindTooltip(feature.properties.kecamatan, {
                permanent: false,
                direction: 'center',
                className: 'bg-light text-dark px-2 rounded shadow-sm'
            });
        }
    }).addTo(map);

    // Tambah geojson setiap kecamatan
    @foreach($kecamatans as $kec)
        fetch("{{ asset('assets/kecamatan/' . $kec['geojson']) }}")
            .then(res => res.json())
            .then(data => {
                data.features.forEach(f => {
                    f.properties.kecamatan = f.properties.kecamatan || '{{ $kec['nama'] }}';
                    f.properties.warna = f.properties.warna || '{{ $kec['warna'] }}';
                });
                kecamatanLayer.addData(data);
            });
    @endforeach

    // Legend
    const legend = L.control({ position: "bottomright" });
    legend.onAdd = function () {
        const div = L.DomUtil.create("div", "info legend bg-white p-2 rounded shadow border");
        div.innerHTML = `
            <i style="background:url('https://cdn-icons-png.flaticon.com/512/684/684908.png') no-repeat center center; background-size: 16px 16px; width: 18px; height: 18px; display: inline-block;"></i> Lokasi Menara
        `;
        return div;
    };
    legend.addTo(map);
</script>
@endpush
