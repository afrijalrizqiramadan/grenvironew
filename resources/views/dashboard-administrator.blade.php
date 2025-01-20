<x-app-layout>
    @push('javascript')
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

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
@endpush
    <div class="container-fluid page-body-wrapper">
                <div class="main-panel">
                    <div class="content-wrapper">
                        <div class="row">
                            <div class="col-sm-6 mb-4 mb-xl-0">
                                <div class="d-lg-flex align-items-center">
                                    <div>
                                        <h3 class="text-dark font-weight-bold mb-2">Selamat Datang Admin</h3>
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

                            <div class="col-sm-12">
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
                        <div class="row">
                            <div class="col-lg-2 mt-2 grid-margin stretch-card">
                                <div class="card">
                                    <div class="card-body d-flex flex-column align-items-center justify-content-center">
                                        <h1 class="h1 text-success font-weight-bold">{{$customerCount}}</h1>
                                        <i class="mdi mdi-account-outline mdi-36px text-dark"></i>
                                        <p class="text-center">Total Pelanggan</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2 grid-margin stretch-card">
                                <div class="card">
                                    <div class="card-body d-flex flex-column align-items-center justify-content-center">
                                        <h2 class="h1 text-warning font-weight-bold">{{$averagePressure}}</h2>
                                        <i class="mdi mdi-gas-station mdi-36px text-dark"></i>
                                        <p class="text-center">Rata Rata Gas</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2 grid-margin stretch-card">
                                <div class="card">
                                    <div class="card-body d-flex flex-column align-items-center justify-content-center">
                                        <h2 class="h1 text-danger font-weight-bold">{{$lowPressureCount}}</h2>
                                        <i class="mdi mdi-refresh mdi-36px text-dark"></i>
                                        <p class="text-center">Gas Rendah</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2 grid-margin stretch-card">
                                <div class="card">
                                    <div class="card-body d-flex flex-column align-items-center justify-content-center">
                                        <h2 class="h1 text-info font-weight-bold">{{$countDeliveries}}</h2>
                                        <i class="mdi mdi-file-document-outline mdi-36px text-dark"></i>
                                        <p class="text-center">Total Pengiriman</p>
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="col-lg-2 grid-margin stretch-card">
                                <div class="card">
                                    <div class="card-body pb-0">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <h2 class="text-warning font-weight-bold">3259</h2>
                                            <i class="mdi mdi-folder-outline mdi-18px text-dark"></i>
                                        </div>
                                    </div>
                                    <canvas id="projects"></canvas>
                                    <div class="line-chart-row-title">All PROJECTS</div>
                                </div>
                            </div>
                            <div class="col-lg-2 grid-margin stretch-card">
                                <div class="card">
                                    <div class="card-body pb-0">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <h2 class="text-secondary font-weight-bold">586</h2>
                                            <i class="mdi mdi-cart-outline mdi-18px text-dark"></i>
                                        </div>
                                    </div>
                                    <canvas id="orderRecieved"></canvas>
                                    <div class="line-chart-row-title">Orders Received</div>
                                </div>
                            </div>
                            <div class="col-lg-2 grid-margin stretch-card">
                                <div class="card">
                                    <div class="card-body pb-0">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <h2 class="text-dark font-weight-bold">7826</h2>
                                            <i class="mdi mdi-cash text-dark mdi-18px"></i>
                                        </div>
                                    </div>
                                    <canvas id="transactions"></canvas>
                                    <div class="line-chart-row-title">TRANSACTIONS</div>
                                </div>
                            </div> --}}
                        </div>
                        <div class="row mt-4">
                            <div class="col-lg-12 grid-margin stretch-card">
                                <div class="card">
                                    <div class="card-body">
                                        <table class="table">
                                            <thead>
                                              <tr>
                                                <th>No</th>
                                                <th>Nama</th>
                                                <th>Telepon</th>
                                                <th>Lokasi</th>
                                                <th>Kecamatan</th>
                                                <th>Tekanan</th>
                                                <th>Persentase</th>
                                                <th>Status</th>
                                                <th>Update Terakhir</th>
                                                <th>Aksi</th>
                                              </tr>
                                            </thead>
                                            <tbody>
                                              @foreach($minpressuresensor as $index => $status)
                                              <tr>
                                                  <td>{{ $index + 1 }}</td>
                                                  <td>{{ $status->name }}</td>
                                                  <td>{{ $status->telp }}</td>
                                                  <td>{{ $status->location }}</td>
                                                  <td>{{ $status->district_name }}</td>
                                                  <td><div class="progress">
                                                    <div class="progress-bar
                                                    @if($status->pressure < 20)
                                                        bg-danger
                                                    @elseif($status->pressure  >= 20 && $status->pressure  < 40)
                                                        bg-warning
                                                    @else
                                                        bg-success
                                                    @endif
                                                " role="progressbar" style="width: {{$status->pressure }}%" aria-valuenow="{{$status->pressure }}" aria-valuemin="0" aria-valuemax="100"></div>                            </div>
                                              </td>
                                                <td class="@if($status->pressure < 20)
                                                       text-danger
                                                    @elseif($status->pressure  >= 20 && $status->pressure  < 40)
                                                        text-warning
                                                    @else
                                                        text-success
                                                    @endif font-weight-bold">{{ $status->pressure }}%

                                                 <td><label class="badge @if($status->pressure < 20)
                                                       badge-danger
                                                    @elseif($status->pressure  >= 20 && $status->pressure  < 40)
                                                        badge-warning
                                                    @else
                                                        badge-success
                                                    @endif"> @if($status->pressure < 20)
                                                    Waktu Pengisian
                                                @elseif($status->pressure >= 20 && $status->pressure < 40)
                                                    Hampir Habis
                                                @else
                                                    Masih Penuh
                                                @endif</label></td></td>
                                                <td>{{ \Carbon\Carbon::parse($status->updated_at)->translatedFormat('d F Y H:i')}}</td>
                                                <td>
                                                    <a class="btn btn-success" href="https://api.whatsapp.com/send?phone={{ $status->telp }}&text=Hai%20{{ $status->name }},%20tekanan%20gas%20anda%20saat%20ini%20{{ $status->pressure }}%" target="_blank">
                                                        Kirim WA
                                                    </a>
                                                    <button class="btn btn-primary insert-btn"
                                                    data-customer-id="{{ $status->id }}"
                                                    data-customer-name="{{ $status->name }}"
                                                    data-toggle="modal"
                                                    data-target="#insertModal">
                                                    Kirim
                                                </button>                                              </tr>
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
                                            </tbody>


                                          </table>                                    </div>
                                </div>
                            </div>

                        </div>
                        
                    
                    </div>

                </x-app-layout>
