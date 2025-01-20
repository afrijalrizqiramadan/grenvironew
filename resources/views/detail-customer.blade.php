<x-app-layout>
    <div class="container-fluid page-body-wrapper">
        <div class="main-panel">
            <div class="content-wrapper">
                <div class="row">
                    <div class="col-sm-6 mb-4 mb-xl-0">
                        <div class="d-lg-flex align-items-center">
                            <div>
                                <!--<h3 class="text-dark font-weight-bold mb-2">Hi, welcome back!</h3>-->
                            </div>
                            <!--<div class="ms-lg-5 d-lg-flex d-none">-->
                            <!--		<button type="button" class="btn bg-white btn-icon">-->
                            <!--			<i class="mdi mdi-view-grid text-success"></i>-->
                            <!--	</button>-->
                            <!--		<button type="button" class="btn bg-white btn-icon ms-2">-->
                            <!--			<i class="mdi mdi-format-list-bulleted font-weight-bold text-primary"></i>-->
                            <!--		</button>-->
                            <!--</div>-->
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="d-flex align-items-center justify-content-md-end">
                            {{-- <div class="pe-1 mb-3 mb-xl-0">
                                    <button type="button" class="btn btn-outline-inverse-info btn-icon-text">
                                        Feedback
                                        <i class="mdi mdi-message-outline btn-icon-append"></i>
                                    </button>
                            </div>
                            <div class="pe-1 mb-3 mb-xl-0">
                                    <button type="button" class="btn btn-outline-inverse-info btn-icon-text">
                                        Help
                                        <i class="mdi mdi-help-circle-outline btn-icon-append"></i>
                                </button>
                            </div> --}}
                            <!--<div class="pe-1 mb-3 mb-xl-0">-->
                            <!--		<button type="button" class="btn btn-outline-inverse-info btn-icon-text">-->
                            <!--			Print-->
                            <!--			<i class="mdi mdi-printer btn-icon-append"></i>                          -->
                            <!--		</button>-->
                            <!--</div>-->
                        </div>
                    </div>
                </div>
                <br>

                <div class="row">
                    <div class="col-sm-4 flex-column d-flex stretch-card">
                        <div class="row flex-grow">
                            <div class="col-sm-12 grid-margin stretch-card">
                                <div class="card">
                                    <div class="card-body"><button type="button"
                                            class="btn mx-2 btn-inverse-success btn-icon"onclick="window.location.href='{{ $maps }}'">
                                            <i class="mdi mdi-map-marker"></i>
                                        </button>
                                        <span class="h3 font-weight-bold text-dark">{{ $location }}</span>
                                        <br>
                                        <br>
                                        <div class="row">

                                            <div class="col-lg-6">

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
                                                <div class="d-lg-flex align-items-baseline mb-3">
                                                    <h1 class="text-dark font-weight-bold">23<sup
                                                            class="font-weight-light"><small>o</small><small
                                                                class="font-weight-medium">c</small></sup></h1>
                                                    <p class="text-muted ms-3">Partly cloudy</p>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="position-relative">
                                                    <img src="{{ asset('assets/images/customer/' . $images) }}"
                                                        class="w-500 rounded-3" alt="">
                                                    {{-- <div class="live-info badge badge-success">Live</div> --}}
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <h4 class="card-title">Riwayat Pengiriman</h4>
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Total</th>
                                                            <th>Tanggal</th>
                                                            <th>Status</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($statuses as $index => $status)
                                                            <tr>
                                                                <td>{{ $index + 1 }}</td>
                                                                <td>{{ $status->total }}</td>
                                                                <td>{{ \Carbon\Carbon::parse($status->delivery_date)->translatedFormat('d F Y') }}
                                                                </td>
                                                                <td><label
                                                                        class="badge
                             @if ($status->status == 'Selesai') badge-success
                            @elseif($status->status == 'Dalam Perjalanan')
                                badge-warning
                            @elseif($status->status == 'Batal')
                                badge-danger
                            @elseif($status->status == 'Disiapkan')
                                badge-info @endif
                            ">{{ $status->status }}</label>
                                                                </td>
                                                            </tr>
                                                        @endforeach


                                                    </tbody>
                                                </table>
                                            </div>
                                            <!--<div class="col-sm-12 mt-4 mt-lg-0">-->
                                            <!--	<div class="bg-primary text-white px-4 py-4 card">-->
                                            <!--		<div class="row">-->
                                            <!--			<div class="col-sm-6 pl-lg-5">-->
                                            <!--				<h2>$1635</h2>-->
                                            <!--				<p class="mb-0">Your Iincome</p>-->
                                            <!--			</div>-->
                                            <!--			<div class="col-sm-6 climate-info-border mt-lg-0 mt-2">-->
                                            <!--				<h2>$2650</h2>-->
                                            <!--				<p class="mb-0">Your Spending</p>-->
                                            <!--			</div>-->
                                            <!--		</div>-->
                                            <!--	</div>-->
                                            <!--</div>-->
                                        </div>
                                        <!--<div class="row pt-3 mt-md-1">-->
                                        <!--	<div class="col">-->
                                        <!--		<div class="d-flex purchase-detail-legend align-items-center">-->
                                        <!--			<div id="circleProgress1" class="p-2"></div>-->
                                        <!--			<div>-->
                                        <!--				<p class="font-weight-medium text-dark text-small">Sessions</p>-->
                                        <!--				<h3 class="font-weight-bold text-dark  mb-0">26.80%</h3>-->
                                        <!--			</div>-->
                                        <!--		</div>-->
                                        <!--	</div>-->
                                        <!--	<div class="col">-->
                                        <!--		<div class="d-flex purchase-detail-legend align-items-center">-->
                                        <!--			<div id="circleProgress2" class="p-2"></div>-->
                                        <!--			<div>-->
                                        <!--				<p class="font-weight-medium text-dark text-small">Users</p>-->
                                        <!--				<h3 class="font-weight-bold text-dark  mb-0">56.80%</h3>-->
                                        <!--			</div>-->
                                        <!--		</div>-->
                                        <!--	</div>-->
                                        <!--</div>-->
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-sm-8 flex-column d-flex stretch-card">
                        <div class="row">

                            <div class="col-lg-4 d-flex grid-margin stretch-card">
                                <div class="card sale-diffrence-border">
                                    <div class="card-body">
                                        <h2 class="text-dark mb-2 font-weight-bold">{{ $capacity }} bar</h2>
                                        </h2>
                                        <h4 class="card-title mb-2">Kapasitas Tabung</h4>
                                        <small class="text-muted"></small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 d-flex grid-margin stretch-card">
                                <div class="card sale-diffrence-border">
                                    <div class="card-body">
                                        <h2 class="text-dark mb-2 font-weight-bold">{{ $status_device }}</h2>
                                        <h4 class="card-title mb-2">Status Device</h4>
                                        <small class="text-muted"></small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 d-flex grid-margin stretch-card">
                                <div class="card sale-diffrence-border">
                                    <div class="card-body">
                                        <h2 class="text-dark mb-2 font-weight-bold">{{ $registration_date_device }}</h2>
                                        <h4 class="card-title mb-2">Tanggal Bergabung</h4>
                                        <small class="text-muted"></small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 d-flex grid-margin stretch-card">
                                <div class="card bg-primary">
                                    <div class="card-body text-white">
                                        <h2 class="h2 text-white mb-2 font-weight-bold">{{ $latestPressure }} bar</h2>
                                        <div class="progress mb-3">
                                            <div class="progress-bar
                                            @if ($latestPressure < 20) bg-danger
                                            @elseif($latestPressure >= 20 && $latestPressure < 40)
                                                bg-warning
                                            @else
                                                bg-success @endif
                                        "
                                                role="progressbar" style="width: {{ $latestPressure }}%"
                                                aria-valuenow="{{ $latestPressure }}" aria-valuemin="0"
                                                aria-valuemax="100"></div>
                                        </div>
                                        <p class="pb-0 mb-0">Tekanan Gas</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8 grid-margin stretch-card">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">Pressure Monitor</h4>
                                        <canvas id="sensorChart" width="800" height="400"></canvas>

                                    </div>
                                </div>
                            </div>

                        </div>
                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                var ctx = document.getElementById('sensorChart').getContext('2d');
                                var sensorChart = new Chart(ctx, {
                                    type: 'line',
                                    data: {
                                        labels: {!! json_encode($timestamp) !!},
                                        datasets: [{
                                            label: 'Nilai Pressure',
                                            data: {!! json_encode($pressure) !!},
                                            fill: false,
                                            borderColor: 'rgb(75, 192, 192)',
                                            tension: 0.1
                                        }]
                                    },
                                    options: {
                                        scales: {
                                            x: {
                                                type: 'time',
                                                time: {
                                                    unit: 'day'
                                                }
                                            },
                                            y: {
                                                beginAtZero: true
                                            }
                                        }
                                    }
                                });
                            });
                        </script>
</x-app-layout>
