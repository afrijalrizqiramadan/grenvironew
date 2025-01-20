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
                  <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Lokasi</th>
                          <th>Progress</th>
                          <th>Tekanan</th>
                          <th>Status</th>
                          <th>Update Terakhir</th>
                          <th>Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                        
                        @foreach($latestPressures as $index=>$pressure)

                        <tr>
                            <td class="py-1">{{ $index + 1 }}</td>

                          <td class="py-1">
                            {{ $pressure->name }}
                          </td>
                          <td>
                            {{ $pressure->location }}
                          </td>
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
                                @elseif($pressure->pressure  >= 20 && $pressure->pressure  < 40)
                                    text-warning
                                @else
                                    text-success
                                @endif font-weight-bold">{{ $pressure->pressure }}%
                                                    </td>
                             <td><label class="badge @if($pressure->pressure < 20)
                                   badge-danger
                                @elseif($pressure->pressure  >= 20 && $pressure->pressure  < 40)
                                    badge-warning
                                @else
                                    badge-success
                                @endif"> @if($pressure->pressure < 20)
                                Waktu Pengisian
                            @elseif($pressure->pressure >= 20 && $pressure->pressure < 40)
                                Hampir Habis
                            @else
                                Masih Penuh
                            @endif</label></td>
                            <td>{{ \Carbon\Carbon::parse($pressure->updated_at)->translatedFormat('d F Y H:i')}}</td>

                        <td>
                            <a class="btn btn-success" href="https://api.whatsapp.com/send?phone={{ $pressure->telp }}&text=Hai%20{{ $pressure->name }},%20tekanan%20gas%20anda%20saat%20ini%20{{ $pressure->pressure }}%" target="_blank">
                                Kirim WA
                            </a>
                            <button class="btn btn-primary insert-btn"
                            data-customer-id="{{ $pressure->id }}"
                            data-customer-name="{{ $pressure->name }}"
                            data-toggle="modal"
                            data-target="#insertModal">
                            Kirim
                        </button>
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

                  </div>
                </div>
              </div>
            </div>

        </x-app-layout>
