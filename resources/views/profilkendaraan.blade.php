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
<div class="profile-foreground position-relative mx-n4 mt-n4">
    <div class="profile-wid-bg">
        <img src="{{ URL::asset('build/images/banner3.jpg') }}" alt="" class="profile-wid-img" />
    </div>
</div>
<div class="pt-4 mb-4 mb-lg-3 pb-lg-4 profile-wrapper">
    <div class="row g-4">
        <div class="col-auto">
            <div class="avatar-lg">
                <img src="@if (Auth::user()->avatar != '') {{ URL::asset('images/' . Auth::user()->avatar) }}@else{{ URL::asset('build/images/users/avatar-1.jpg') }} @endif"
                    alt="user-img" class="img-thumbnail rounded-circle" />
            </div>
        </div>
        <!--end col-->
        <div class="col">
            <div class="p-2">
                <h3 class="text-white mb-1">{{$kendaraan->plat_nomor}}</h3>
                <p class="text-white text-opacity-75">{{$kendaraan->tipe_kendaraan}}</p>
                <div class="hstack text-white-50 gap-1">
                    <div class="me-2"><i
                            class="ri-map-pin-line me-1 text-white text-opacity-75 fs-16 align-middle"></i>{{$lokasi['kecamatan']}} - {{$lokasi['kabupaten']}}</div>
                    <div><i class="ri-time-line me-1 text-white text-opacity-75 fs-16 align-middle"></i>{{$dataSensor->timestamp}}
                    </div>
                </div>
            </div>
        </div>
        <!--end col-->
        {{-- <div class="col-12 col-lg-auto order-last order-lg-0">
            <div class="row text text-white-50 text-center">
                <div class="col-lg-6 col-4">
                    <div class="p-2">
                        <h4 class="text-white mb-1">24.3K</h4>
                        <p class="fs-14 mb-0">Followers</p>
                    </div>
                </div>
                <div class="col-lg-6 col-4">
                    <div class="p-2">
                        <h4 class="text-white mb-1">1.3K</h4>
                        <p class="fs-14 mb-0">Following</p>
                    </div>
                </div>
            </div>
        </div> --}}
        <!--end col-->

    </div>
    <!--end row-->
</div>
<div class="row">
    
    <div class="row">
        <div class="col-xl-4 col-md-6">
            <!-- card -->
            <div class="card card-animate">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1 overflow-hidden">
                            <p class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                Kapasitas Tabung</p>
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
                            <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value" data-target="{{ $capacity }}">0</span> Bar
                            </h4>
                            {{-- <a href="" class="text-decoration-underline">View net
                                earnings</a> --}}
                        </div>
                        <div class="avatar-sm flex-shrink-0">
                            <span class="avatar-title bg-success-subtle rounded fs-3">
                                <i class="bx bx-cylinder text-success"></i>
                            </span>
                        </div>
                    </div>
                </div><!-- end card body -->
            </div><!-- end card -->
        </div><!-- end col -->

        {{-- <div class="col-xl-3 col-md-6">
            <!-- card -->
            <div class="card card-animate">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1 overflow-hidden">
                            <p class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                Tanggal Bergabung</p>
                        </div>
                        <div class="flex-shrink-0">
                            {{-- <h5 class="text-danger fs-14 mb-0">
                                <i class="ri-arrow-right-down-line fs-13 align-middle"></i>
                                -3.57 %
                            </h5>
                        </div>
                    </div>
                    <div class="d-flex align-items-end justify-content-between mt-4">
                        <div>
                            <h4 class="fs-18 fw-semibold ff-secondary mb-4"><span>{{ \Carbon\Carbon::parse($registration_date_device)->isoFormat('D MMMM Y') }}</span></h4>
                            {{-- <a href="" class="text-decoration-underline">View all orders</a>
                        </div>
                        <div class="avatar-sm flex-shrink-0">
                            <span class="avatar-title bg-info-subtle rounded fs-3">
                                <i class="bx bx-calendar text-info"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}

        <div class="col-xl-4 col-md-6">
            <!-- card -->
            <div class="card card-animate">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1 overflow-hidden">
                            <p class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                Tekanan Gas</p>
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
                            <h4 class="fs-22 fw-semibold ff-secondary mb-2"><span class="counter-value" data-target="{{$latestPressure}}"></span> Bar
                            </h4>
                            <a href="" class="text-primary">{{ \Carbon\Carbon::parse($latestTime)->isoFormat('D MMMM YYYY, HH:mm') }}</a>
                        </div>
                        <div class="avatar-sm flex-shrink-0">
                            <span class="avatar-title bg-warning-subtle rounded fs-3">
                                <i class="ri-gas-station-line text-warning"></i>
                            </span>
                        </div>
                    </div>
                </div><!-- end card body -->
            </div><!-- end card -->
        </div><!-- end col -->

        {{-- <div class="col-xl-3 col-md-6">
            <!-- card -->
            <div class="card card-animate">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1 overflow-hidden">
                            <p class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                Suhu</p>
                        </div>
                        <div class="flex-shrink-0">
                           <h5 class="text-muted fs-14 mb-0">
                                +0.00 %
                            </h5>
                        </div>
                    </div>
                    <div class="d-flex align-items-end justify-content-between mt-4">
                        <div>
                            <h4 class="fs-22 fw-semibold ff-secondary mb-2"><span class="counter-value" data-target="{{$latestTemperature}}"></span> °C
                            </h4>
                            <a href="" class="text-primary">{{ \Carbon\Carbon::parse($latestTime)->isoFormat('D MMMM YYYY, HH:mm') }}</a>
                       </div>
                        <div class="avatar-sm flex-shrink-0">
                            <span class="avatar-title bg-primary-subtle rounded fs-3">
                                <i class="ri-thermometer-line text-primary"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
    </div> <!-- end row-->

    <div class="row">
        <div class="col-xl-6">
            <div class="card">
                <div class="card-header border-0 align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Riwayat Tekanan</h4>
                    <div class="btn-group">
                        <button type="button" onclick="updateChart('1d', this)" class="btn btn-soft-secondary btn-sm active">
                            1D
                        </button>
                        <button type="button" onclick="updateChart('1y', this)" class="btn btn-soft-secondary btn-sm">
                            Y
                        </button>
                        <button type="button" onclick="updateChart('1w', this)" class="btn btn-soft-secondary btn-sm">
                            1W
                        </button>
                        <button type="button" onclick="updateChart('1m', this)" class="btn btn-soft-secondary btn-sm">
                            1M
                        </button>
                        <button type="button" onclick="updateChart('6y', this)" class="btn btn-soft-secondary btn-sm">
                            6M
                        </button>
                    </div>
                </div><!-- end card header -->

                {{-- <div class="card-header p-0 border-0 bg-light-subtle">
                    <div class="row g-0 text-center">
                        <div class="col-6 col-sm-3">
                            <div class="p-3 border border-dashed border-start-0">
                                <h5 class="mb-1"><span class="counter-value" data-target="7585">0</span></h5>
                                <p class="text-muted mb-0">Orders</p>
                            </div>
                        </div>
                        <!--end col-->
                        <div class="col-6 col-sm-3">
                            <div class="p-3 border border-dashed border-start-0">
                                <h5 class="mb-1">$<span class="counter-value" data-target="22.89">0</span>k</h5>
                                <p class="text-muted mb-0">Earnings</p>
                            </div>
                        </div>
                        <!--end col-->
                        <div class="col-6 col-sm-3">
                            <div class="p-3 border border-dashed border-start-0">
                                <h5 class="mb-1"><span class="counter-value" data-target="367">0</span></h5>
                                <p class="text-muted mb-0">Refunds</p>
                            </div>
                        </div>
                        <!--end col-->
                        <div class="col-6 col-sm-3">
                            <div class="p-3 border border-dashed border-start-0 border-end-0">
                                <h5 class="mb-1 text-success"><span class="counter-value" data-target="18.92">0</span>%</h5>
                                <p class="text-muted mb-0">Conversation Ratio</p>
                            </div>
                        </div>
                        <!--end col-->
                    </div>
                </div><!-- end card header --> --}}

                <div class="card-body p-0 pb-2">
                    <div class="w-100">
                        <div id="pressure_chart" data-colors='["--vz-primary"]' class="apex-charts" dir="ltr"></div>
                    </div>
                </div><!-- end card body -->
            </div><!-- end card -->
        </div><!-- end col -->

        <div class="col-xl-6">
            
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Riwayat Pengiriman</h4>
                        <div class="flex-shrink-0">
                            <button type="button" class="btn btn-soft-info btn-sm">
                                {{-- <i class="ri-file-list-3-line align-middle"></i> Generate Report --}}
                            </button>
                        </div>
                    </div><!-- end card header -->
                    <div class="card-body">
                        <div class="table-responsive table-card">
                            <table class="table table-borderless table-centered align-middle table-nowrap mb-0">
                                <thead class="text-muted table-light">
                                    <tr>
                                        <th>No</th>
                                        <th>Lokasi</th>
                                        <th>Jumlah</th>
                                    <th>Tanggal</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($statuses as $index => $status)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $status->location }}</td>
                                        <td>{{ $status->total }} Bar</td>
                                        <td>{{ \Carbon\Carbon::parse($status->delivery_date)->translatedFormat('d F Y') }}
                                        </td>
                                        <td><label
                                                class="badge
     @if ($status->status == 'Selesai') bg-success-subtle text-success
    @elseif($status->status == 'Dalam Perjalanan')
        bg-warning-subtle text-warning
    @elseif($status->status == 'Batal')
        bg-danger-subtle text-danger
    @elseif($status->status == 'Disiapkan')
        bg-success-info text-info @endif
    ">{{ $status->status }}</label>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        </div>
                        
                    </div>
            </div> <!-- .col-->
        </div>
        <!-- end col -->
    </div>

    
    <div class="row">
        {{-- <div class="col-xl-4">
            <div class="card card-height-100">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Store Visits by Source</h4>
                    <div class="flex-shrink-0">
                        <div class="dropdown card-header-dropdown">
                            <a class="text-reset dropdown-btn" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="text-muted">Report<i class="mdi mdi-chevron-down ms-1"></i></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="#">Download Report</a>
                                <a class="dropdown-item" href="#">Export</a>
                                <a class="dropdown-item" href="#">Import</a>
                            </div>
                        </div>
                    </div>
                </div><!-- end card header -->

                <div class="card-body">
                    <div id="store-visits-source" data-colors='["--vz-primary", "--vz-success", "--vz-warning", "--vz-danger", "--vz-info"]' class="apex-charts" dir="ltr"></div>
                </div>
            </div> <!-- .card-->
        </div> <!-- .col--> --}}

        
    </div> <!-- end row-->

</div> <!-- end .h-100-->

</div> <!-- end col -->
<div class="col">
    <div class="h-100">
        <div class="row mb-3 pb-1">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Riwayat Kendaraan</h4>
                    </div><!-- end card header -->

                    <div class="card-body">
                        <div id="map2" class="leaflet-map"></div>
                    </div><!-- end card-body -->
                </div><!-- end card -->
            </div>
        </div>
    </div>
</div>
</div>
    @endsection
@section('script')
<script src="{{ URL::asset('build/libs/apexcharts/apexcharts.min.js') }}"></script>
<script src="{{ URL::asset('build/libs/jsvectormap/js/jsvectormap.min.js') }}"></script>
<script src="{{ URL::asset('build/libs/jsvectormap/maps/world-merc.js') }}"></script>
<script src="{{ URL::asset('build/libs/swiper/swiper-bundle.min.js')}}"></script>
<!-- dashboard init -->
<script src="{{ URL::asset('build/js/pages/dashboard-nft.init.js') }}"></script>
<script src="{{ URL::asset('build/js/pages/dashboard-ecommerce.init.js') }}"></script>
<script src="{{ URL::asset('build/js/app.js') }}"></script>
<script>
    var linechartBasicColors = getChartColorsArray("pressure_chart");
if (linechartBasicColors) {
    var options = {
        series: [{
            name: "Tekanan",
            data: @json($pressure_history['data'])
        }],
        chart: {
            height: 400,
            type: 'line',
            zoom: {
                enabled: false
            },
            toolbar: {
                show: false
            }
        },
       
        dataLabels: {
            enabled: false
        },
        stroke: {
            curve: 'smooth'
        },
        colors: linechartBasicColors,
        title: {
            text: 'Nilai Tekanan',
            align: 'left',
            style: {
                fontWeight: 500,
            },
        },

        xaxis: {
            categories: @json($pressure_history["categories"]),
        },
        yaxis: {
            title: {
                text: 'Tekanan (bar)'
            },
            min: 0,  // Batas bawah sumbu Y
        max: 200, // Batas atas sumbu Y
        tickAmount: 5,  // Jumlah interval pada sumbu Y
            labels: {
                formatter: function (value) {
                    return value.toFixed(2);
                }
            }
        }
    };

    var chart = new ApexCharts(document.querySelector("#pressure_chart"), options);
    chart.render();
}
function updateChart(filter, element) {
        var deviceId = {{ $kendaraan->buffer_id }};  // Gantilah dengan ID perangkat yang sesuai
        
        fetch(`/api/sensor-datakendaraan?buffer_id=${deviceId}&filter=${filter}`)
            .then(response => response.json())
            .then(data => {
                chart.updateOptions({
                    xaxis: {
                        categories: data.categories
                    },
                    series: [{
                        name: 'Pressure',
                        data: data.data
                    }]
                });

                // Update tampilan tombol aktif
        document.querySelectorAll('.btn-group button').forEach(btn => {
            btn.classList.remove('active');
        });

        // Tambahkan kelas 'active' pada tombol yang diklik
        element.classList.add('active');

            })
            .catch(error => console.error('Error fetching data:', error));
    }

    // Panggil fungsi untuk menampilkan data default (1D)
    updateChart('1d', document.querySelector('.btn-group button'));

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
<script>
    var map2 = L.map('map2').setView([-7.93, 112.61], 13); // Sesuaikan koordinat awal
    
    // Tambahkan Layer Peta dari OpenStreetMap
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map2);
    
    // Simpan Jalur GPS
    var trackPath2 = [];
    var polyline2 = L.polyline(trackPath2, { color: 'green' }).addTo(map2);
    
    // Tambahkan Marker Kendaraan
    var vehicleMarker = L.marker([-7.93, 112.61]).addTo(map2)
        .bindPopup("Kendaraan Anda")
        .openPopup();
    
    // Fungsi Update Lokasi Kendaraan
    function updateLocation(lat, lng) {
        var newLatLng = new L.LatLng(lat, lng);
        vehicleMarker.setLatLng(newLatLng);
    
        // Tambahkan ke jalur tracking
        trackPath2.push([lat, lng]);
        polyline2.setLatLngs(trackPath2);
    
        // Geser peta ke lokasi terbaru
        map2.panTo(newLatLng);
    }
    
    // Simulasi Pergerakan Kendaraan (Nantinya Diganti dengan Data dari GPS)
    var index = 0;
    var locations = [
        [-7.9300, 112.6100], [-7.9320, 112.6120], [-7.9340, 112.6140], 
        [-7.9360, 112.6160], [-7.9380, 112.6180]
    ];
    
    setInterval(() => {
        if (index < locations.length) {
            updateLocation(locations[index][0], locations[index][1]);
            index++;
        }
    }, 1000); 
     </script>
@endsection

