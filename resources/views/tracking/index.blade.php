@extends('layouts.master')
@section('title') @lang('translation.dashboards') @endsection
@section('css')
<link href="{{ URL::asset('build/libs/jsvectormap/css/jsvectormap.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('build/libs/swiper/swiper-bundle.min.css')}}" rel="stylesheet" type="text/css" />
<link href="http://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
<link rel="stylesheet" href="http://unpkg.com/leaflet@1.3.1/dist/leaflet.css" integrity="sha512-Rksm5RenBEKSKFjgI3a41vrjkw4EVPlJ3+OiI65vTjIdo9brlAacEuKOiQ5OFh7cOI1bkDwLqdLw3Zg0cRJAAQ==" crossorigin="" />
<link rel="stylesheet" href="http://unpkg.com/leaflet.markercluster@1.3.0/dist/MarkerCluster.css" />
<link rel="stylesheet" href="http://unpkg.com/leaflet.markercluster@1.3.0/dist/MarkerCluster.Default.css" />
<script src="http://unpkg.com/leaflet@1.3.1/dist/leaflet.js" integrity="sha512-/Nsx9X4HebavoBvEBuyp3I7od5tA0UzAxs+j83KgC8PU0kgB4XiK4Lfe4y4cgBtaRJQEIFCW+oC506aPT2L1zw==" crossorigin=""></script>
<script src="http://unpkg.com/leaflet.markercluster@1.3.0/dist/leaflet.markercluster.js"></script>
<link rel="stylesheet" href=" http://cdnjs.cloudflare.com/ajax/libs/leaflet-search/3.0.9/leaflet-search.min.css">
<script src="http://cdnjs.cloudflare.com/ajax/libs/leaflet-search/3.0.9/leaflet-search.src.js"></script>

@endsection
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Tracking Kendaraan</h4>
            </div><!-- end card header -->

            <div class="card-body">
<div id="map" class="leaflet-map"></div>
</div><!-- end card-body -->
</div><!-- end card -->
</div>
</div>
    @endsection
    @section('script')
    {{-- load jquery dan jquery datatable --}}
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

    <script>
        // Inisialisasi Peta
        var mbAttr = 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, ' +
            'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
            mbUrl =
            'https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoiYWl5b3RoaW5ncyIsImEiOiJjbHg5dzl3bnowdmdsMnZwenNxNTgzbzI3In0.bvzwvgTp1oDlxOBRnb3lRg';

        var satellite = L.tileLayer(mbUrl, {
                id: 'mapbox/satellite-v9',
                tileSize: 512,
                zoomOffset: -1,
                attribution: false
            }),
            dark = L.tileLayer(mbUrl, {
                id: 'mapbox/dark-v10',
                tileSize: 512,
                zoomOffset: -1,
                attribution: false
            }),
            streets = L.tileLayer(mbUrl, {
                id: 'mapbox/streets-v11',
                tileSize: 512,
                zoomOffset: -1,
                attribution: false
            });
// var map = L.map('map').setView([-37.82, 175.23], 13);
        var map = L.map('map', {

            center: [{{ $centrepoint->location }}],
            zoom: 10,
            attribution: false,
            layers: [streets]
        });
L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png').addTo(map);
var iconMarker1 = L.icon({
            iconUrl: '{{ asset('build/iconMarkers/truk.png') }}',
            iconSize: [50, 50], // Ukuran ikon (lebar x tinggi)
            iconAnchor: [25, 50], // Titik anchor (biasanya di tengah bawah)
        })
        var iconMarker2 = L.icon({
            iconUrl: '{{ asset('build/iconMarkers/btruk.png') }}',
            iconSize: [50, 50], // Ukuran ikon (lebar x tinggi)
            iconAnchor: [25, 50], // Titik anchor (biasanya di tengah bawah)
        })
       
var markers = L.markerClusterGroup();

@foreach ($minpressuresensor as $item)
        var iconMarker;            
            if ("{{ $item->tipe_kendaraan }}" === "truk") {
                iconMarker = iconMarker1;
            } else if ("{{ $item->tipe_kendaraan }}" === "btruk") {
                iconMarker = iconMarker2;
            } 
            
                var marker = L.marker([{{ $item->latitude }}, {{ $item->longitude }}], {
                    icon: iconMarker
                }).bindPopup(  "<div class='my-2'><br><strong>{{ $item->plat_nomor }}</strong></div>" +
  "<div class='my-2'>Tekanan :<br><strong>{{ $item->pressure }} Bar</strong></div>" +
                    "<div><a href='{{ route('detail-kendaraan',$item) }}' class='btn btn-outline-info btn-sm'>Detail Kendaraan</a></div>" +
                    "<div class='my-2'></div>");
  markers.addLayer(marker);
        @endforeach

map.addLayer(markers);
        // var map3 = L.map('map3').setView([-7.93, 112.61], 13); // Sesuaikan koordinat awal
    
        // // Tambahkan Layer Peta dari OpenStreetMap
        // L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        //     attribution: '&copy; OpenStreetMap contributors'
        // }).addTo(map3);
    
        // var trackPath = [];
        //     var polyline = L.polyline(trackPath, { color: 'blue' }).addTo(map3);
        //     var vehicleMarker = L.marker([-7.9301234, 112.6105678]).addTo(map3)
        //         .bindPopup("Kendaraan")
        //         .openPopup();
    
        //     function fetchTrackingData() {
        //         $.getJSON('/api/tracking/latest', function(data) {
        //             if (data.length > 0) {
        //                 let latest = data[0];
        //                 let latLng = [latest.latitude, latest.longitude];
    
        //                 vehicleMarker.setLatLng(latLng);
        //                 trackPath.push(latLng);
        //                 polyline.setLatLngs(trackPath);
        //                 map3.panTo(latLng);
        //             }
        //         });
        //     }
    
        //     setInterval(fetchTrackingData, 5000); // Update tiap 5 detik
    </script>

<!-- apexcharts -->
<script src="{{ URL::asset('build/libs/apexcharts/apexcharts.min.js') }}"></script>
<script src="{{ URL::asset('build/libs/jsvectormap/js/jsvectormap.min.js') }}"></script>
<script src="{{ URL::asset('build/libs/jsvectormap/maps/world-merc.js') }}"></script>
<script src="{{ URL::asset('build/libs/swiper/swiper-bundle.min.js')}}"></script>
<!-- dashboard init -->
<script src="{{ URL::asset('build/js/pages/dashboard-nft.init.js') }}"></script>
<script src="{{ URL::asset('build/js/pages/dashboard-ecommerce.init.js') }}"></script>
<script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
