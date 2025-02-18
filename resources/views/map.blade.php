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
                <h4 class="card-title mb-0">Peta Customer</h4>
            </div><!-- end card header -->

            <div class="card-body">
<div id="map" class="leaflet-map"></div>
</div><!-- end card-body -->
</div><!-- end card -->
</div>
</div>
@section('script')
<!-- apexcharts -->
<script src="{{ URL::asset('build/libs/apexcharts/apexcharts.min.js') }}"></script>
<script src="{{ URL::asset('build/libs/jsvectormap/js/jsvectormap.min.js') }}"></script>
<script src="{{ URL::asset('build/libs/jsvectormap/maps/world-merc.js') }}"></script>
<script src="{{ URL::asset('build/libs/swiper/swiper-bundle.min.js')}}"></script>
<!-- dashboard init -->
<script src="{{ URL::asset('build/js/pages/dashboard-nft.init.js') }}"></script>
<script src="{{ URL::asset('build/js/pages/dashboard-ecommerce.init.js') }}"></script>
<script src="{{ URL::asset('build/js/app.js') }}"></script>
    <script>
    //   var datas =
    //         @foreach ($customers as $key => $value)
    //             [{{ $value->location }},"{!! $value->name !!}"],
    //         @endforeach

    var dataArray= JSON.parse('{!!$customers!!}', true);

    var addressPoints = [];
    dataArray.forEach(function(data) {
    var longitude = data.latitude;
    var latitude = data.longitude;
    var location = data.location.toString();

    // Menambahkan data ke dalam datas dalam format yang diinginkan
    addressPoints.push([latitude, longitude, location]);
    console.log(addressPoints);


});

// Sekarang datas akan berisi data dalam format yang Anda inginkan
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

            center: [{{ $centrePoint }}],
            zoom: 7,
            attribution: false,
            layers: [streets]
        });
L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png').addTo(map);
var iconMarker1 = L.icon({
            iconUrl: '{{ asset('build/iconMarkers/merah.png') }}',
            iconSize: [50, 50], // Ukuran ikon (lebar x tinggi)
            iconAnchor: [25, 50], // Titik anchor (biasanya di tengah bawah)
        })
        var iconMarker2 = L.icon({
            iconUrl: '{{ asset('build/iconMarkers/kuning.png') }}',
            iconSize: [50, 50], // Ukuran ikon (lebar x tinggi)
            iconAnchor: [25, 50], // Titik anchor (biasanya di tengah bawah)
        })
        var iconMarker3 = L.icon({
            iconUrl: '{{ asset('build/iconMarkers/hijau.png') }}',
            iconSize: [50, 50], // Ukuran ikon (lebar x tinggi)
            iconAnchor: [25, 50], // Titik anchor (biasanya di tengah bawah)
        })

var markers = L.markerClusterGroup();

        @foreach ($customers as $item)
        var iconMarker;
            if ({{ $item->pressure }} < 20) {
                iconMarker = iconMarker1;
            } else if ({{ $item->pressure }} >= 20 && {{ $item->pressure }} < 60) {
                iconMarker = iconMarker2;
            } else if ({{ $item->pressure }} >= 60) {
                iconMarker = iconMarker3;
            }
            
                var marker = L.marker([{{ $item->latitude }}, {{ $item->longitude }}], {
                    icon: iconMarker
                }).bindPopup( "<div class='my-2'><br><strong>{{ $item->location }}</strong></div>" +
  "<div class='my-2'>Tekanan :<br><strong>{{ $item->pressure }}</strong></div>" +
  "<div class='my-2'>Suhu :<br><strong>{{ $item->temperature }}</strong></div>" +
                    "<div><a href='{{ route('detail-customer',$item) }}' class='btn btn-outline-info btn-sm'>Detail Space</a></div>" +
                    "<div class='my-2'></div>");
  markers.addLayer(marker);
        @endforeach

// for (var i = 0; i < addressPoints.length; i++) {
//   var a = addressPoints[i];
//   var title = a[2];

// }

map.addLayer(markers);



        // var map = L.map('map', {

        //     center: [{{ $centrePoint }}],
        //     zoom: 5,
        //     layers: [streets]
        // });

        // var baseLayers = {
        //     "Grayscale": dark,
        //     "Satellite": satellite,
        //     "Streets": streets
        // };

        // var overlays = {
        //     "Streets": streets,
        //     "Grayscale": dark,
        //     "Satellite": satellite,
        // };
        // // Menampilkan popup data ketika marker di klik
        // @foreach ($customers as $item)

        //     L.marker([{{ $item->location }}])
        //         .bindPopup(
//        "<div class='my-2'><br><strong>{{ $item->location }}</strong></div>" +
//   "<div class='my-2'>Tekanan :<br><strong>{{ $item->pressure }}</strong></div>" +
//   "<div class='my-2'>Suhu :<br><strong>{{ $item->temperature }}</strong></div>" +
          //             "<div><a href='' class='btn btn-outline-info btn-sm'>Detail Space</a></div>" +
        //             "<div class='my-2'></div>"
        //         ).addTo(map);

        // @endforeach



        // // pada koding ini kita menambahkan control pencarian data
        // var markersLayer = new L.markerClusterGroup();
        // var controlSearch = new L.Control.Search({
        //     position: 'topleft',
        //     layer: markersLayer,
        //     initial: false,
        //     zoom: 17,
        //     markerLocation: true
        // })


        // //menambahkan variabel controlsearch pada addControl
        // map.addControl(controlSearch);

        // // looping variabel datas utuk menampilkan data space ketika melakukan pencarian data
        // for (i in datas) {

        //     var title = datas[i].title,
        //         loc = datas[i].loc,
        //         marker = new L.Marker(new L.latLng(loc), {
        //             title: title
        //         });
        //     markersLayer.addLayer(marker);

        //     // melakukan looping data untuk memunculkan popup dari space yang dipilih
        //     @foreach ($customers as $item)
        //         L.marker([{{ $item->location }}])
        //             .bindPopup("<div class='my-2'><br><strong>{{ $item->location }}</strong></div>" +
  //"<div class='my-2'>Tekanan :<br><strong>{{ $item->pressure }}</strong></div>" +
  //"<div class='my-2'>Suhu :<br><strong>{{ $item->temperature }}</strong></div>" +        //                 "<a href='' class='btn btn-outline-info btn-sm'>Detail Spot</a></div>" +
        //                 "<div class='my-2'></div>"
        //             ).addTo(map);
        //     @endforeach
        // }
        // L.control.layers(baseLayers, overlays).addTo(map);
    </script>
    @endsection
@endsection

