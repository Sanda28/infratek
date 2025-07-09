@extends('layouts.app')
@section('title', 'Peta Menara')

@section('content')
<div class="container mt-4">
    <h3>Peta Menara Berdasarkan Kecamatan</h3>

    <form method="GET" class="mb-3">
        <div class="row g-2">
            <div class="col-md-4">
                <select name="kecamatan_id" class="form-control" onchange="this.form.submit()">
                    @foreach($kecamatans as $kec)
                        <option value="{{ $kec->id }}" {{ $selected == $kec->id ? 'selected' : '' }}>{{ $kec->nama }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </form>

    <div id="map" style="height: 500px;" class="rounded shadow"></div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
@endpush

@push('scripts')
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script>
    const map = L.map('map').setView([-6.55902, 106.79122], 11);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: 'Map &copy; OpenStreetMap contributors'
    }).addTo(map);

    const towerIcon = L.icon({
        iconUrl: 'https://cdn-icons-png.flaticon.com/512/684/684908.png',
        iconSize: [32, 32],
        iconAnchor: [16, 32],
        popupAnchor: [0, -30],
    });

    const menaras = @json($menaras);
    let bounds = [];

    menaras.forEach(m => {
        if (m.latitude && m.longitude) {
            const marker = L.marker([m.latitude, m.longitude], { icon: towerIcon }).addTo(map);
            marker.bindPopup(`
                <strong>${m.site_name}</strong><br>
                Site Code: ${m.site_code}<br>
                Koordinat: (${m.latitude}, ${m.longitude})
            `);
            bounds.push([m.latitude, m.longitude]);
        }
    });

    if (bounds.length > 0) {
        map.fitBounds(bounds, { padding: [50, 50] });
    }
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
</script>
@endpush
