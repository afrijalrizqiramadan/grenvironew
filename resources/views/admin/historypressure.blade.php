@extends('layouts.master')
@section('title') @lang('translation.dashboards') @endsection
@section('css')
<link href="{{ URL::asset('build/libs/jsvectormap/css/jsvectormap.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('build/libs/swiper/swiper-bundle.min.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
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
 <div class="container-fluid page-body-wrapper">
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Status Tekanan Gas</h4>
                  <p class="card-description">
                  </p>
                  <div class="alert alert-success" id="successAlert" role="alert" style="display:none;">
                    Data inserted successfully!
                </div>
                <div class="alert alert-danger" id="errorAlert" role="alert" style="display:none;">
                    Failed to insert data.
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
                      <tbody>
                        
                        @foreach($latestPressures as $index=>$pressure)

                        <tr>
                            <td class="py-1">{{ $index + 1 }}</td>

                            <td>
                                <a href="{{ route('detail-customer', ['id' => $pressure->id]) }}" class="text-success fw-bold">{{ $pressure->name }}</a></td>

                            <td>{{ $pressure->capacity }} Bar</td>
                            <td>{{ $pressure->temperature }}</td>

                          <td>
                            <div class="progress">
                                <div class="progress-bar
                                @if($pressure->pressure < 20)
                                    bg-danger
                                @elseif($pressure->pressure  >= 20 && $pressure->pressure  < 40)
                                    bg-warning
                                @else
                                    bg-success
                                @endif
                            " role="progressbar" style="width: {{$pressure->pressure }}%" aria-valuenow="{{$pressure->pressure }}" aria-valuemin="0" aria-valuemax="100"></div>                            </div>
                          </td>
                      
                          <td class="@if($pressure->pressure < 20)
                            text-danger
                         @elseif($pressure->pressure  >= 20 && $pressure->pressure  < 60)
                             text-warning
                         @else
                             text-success
                         @endif font-weight-bold">{{ $pressure->pressure }} Bar

                      <td><label class="badge @if($pressure->pressure < 20)
                           bg-danger-subtle text-danger
                         @elseif($pressure->pressure  >= 20 && $pressure->pressure  < 60)
                             bg-warning-subtle text-warning
                         @else
                             bg-success-subtle text-success
                         @endif"> @if($pressure->pressure < 20)
                         Waktu Pengisian
                     @elseif($pressure->pressure >= 20 && $pressure->pressure < 60)
                         Hampir Habis
                     @else
                         Masih Penuh
                     @endif</label></td></td>
                            <td>{{ \Carbon\Carbon::parse($pressure->updated_at)->translatedFormat('d F Y H:i')}}</td>

                        <td>
                            <div class="d-flex gap-2">
                                <a href="https://api.whatsapp.com/send?phone={{ $pressure->telp }}" class="btn btn-sm btn-success me-1" target="_blank"><i class="ri-whatsapp-line"></i></a>

                            <button class="btn btn-sm btn-primary insert-btn"
                            data-customer-id="{{ $pressure->id }}"
                            data-customer-name="{{ $pressure->name }}"
                            data-toggle="modal"
                            data-target="#insertModal">
                            Kirim
                        </button>
                            </div>
                            </td>
                        </tr>

                        @endforeach

                      </tbody>
                    </table>
                    <!-- Modal -->
                     <!-- Modal -->
    <div class="modal fade" id="insertModal" tabindex="-1" role="dialog" aria-labelledby="insertModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="insertModalLabel">Tambah Pengiriman</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"></span>
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
@endsection