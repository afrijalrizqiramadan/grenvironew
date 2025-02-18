@extends('layouts.master')
@section('title') @lang('translation.dashboards') @endsection
@section('css')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css"
integrity="sha512-hoalWLoI8r4UszCkZ5kL8vayOGVae1oxXe/2A4AO6J9+580uKHDO3JdHb7NzwwzK5xr/Fs0W40kiNHxM9vyTtQ=="
crossorigin="" />
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<style>
#map {
    height: 500px;
}

</style>
<link href="{{ URL::asset('build/libs/jsvectormap/css/jsvectormap.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('build/libs/swiper/swiper-bundle.min.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('content')    
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="container-fluid page-body-wrapper">
         <div class="main-panel">
           <div class="content-wrapper">
             <div class="row">
               <div class="col-lg-12 grid-margin stretch-card">
                   <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Tambah Pelanggan</h4>
                        <form  class="form-sample" action="{{ route('customer.store') }}" method="POST" enctype="multipart/form-data" >
                            @csrf
                            <p class="card-description">
                            Personal Info
                          </p>
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Nama</label>
                                <div class="col-sm-9">
                                    <input class="form-control" type="text" id="name" name="name" value="{{ old('name') }}" maxlength="25" required>
                                </div>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Email</label>
                                <div class="col-sm-9">
                                    <input class="form-control" type="email" id="email" name="email" value="{{ old('email') }}" maxlength="30" required>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Telepon</label>
                                <div class="col-sm-9">
                                    <input class="form-control" type="number" id="telp" name="telp" value="{{ old('telp') }}">
                                </div>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Nama Lokasi</label>
                                <div class="col-sm-9">
                                    <input class="form-control" type="text" id="location" name="location" value="{{ old('location') }}" maxlength="20" required>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Kapasitas</label>
                                <div class="col-sm-9">
                                    <input class="form-control" type="number" step="any" id="capacity" name="capacity" value="{{ old('capacity') }}" required>
                                </div>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Device ID</label>
                                <div class="col-sm-9">
                                    <input class="form-control" type="text" id="buffer_id" name="buffer_id" value="{{ old('buffer_id') }}" required>
                                </div>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Registrasi</label>
                                <div class="col-sm-9">
                                    <input  class="form-control" type="date" id="registration_date" name="registration_date" value="{{ old('registration_date') }}" required>
                                </div>
                              </div>
                            </div>
                          </div>
                         
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Tipe</label>
                                <div class="col-sm-9">
                                  <select id="type" name="type" value="{{ old('type') }}" class="form-control" required>
                                    <option>Kantor</option>
                                    <option>Pendidikan</option>
                                  </select>
                                </div>
                              </div>
                            </div>
                             <div class="col-md-6">
                              <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Status</label>
                                <div class="col-sm-9">
                                <select name="status" class="form-select" data-choices data-choices-sorting="true" id="autoSizingSelect" required>
                                    <option value="Aktif" {{ old('status') == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                                    <option value="Tidak Aktif" {{ old('status') == 'Tidak Aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                                </select>
                          </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                          {{-- <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Upload Gambar</label>
                            <img id="previewImage" class="mb-2" src="{{ $customer->getImage() }}" width="100%" alt="">
                            <input type="file" name="images" id="images" accept="image/*">

                          </div> --}}
                        </div>
                        <div class="col-md-6">

                    </div>
                </div>

                          </div>
                        </br>
                    </br>
                    <p class="card-description">
                            Alamat
                          </p>
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Alamat Lengkap</label>
                                <div class="col-sm-9">
                                    <textarea class="form-control" id="address" name="address">{{ old('address') }}</textarea>
                                </div>
                              </div>
                            </div>
                           
                          </div>
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Provinsi</label>
                                <div class="col-sm-9">
                                    @php
                                    $provinces = new App\Http\Controllers\LocationController;
                                    $provinces= $provinces->provinces();
                                @endphp
                                <select class="form-control" name="provinsi" id="provinsi">
                                    <option value="">==Pilih Salah Satu==</option>
                                    @foreach ($provinces as $item)
                                        <option value="{{ $item->id ?? '' }}">{{ $item->name ?? '' }}</option>
                                    @endforeach
                                </select>                                </div>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group row">
                                <label class="col-md-3 col-form-label" for="kota">Kabupaten / Kota</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="kota" id="kota">
                                    </select>                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group row">
                                <label class="col-md-3 col-form-label" for="kecamatan">Kecamatan</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="kecamatan" id="kecamatan">
                                    </select>                                </div>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group row">
                                <label class="col-md-3 col-form-label" for="desa">Desa</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="desa" id="desa">
                                    </select>                                </div>
                              </div>
                            </div>
                          </div><div class="row">
                            {{-- <div class="col-md-6">
                              <div class="form-group row">
                                <label class="col-md-3 col-form-label" for="maps">Maps</label>
                                <div class="col-sm-9">
                                    <textarea id="maps" name="maps">{{ old('maps') }}</textarea>
                                </div>
                              </div>
                            </div> --}}
                            <div class="col-md-6">
                              <div class="form-group row">
                                <label class="col-md-3 col-form-label" for="desa">Latitude Longitude</label>
                                <div class="col-sm-9">
                                    <input type="text" name="latlong"
                                class="form-control @error('latlong') is-invalid @enderror" readonly id="">
                            @error('latlong')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                              </div>
                            </div>
                        </div>
                    </div>

                        <div id="map"></div>
                    </br>
                </br>
                <button type="submit" class="btn btn-primary me-2">Submit</button>

                        </form>
                      </div>
                   </div>
               </div>

           </div>

       </div>
   </div>
   @endsection
   
   @section('script')
   <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
   <script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js"
       integrity="sha512-BB3hKbKWOc9Ez/TAwyWxNXeoV9c1v6FIeYiBieIWkpLjauysF18NzgR1MBNBXf8/KABdlkX68nAhlwcDFLGPCQ=="
       crossorigin=""></script>
   <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


   <script>

       // fungsi ini akan berjalan ketika akan menambahkan gambar dimana fungsi ini
       // akan membuat preview image sebelum kita simpan gambar tersebut.
       function readURL(input) {
           if (input.files && input.files[0]) {
               var reader = new FileReader();

               reader.onload = function(e) {
                   $('#previewImage').attr('src', e.target.result);
               }

               reader.readAsDataURL(input.files[0]);
           }
       }

       // Ketika tag input file denghan class image di klik akan menjalankan fungsi di atas
       $("#image").change(function() {
           readURL(this);
       });

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


       var map = L.map('map', {
           // titik koordinat disini kita dapatkan dari tabel centrepoint tepatnya dari field location
           // yang sebelumnya sudah kita tambahkan jadi lokasi map yang akan muncul  sesuai dengan tabel
           // centrepoint
           center: [{{ $centrepoint }}],
           zoom: 14,
           layers: [streets]
       });

       var baseLayers = {
           //"Grayscale": grayscale,
           "Streets": streets,
           "Satellite": satellite
       };

       var overlays = {
           "Streets": streets,
           "Satellite": satellite,
       };

       L.control.layers(baseLayers, overlays).addTo(map);

       // Begitu juga dengan curLocation titik koordinatnya dari tabel centrepoint
       // lalu kita masukkan curLocation tersebut ke dalam variabel marker untuk menampilkan marker
       // pada peta.

       var curLocation = [{{ $centrepoint }}];
       map.attributionControl.setPrefix(false);

       var marker = new L.marker(curLocation, {
           draggable: 'true',
       });
       map.addLayer(marker);

       marker.on('dragend', function(event) {
           var location = marker.getLatLng();
           marker.setLatLng(location, {
               draggable: 'true',
           }).bindPopup(location).update();

           $('#latlong').val(location.lat + "," + location.lng).keyup()
       });

       var loc = document.querySelector("[name=latlong]");
       map.on("click", function(e) {
           var lat = e.latlng.lat;
           var lng = e.latlng.lng;

           if (!marker) {
               marker = L.marker(e.latlng).addTo(map);
           } else {
               marker.setLatLng(e.latlng);
           }
           loc.value = lat + "," + lng;
       });
   </script>

   <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

   <script>

       function onChangeSelect(url, id, name) {
           // send ajax request to get the cities of the selected province and append to the select tag
           $.ajax({
               url: url,
               type: 'GET',
               data: {
                   id: id
               },
               success: function (data) {
                   $('#' + name).empty();
                   $('#' + name).append('<option>==Pilih Salah Satu==</option>');

                   $.each(data, function (key, value) {
                       $('#' + name).append('<option value="' + key + '">' + value + '</option>');
                   });
               }
           });
       }
       $(function () {
           $('#provinsi').on('change', function () {
               onChangeSelect('{{ route("cities") }}', $(this).val(), 'kota');
           });
           $('#kota').on('change', function () {
               onChangeSelect('{{ route("districts") }}', $(this).val(), 'kecamatan');
           })
           $('#kecamatan').on('change', function () {
               onChangeSelect('{{ route("villages") }}', $(this).val(), 'desa');
           })
       });
   </script>
@endsection

