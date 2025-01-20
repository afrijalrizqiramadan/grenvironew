@extends('layouts.master')
@section('title') @lang('translation.dashboards') @endsection
@section('css')
<link href="{{ URL::asset('build/libs/jsvectormap/css/jsvectormap.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('build/libs/swiper/swiper-bundle.min.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('content')

@push('javascript')
    <meta name="csrf-token" content="{{ csrf_token() }}">
   
<script>
       document.addEventListener('DOMContentLoaded', function () {
        var deliveryId='';
            $('.update-btn').on('click', function () {
                var deliveryId = $(this).data('delivery-id');
                var deliveryStatus = $(this).data('delivery-status');
                $('#formStatus').val(deliveryStatus);
                $('#formDeliveryId').val(deliveryId);

            });

            $('#updateForm').on('submit', function (e) {
                e.preventDefault();
                let id = $('#formDeliveryId').val();
                let status = $('#formStatus').val();
                let _token = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url: "http://127.0.0.1:8000/api/update-status/1",
                    type: "POST",
                    data: {
                        _token: _token,
                        status: status
                    },
                    success: function(response) {
                        if(response.success) {
                            alert('Status updated successfully');
                        } else {
                            alert('Failed to update status');
                        }
                    },
                    error: function(response) {
                        alert('Error occurred');
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
                <div class="card">
                
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                            <h4 class="card-title mb-2">Pengiriman</h4>
                            <div class="alert alert-success" id="successAlert" role="alert" style="display:none;">
                                Data inserted successfully!
                            </div>
                            <div class="alert alert-danger" id="errorAlert" role="alert" style="display:none;">
                                Failed to insert data.
                            </div>
                            <div class="dropdown">
                                {{-- <a href="#" class="text-success btn btn-link  px-1"><i class="mdi mdi-refresh"></i></a>
                                <a href="#" class="text-success btn btn-link px-1 dropdown-toggle dropdown-arrow-none" data-bs-toggle="dropdown" id="settingsDropdownsales">
                                    <i class="mdi mdi-dots-horizontal"></i></a>
                                    <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="settingsDropdownsales">
                                        <a class="dropdown-item">
                                            <i class="mdi mdi-grease-pencil text-primary"></i>
                                            Edit
                                        </a>
                                        <a class="dropdown-item">
                                            <i class="mdi mdi-delete text-primary"></i>
                                            Delete
                                        </a> --}}
                                    </div>
                            </div>
                        </div>
                        
                        <div>
                          <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <a class="nav-link active" data-bs-toggle="tab" href="#diproses">Diproses</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#pengiriman">Pengiriman</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#selesai">Selesai</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#dibatalkan">Dibatalkan</a>
                            </li>
                        </ul>

                            <!-- Tab content -->
                            <div class="tab-content tab-no-active-fill-tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="diproses" role="tabpanel" aria-labelledby="proses-tab">
                                    <div class="col-lg-12 grid-margin stretch-card">
                                        <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table ">
                                              <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama</th>
                                                    <th>Lokasi</th>
                                                    <th>Jadwal</th>
                                                    <th>Total Pengiriman</th>
                                                    <th>No Telepon</th>
                                                    <th>Status</th>
                                                    @if($user->hasRole('administrator'))
                                                        <th>Aksi</th>
                                                    @endif
                                                </tr>
                                              </thead>
                                              <tbody>
                                                @foreach($statusesProses as $index=>$delivery)
                                                <tr>
                                                    <td">{{ $index + 1 }}</td>

                                                  <td >
                                                    {{ $delivery->customer->name }}
                                                  </td>
                                                  <td >
                                                    {{ $delivery->customer->location }}
                                                  </td>
                                                    <td>{{ \Carbon\Carbon::parse($delivery->delivery_date)->translatedFormat('d F Y')}}</td>
                                                  <td>
                                                    {{ $delivery->total }}
                                                  </td>
                                                  <td>
                                                    {{ $delivery->customer->telp }}
                                                    <button onclick="redirectToWhatsApp(' {{ $delivery->customer->telp }}')" type="button" class="btn btn-inverse-success btn-icon">
                                                        <i class="mdi mdi-whatsapp"></i>
                                                      </button>
                                                  </td>
                                                  <td><label class="badge
                                                    @if($delivery->status == 'Selesai')
                                                       bg-success-subtle text-success
                                                   @elseif($delivery->status == 'Dalam Perjalanan')
                                                       bg-warning-subtle text-warning
                                                   @elseif($delivery->status == 'Batal')
                                                       bg-danger-subtle text-danger
                                                   @elseif($delivery->status == 'Disiapkan')
                                                       bg-info-subtle text-info
                                                   @endif
                                                   ">{{ $delivery->status }}</label></td>
                                                   @if($user->hasRole('administrator'))

                                                  <td>
                                                    <button class="btn btn-warning update-btn"
                                                    data-delivery-status="{{ $delivery->status }}"
                                                    data-delivery-id="{{ $delivery->id }}"
                                                    data-toggle="modal"
                                                    data-target="#updateModal">
                                                    Update
                                                </button>
                                                    </td>
                                                    @endif
                                                </tr>

                                                @endforeach

                                              </tbody>
                                            </table>
                                          </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="pengiriman" role="tabpanel" aria-labelledby="kirim-tab">
                                    <div class="col-lg-12 grid-margin stretch-card">
                                        <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table">
                                              <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama</th>
                                                    <th>Lokasi</th>
                                                    <th>Jadwal</th>
                                                    <th>Total Pengiriman</th>
                                                    <th>No Telepon</th>
                                                    <th>Status</th>
                                                    @if($user->hasRole('administrator'))

                                                  <th>Aksi</th>
                                                  @endif
                                                </tr>
                                              </thead>
                                              <tbody>
                                                @foreach($statusesKirim as $index=>$delivery)

                                                <tr>
                                                    <td class="py-1">{{ $index + 1 }}</td>
                                                    
                                                  <td class="py-1">
                                                    {{ $delivery->customer->name }}
                                                  </td>
                                                  <td class="py-1">
                                                    {{ $delivery->customer->location }}
                                                  </td>
                                                    <td>{{ \Carbon\Carbon::parse($delivery->delivery_date)->translatedFormat('d F Y')}}</td>
                                                  <td class="py-1">
                                                    {{ $delivery->total }}
                                                  </td>
                                                  <td>
                                                    {{ $delivery->customer->telp }}
                                                    <button onclick="redirectToWhatsApp(' {{ $delivery->customer->telp }}')" type="button" class="btn btn-inverse-success btn-icon">
                                                        <i class="mdi mdi-whatsapp"></i>
                                                      </button>
                                                  </td>
                                                  <td><label class="badge
                                                    @if($delivery->status == 'Selesai')
                                                       bg-success-subtle text-success
                                                   @elseif($delivery->status == 'Dalam Perjalanan')
                                                       bg-warning-subtle text-warning
                                                   @elseif($delivery->status == 'Batal')
                                                       bg-danger-subtle text-danger
                                                   @elseif($delivery->status == 'Disiapkan')
                                                       bg-info-subtle text-info
                                                   @endif
                                                   ">{{ $delivery->status }}</label></td>
                                                   @if($user->hasRole('administrator'))
                                                  <td>
                                                   <button class="btn btn-warning update-btn"
                                                   data-delivery-status="{{ $delivery->status }}"
                                                   data-delivery-id="{{ $delivery->id }}"

                                                   data-toggle="modal"
                                                   data-target="#updateModal">
                                                   Update
                                               </button>
                                                    </td>
                                                    @endif
                                                </tr>

                                                @endforeach

                                              </tbody>
                                            </table>
                                          </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="tab-pane fade" id="selesai" role="tabpanel" aria-labelledby="selesai-tab">
                                    <div class="col-lg-12 grid-margin stretch-card">
                                        <div class="card-body">
                                            <div class="row">

                                        <div class="table-responsive">
                                            <table class="table">
                                              <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama</th>
                                                    <th>Lokasi</th>
                                                    <th>Jadwal</th>
                                                    <th>Total Pengiriman</th>
                                                    <th>No Telepon</th>
                                                    <th>Status</th>
                                                    @if($user->hasRole('administrator'))
                                                  <th>Aksi</th>
                                                  @endif
                                                </tr>
                                              </thead>
                                              <tbody>
                                                @foreach($statusesSelesai as $index=>$delivery)

                                                <tr>
                                                    <td class="py-1">{{ $index + 1 }}</td>

                                                  <td class="py-1">
                                                    {{ $delivery->customer->name }}
                                                  </td>
                                                  <td class="py-1">
                                                    {{ $delivery->customer->location }}
                                                  </td>
                                                    <td>{{ \Carbon\Carbon::parse($delivery->delivery_date)->translatedFormat('d F Y')}}</td>
                                                  <td class="py-1">
                                                    {{ $delivery->total }}
                                                  </td>
                                                  <td>
                                                    {{ $delivery->customer->telp }}
                                                    <button onclick="redirectToWhatsApp(' {{ $delivery->customer->telp }}')" type="button" class="btn btn-inverse-success btn-icon">
                                                        <i class="mdi mdi-whatsapp"></i>
                                                      </button>
                                                  </td>
                                                  <td><label class="badge
                                                    @if($delivery->status == 'Selesai')
                                                       bg-success-subtle text-success
                                                   @elseif($delivery->status == 'Dalam Perjalanan')
                                                       bg-warning-subtle text-warning
                                                   @elseif($delivery->status == 'Batal')
                                                       bg-danger-subtle text-danger
                                                   @elseif($delivery->status == 'Disiapkan')
                                                       bg-info-subtle text-info
                                                   @endif
                                                   ">{{ $delivery->status }}</label></td>
                                                   @if($user->hasRole('administrator'))
                                                  <td>

                                                    <button class="btn btn-warning update-btn"
                                                    data-delivery-status="{{ $delivery->status }}"
                                                    data-delivery-id="{{ $delivery->id }}"

                                                    data-toggle="modal"
                                                    data-target="#updateModal">
                                                    Update
                                                </button>
                                                    </td>
                                                    @endif
                                                </tr>

                                                @endforeach

                                              </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="dibatalkan" role="tabpanel" aria-labelledby="batal-tab">
                                    <div class="col-lg-12 grid-margin stretch-card">
                                        <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table">
                                              <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama</th>
                                                    <th>Lokasi</th>
                                                    <th>Jadwal</th>
                                                    <th>Total Pengiriman</th>
                                                    <th>No Telepon</th>
                                                    <th>Status</th>

                                                </tr>
                                              </thead>
                                              <tbody>
                                                @foreach($statusesBatal as $index=>$delivery)

                                                <tr>
                                                    <td class="py-1">{{ $index + 1 }}</td>

                                                  <td class="py-1">
                                                    {{ $delivery->customer->name }}
                                                  </td>
                                                  <td class="py-1">
                                                    {{ $delivery->customer->location }}
                                                  </td>
                                                    <td>{{ \Carbon\Carbon::parse($delivery->delivery_date)->translatedFormat('d F Y')}}</td>
                                                  <td class="py-1">
                                                    {{ $delivery->total }}
                                                  </td>
                                                  <td>
                                                    {{ $delivery->customer->telp }}
                                                    <button onclick="redirectToWhatsApp(' {{ $delivery->customer->telp }}')" type="button" class="btn btn-inverse-success btn-icon">
                                                        <i class="mdi mdi-whatsapp"></i>
                                                      </button>
                                                  </td>
                                                  <td><label class="badge
                                                    @if($delivery->status == 'Selesai')
                                                       bg-success-subtle text-success
                                                   @elseif($delivery->status == 'Dalam Perjalanan')
                                                       bg-warning-subtle text-warning
                                                   @elseif($delivery->status == 'Batal')
                                                       bg-danger-subtle text-danger
                                                   @elseif($delivery->status == 'Disiapkan')
                                                       bg-info-subtle text-info
                                                   @endif
                                                   ">{{ $delivery->status }}</label></td>

                                                </tr>

                                                @endforeach

                                              </tbody>
                                            </table>
                                          </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
                      <!-- Modal -->
                      <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="updateModalLabel">Update Pengiriman</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form id="updateForm">
                                        @csrf
                                        <input type="hidden" name="delivery_id" id="formDeliveryId">

                                        <div class="form-group">
                                            <label for="formStatus">Status</label>
                                            <select class="form-control" id="formStatus" name="status" required>
                                                <option value="Disiapkan">Diproses</option>
                                                <option value="Dalam Perjalanan">Dalam Perjalanan</option>
                                                <option value="Selesai">Selesai</option>
                                                <option value="Batal">Batal</option>
                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
            @push('javascript')
        
            <script>
                function redirectToWhatsApp(phoneNumber) {
                    phoneNumber = phoneNumber.replace(/\D/g, '');

// Logika untuk menambahkan +62 jika diperlukan
if (!phoneNumber.startsWith('62')) {
    if (phoneNumber.startsWith('0')) {
        phoneNumber = '62' + phoneNumber.slice(1);
    } else {
        phoneNumber = '62' + phoneNumber;
    }
}

// Menambahkan tanda +
phoneNumber = '+' + phoneNumber;
                    var message = ''; // Ganti dengan pesan yang Anda inginkan
                    var url = 'https://wa.me/' + phoneNumber + '?text=' + encodeURIComponent(message);
                    console.log(url)
                    window.location.href = url;
                }
                </script>
                @endpush
                @endsection
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
                @endsection
