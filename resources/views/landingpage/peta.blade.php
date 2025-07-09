@extends('landingpage.layouts.app')

@section('title', 'Peta Menara')

@section('content')
<div class="container-fluid mt-4">
    <div class="row">
        <!-- Form Koordinat -->
        <div class="col-lg-3 col-sm-12 mb-4" id="koordinat">
            <div class="card shadow-sm p-3">
                <h4 class="mb-3">Pilih Koordinat</h4>
                <p>Silahkan masukan koordinat lokasi menara, lalu klik di peta atau ubah manual di bawah ini.</p>
                <div class="form-group">
                    <label for="Latitude">Latitude:</label>
                    <input type="text" class="form-control" name="latitude" placeholder="contoh: -6.899253" id="Latitude">
                </div>
                <div class="form-group mt-3">
                    <label for="Longitude">Longitude:</label>
                    <input type="text" class="form-control" name="longitude" placeholder="contoh: 110.341364" id="Longitude">
                </div>

                <hr>
                <div>
                    <h5 class="mb-2">Wilayah Lokasi</h5>
                    <p><strong>Kecamatan:</strong> <span id="namaKecamatan">–</span></p>
                    <p><strong>Desa:</strong> <span id="namaDesa">–</span></p>
                </div>
            </div>
        </div>

        <!-- Peta -->
        <div class="col-lg-9 col-sm-12">
            <div class="card shadow-sm p-3">
                <h4 class="mb-3">Peta</h4>
                <p>Silahkan klik pada peta atau masukkan koordinat untuk melihat lokasi dan wilayah kecamatan yang dimaksud.</p>
                <div id="map" style="width: 100%; height: 500px;"></div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<!-- Leaflet & Turf -->
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" crossorigin=""></script>
<script src="https://cdn.jsdelivr.net/npm/@turf/turf@6/turf.min.js"></script>

<script>
    const map = L.map('map').setView([-6.55902, 106.79122], 11);

    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    const latInput = document.querySelector("[name=latitude]");
    const lngInput = document.querySelector("[name=longitude]");
    const namaKecamatan = document.getElementById("namaKecamatan");
    const namaDesa = document.getElementById("namaDesa");

    let marker = L.marker([-6.55902, 106.79122], { draggable: true }).addTo(map);

    marker.on('dragend', e => {
        const pos = marker.getLatLng();
        latInput.value = pos.lat.toFixed(6);
        lngInput.value = pos.lng.toFixed(6);
    });

    map.on("click", e => {
        const lat = e.latlng.lat.toFixed(6);
        const lng = e.latlng.lng.toFixed(6);
        marker.setLatLng(e.latlng);
        latInput.value = lat;
        lngInput.value = lng;

        let foundKecamatan = null;
        kecamatanLayer.eachLayer(layer => {
            if (turf.booleanPointInPolygon(
                turf.point([e.latlng.lng, e.latlng.lat]),
                layer.feature
            )) {
                foundKecamatan = layer.feature.properties.kecamatan;
            }
        });

        // (jika nanti kamu pakai desaLayer, kamu bisa isi foundDesa di sini)
        const foundDesa = null;

        namaKecamatan.textContent = foundKecamatan || '–';
        namaDesa.textContent = foundDesa || '–';

        const content = `
            <strong>Koordinat:</strong> ${lat}, ${lng}<br>
            <strong>Kecamatan:</strong> ${foundKecamatan || 'Tidak ditemukan'}
        `;
        L.popup().setLatLng(e.latlng).setContent(content).openOn(map);
    });

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

    @foreach($kecamatan as $kec)
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
