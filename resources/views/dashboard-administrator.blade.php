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
    <div class="col">
        <div class="h-100">
            <div class="row mb-3 pb-1">
                <div class="col-12">
                    <div class="d-flex align-items-lg-center flex-lg-row flex-column">
                        <div class="flex-grow-1">
                            <h4 class="fs-16 mb-1">Hai {{ Auth::user()->name }}</h4>
                            <p class="text-muted mb-0">Berikut adalah ringkasan akun anda</p>
                        </div>
                        <div class="mt-3 mt-lg-0">
                            <form action="javascript:void(0);">
                                <div class="row g-3 mb-0 align-items-center justify-content-between">
                                    <div class="col-sm-auto">
                                       <script type='text/javascript'>
                                    var months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober',
                                        'November', 'Desember'
                                    ];
                                    var myDays = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jum&#39;at', 'Sabtu'];
                                    var date = new Date();
                                    var day = date.getDate();
                                    var month = date.getMonth();
                                    var thisDay = date.getDay(),
                                        thisDay = myDays[thisDay];
                                    var yy = date.getYear();
                                    var year = (yy < 1000) ? yy + 1900 : yy;
                                    document.write(thisDay + ', ' + day + ' ' + months[month] + ' ' + year);

                                    function updateRealTime() {
                                        var now = new Date();
                                        var hours = now.getHours().toString().padStart(2, '0');
                                        var minutes = now.getMinutes().toString().padStart(2, '0');
                                        var seconds = now.getSeconds().toString().padStart(2, '0');
                                        var timeString = hours + ':' + minutes + ':' + seconds;
                                        document.getElementById('realTime').textContent = timeString;
                                    }
                                    setInterval(updateRealTime, 1000);
                                    updateRealTime();
                                </script>
                                <br>
                                <h2 id="realTime" class="h2 text-dark">00:00:00</h2>
                                    </div>
                                    <!--end col-->
                                    {{-- <div class="col-auto">
                                        <button type="button" class="btn btn-soft-success"><i class="ri-add-circle-line align-middle me-1"></i>
                                            Add Product</button>
                                    </div> --}}
                                    <!--end col-->
                                    {{-- <div class="col-auto">
                                        <button type="button" class="btn btn-soft-info btn-icon waves-effect waves-light layout-rightside-btn"><i class="ri-pulse-line"></i></button>
                                    </div> --}}
                                    <!--end col-->
                                </div>
                                <!--end row-->
                            </form>
                        </div>
                    </div><!-- end card header -->
                </div>
                <!--end col-->
            </div>
            <!--end row-->

            <div class="row">
                <div class="col-xl-3 col-md-6">
                    <!-- card -->
                    <div class="card card-animate">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1 overflow-hidden">
                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                        Jumlah Pelanggan</p>
                                </div>
                                <div class="flex-shrink-0">
                                    {{-- <h5 class="text-success fs-14 mb-0">
                                        <i class="ri-arrow-right-up-line fs-13 align-middle"></i>
                                        +16.24 %
                                    </h5> --}}
                                </div>
                            </div>
                            <div class="d-flex align-items-end justify-content-between mt-4">
                                <div>
                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value" data-target="{{$customerCount}}"></span>
                                    </h4>
                                    {{-- <a href="" class="text-decoration-underline">View net
                                        earnings</a> --}}
                                </div>
                                <div class="avatar-sm flex-shrink-0">
                                    <span class="avatar-title bg-success-subtle rounded fs-3">
                                        <i class="bx bx-user text-success"></i>
                                    </span>
                                </div>
                            </div>
                        </div><!-- end card body -->
                    </div><!-- end card -->
                </div><!-- end col -->

                <div class="col-xl-3 col-md-6">
                    <!-- card -->
                    <div class="card card-animate">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1 overflow-hidden">
                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                        Gas Tekanan Rendah</p>
                                </div>
                                <div class="flex-shrink-0">
                                    {{-- <h5 class="text-danger fs-14 mb-0">
                                        <i class="ri-arrow-right-down-line fs-13 align-middle"></i>
                                        -3.57 %
                                    </h5> --}}
                                </div>
                            </div>
                            <div class="d-flex align-items-end justify-content-between mt-4">
                                <div>
                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value" data-target="">{{$lowPressureCount}}</span>
                                        {{-- <a href="" class="text-decoration-underline">View all orders</a> --}}
                                </div>
                                <div class="avatar-sm flex-shrink-0">
                                    <span class="avatar-title bg-info-subtle rounded fs-3">
                                        <i class="bx bx-gas-pump text-info"></i>
                                    </span>
                                </div>
                            </div>
                        </div><!-- end card body -->
                    </div><!-- end card -->
                </div><!-- end col -->

                <div class="col-xl-3 col-md-6">
                    <!-- card -->
                    <div class="card card-animate">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1 overflow-hidden">
                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                        Suhu Rendah</p>
                                </div>
                                <div class="flex-shrink-0">
                                    {{-- <h5 class="text-success fs-14 mb-0">
                                        <i class="ri-arrow-right-up-line fs-13 align-middle"></i>
                                        +29.08 %
                                    </h5> --}}
                                </div>
                            </div>
                            <div class="d-flex align-items-end justify-content-between mt-4">
                                <div>
                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value" data-target="">{{$lowTemperatureCount}}</span>
                                    </h4>
                                    <a href="" class="text-primary"></a>
                                </div>
                                <div class="avatar-sm flex-shrink-0">
                                    <span class="avatar-title bg-warning-subtle rounded fs-3">
                                        <i class="ri-thermometer-line text-primary"></i>
                                    </span>
                                </div>
                            </div>
                        </div><!-- end card body -->
                    </div><!-- end card -->
                </div><!-- end col -->   
            </div> <!-- end row-->
            
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title mb-0">Data Pelanggan</h4>
                        </div><!-- end card header -->
            
                        <div class="card-body">
                            <div class="listjs-table" id="customerList">
                                <div class="row g-4 mb-3">
                                    <div class="col-sm-auto">
                                        {{-- <div>
                                            <button type="button" class="btn btn-success add-btn" data-bs-toggle="modal" id="create-btn" onclick="window.location.href='{{ route('customer.create') }}'"><i class="ri-add-line align-bottom me-1"></i> Tambah</button>
                                            <button class="btn btn-soft-danger" onClick="deleteMultiple()"><i class="ri-delete-bin-2-line"></i></button>
                                        </div> --}}
                                    </div>
                                    <div class="col-sm">
                                        <div class="d-flex justify-content-sm-end">
                                            <div class="search-box ms-2">
                                                <input type="text" class="form-control search" placeholder="Search...">
                                                <i class="ri-search-line search-icon"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
            
                                <div class="table-responsive table-card mt-3 mb-1">
                                    <table class="table align-middle table-nowrap" id="customerTable">
                                        <thead class="table-light">
                                            <tr>
                                                
                                                <th class="long" data-sort="no">No</th>
                                                <th class="long" data-sort="customer_name">Nama</th>
                                                <th class="sort" data-sort="phone">Kapasitas</th>
                                                <th class="sort" data-sort="phone">Suhu</th>
                                                <th class="sort" data-sort="phone">Bar Tekanan</th>
                                                <th class="sort" data-sort="phone">Nilai Tekanan</th>
                                                <th class="sort" data-sort="status">Status</th>
                                                <th class="sort" data-sort="status">Update</th>
                                                <th class="sort" data-sort="action">Action</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody class="list form-check-all">
                                            <tr>
                                                
                                                @foreach($minpressuresensor as $index=>$status)
                                                <td>{{ $index + 1 }}</td>
                                                <td><a href="{{ route('detail-customer',$status->id) }}" class="text-success fw-bold">{{ $status->name }}</a></td>
                                                <td>{{ $status->capacity }} Bar</td>
                                                {{-- <td>{{ $status->district_name }}</td> --}}
                                                <td>{{ $status->temperature }}</td>
                                                <td><div class="progress">
                                                    <div class="progress-bar
                                                    @if($status->pressure < 20)
                                                        bg-danger
                                                    @elseif($status->pressure  >= 20 && $status->pressure  < 60)
                                                        bg-warning
                                                    @else
                                                        bg-success
                                                    @endif
                                                " role="progressbar" style="width: {{$status->pressure / 2 }}%" aria-valuenow="{{$status->pressure / 2 }}" aria-valuemin="0" aria-valuemax="200"></div>                            </div>
                                            </td>
                                                <td class="@if($status->pressure < 20)
                                                        text-danger
                                                    @elseif($status->pressure  >= 20 && $status->pressure  < 60)
                                                        text-warning
                                                    @else
                                                        text-success
                                                    @endif font-weight-bold">{{ $status->pressure }} Bar

                                                <td><label class="badge @if($status->pressure < 20)
                                                    bg-danger-subtle text-danger
                                                    @elseif($status->pressure  >= 20 && $status->pressure  < 60)
                                                        bg-warning-subtle text-warning
                                                    @else
                                                        bg-success-subtle text-success
                                                    @endif"> @if($status->pressure < 20)
                                                    Waktu Pengisian
                                                @elseif($status->pressure >= 20 && $status->pressure < 60)
                                                    Hampir Habis
                                                @else
                                                    Masih Penuh
                                                @endif</label></td></td>
                                                <td>{{ \Carbon\Carbon::parse($status->timestamp)->format('d-m-Y H:i') }}</td>
                                                <td>
                                                <div class="d-flex gap-2">

                                                <a href="https://api.whatsapp.com/send?phone={{ $status->telp }}" class="btn btn-sm btn-success me-1" target="_blank"><i class="ri-whatsapp-line"></i></a>
                                                
                                                <div class="edit">
                                                    <button class="btn btn-sm btn-primary insert-btn"
                                                    data-customer-id="{{ $status->id }}"
                                                    data-customer-name="{{ $status->name }}"
                                                    data-toggle="modal"
                                                    data-target="#insertModal">
                                                    Pengiriman
                                                </button>    </div></td>
                                                                                        </tr>
                                            @endforeach
                                            <div class="modal fade" id="insertModal" tabindex="-1" role="dialog" aria-labelledby="insertModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="insertModalLabel">Tambah Pengiriman</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form id="insertForm">
                                                                @csrf
                                                                <input type="hidden" name="customer_id" id="formCustomerId">
                                                                <div class="form-group">
                                                                    <label for="formCustomerName">Nama Customer</label>
                                                                    <input type="text" class="form-control" id="formCustomerName" name="customer_name" readonly>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="formDeliveryDate">Delivery Date</label>
                                                                    <input type="date" class="form-control" id="formDeliveryDate" name="delivery_date" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="formTotal">Total</label>
                                                                    <input type="number" class="form-control" id="formTotal" name="total" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="formStatus">Status</label>
                                                                    <select class="form-control" id="formStatus" name="status" required>
                                                                        <option value="Disiapkan">Diproses</option>
                                                                        <option value="Dalam Perjalanan">Dalam Perjalanan</option>
                                                                        <option value="Selesai">Selesai</option>
                                                                        <option value="Batal">Batal</option>
                                                                    </select>
                                                                </div>
                                                                <button type="submit" class="btn btn-primary">Tambah</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                                
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div class="noresult" style="display: none">
                                        <div class="text-center">
                                            <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop" colors="primary:#121331,secondary:#08a88a" style="width:75px;height:75px">
                                            </lord-icon>
                                            <h5 class="mt-2">Maaf</h5>
                                            <p class="text-muted mb-0">Data Kosong</p>
                                        </div>
                                    </div>
                                </div>
            
                                <div class="d-flex justify-content-end">
                                    <div class="pagination-wrap hstack gap-2">
                                        <a class="page-item pagination-prev disabled" href="javascript:void(0);">
                                            Previous
                                        </a>
                                        <ul class="pagination listjs-pagination mb-0"></ul>
                                        <a class="page-item pagination-next" href="javascript:void(0);">
                                            Next
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div><!-- end card -->
                    </div>
                    <!-- end col -->
                </div>
                <!-- end col -->
            </div> 
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
        </div>
    </div> <!-- end col -->
</div>
@endsection
@section('script')
<script>
    document.addEventListener('DOMContentLoaded', function () {
         $('.insert-btn').on('click', function () {
             var customerId = $(this).data('customer-id');
             var customerName = $(this).data('customer-name');
             $('#formCustomerName').val(customerName);
             $('#formCustomerId').val(customerId);
         });
         $('#insertForm').on('submit', function (e) {
             e.preventDefault();

             $.ajax({
                 url: '/api/insert-delivery',
                 method: 'POST',
                 data: $(this).serialize(),
                 success: function (response) {
                     if (response.success) {
                         $('#successAlert').show();
                         $('#errorAlert').hide();
                         $('#insertModal').modal('hide');
                     } else {
                         $('#errorAlert').show();
                         $('#successAlert').hide();
                     }
                 },
                 error: function (jqXHR) {
                     if (jqXHR.status === 422) {
                         var errors = jqXHR.responseJSON.errors;
                         var errorMessage = 'Validation errors:';
                         for (var field in errors) {
                             errorMessage += '\n' + field + ': ' + errors[field].join(', ');
                         }
                         $('#errorAlert').text(errorMessage).show();
                     } else {
                         $('#errorAlert').text('Failed to insert data.').show();
                     }
                     $('#successAlert').hide();
                 }
             });
         });
     });
</script>
<script>
    //   var datas =
    //         @foreach ($minpressuresensor as $key => $value)
    //             [{{ $value->location }},"{!! $value->name !!}"],
    //         @endforeach

    var dataArray= JSON.parse('{!!$minpressuresensor!!}', true);

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
                attribution: mbAttr
            }),
            dark = L.tileLayer(mbUrl, {
                id: 'mapbox/dark-v10',
                tileSize: 512,
                zoomOffset: -1,
                attribution: mbAttr
            }),
            streets = L.tileLayer(mbUrl, {
                id: 'mapbox/streets-v11',
                tileSize: 512,
                zoomOffset: -1,
                attribution: mbAttr
            });
// var map = L.map('map').setView([-37.82, 175.23], 13);
        var map = L.map('map', {

            center: [{{ $centrePoint->location }}],
            zoom: 5,
            layers: [streets]
        });
L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
  attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
}).addTo(map);

var markers = L.markerClusterGroup();

        @foreach ($minpressuresensor as $item)

                var marker = L.marker(new L.LatLng({{ $item->latitude }}, {{ $item->longitude }}));
  marker.bindPopup( "<div class='my-2'><br><strong>{{ $item->location }}</strong></div>" +
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

        //     center: [{{ $centrePoint->location }}],
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
        // @foreach ($minpressuresensor as $item)

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
        //     @foreach ($minpressuresensor as $item)
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
