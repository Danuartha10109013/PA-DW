@extends('backoffice.layout.main')

@section('content')

<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Detail Presensi Saya</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item active">Detail Presensi Saya</li>
          </ol>
        </div>
      </div>
    </div>
</section>

<section class="content">

    <div class="row justify-content-center">
        <div class="col-md-12">

            <!-- Default box -->
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">Detail Presensi</h3>

                    <div class="card-tools">
                        
                    </div>

                </div>
                <div class="card-body">

                    @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" absent="alert">
                        <strong>Berhasil </strong>{{ session('success') }}
          <button type="button" class="close"  data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif

                    <div class="row">
                        <div class="col-md-6">
                            <div class="card card-outline card-primary bg-light">
                                <div class="card-body">
                                    <h4 class="text-center">Lokasi Koordinat Presensi</h4>
                                    <div id="map" style="height: 400px"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">

                            @if ($absent->status != 'Absen')
                                <div class="card bg-warning">
                                    <div class="card-body">
                                        <h3>
                                            <b>Anda sedang {{ $absent->status }}</b>
                                        </h3>
                                        <b>Keterangan:</b> {{ $absent->description }}
                                    </div>
                                </div>
                            @endif

                            <div class="card card-outline card-primary bg-light">
                                <div class="card-body">

                                    <p>Hari: <b>{{  \Carbon\Carbon::parse($absent->date)->locale('id')->isoFormat('dddd, D MMMM YYYY') }}</b></p>
                                    <p>Nama Kantor: <b>{{ $absent->office->name }}</b></p>
                                    <p>Alamat Kantor: <b>{{ $absent->office->address }}</b></p>
                                    <p>Radius Kantor: <b>{{ $absent->office->radius }} Meter</b></p>
                                    <p>Jadwal Shift: 
                                        <b>
                                            @if ($absent->shift_id == null)
                                                
                                            @else
                                                {{ $absent->shift->name }} | {{ $absent->shift->start }} - {{ $absent->shift->end }}
                                            @endif
                                        </b>
                                    </p>
                                    <p>Jam Masuk: <b>{{ $absent->start }}</b></p>
                                    <p>Jam Keluar: <b>{{ $absent->end }}</b></p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </div>
    </div>

    <script>
        const map = L.map('map').setView([{{ $absent->office->latitude }}, {{ $absent->office->longitude }}], 13);
        
            const tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
            }).addTo(map);
    
            // start marker
            var marker = L.marker([{{ $absent->office->latitude }},{{ $absent->office->longitude }}])
                            .bindPopup('Lokasi kantor')
                            .addTo(map);
                    
            var iconMarker = L.icon({
                iconUrl: 'https://cdn0.iconfinder.com/data/icons/small-n-flat/24/678111-map-marker-512.png',
                iconSize:     [50, 50], // size of the icon
                iconAnchor:   [25, 50], // point of the icon which will correspond to marker's location
                popupAnchor:  [-3, -76] // point from which the popup should open relative to the iconAnchor
            });

            // var marker2 = L.marker([ -6.239028847049527 ,  106.79918337392736 ], {
            //     icon: iconMarker,
            //     draggable: false
            // })
            // .bindPopup('Lokasi Anda')
            // .addTo(map);


            // get location user
            // navigator.geolocation.getCurrentPosition(function(position) {
            //     var latitude = position.coords.latitude;
            //     var longitude = position.coords.longitude;
            //     console.log(latitude, longitude);
            //     document.getElementById('latitudeSpan').innerHTML = latitude;
            //     document.getElementById('longitudeSpan').innerHTML = longitude;
            //     document.getElementById('latitude').value = latitude;
            //     document.getElementById('longitude').value = longitude;

            //     var marker2 = L.marker([latitude, longitude], {
            //         icon: iconMarker,
            //         draggable: false
            //     })
            //     .bindPopup('Lokasi Anda')
            //     .addTo(map);
            // });


            // end marker

            // start circle
            var circle = L.circle([ -6.239028847049527 ,  106.79918337392736 ], {
                color: 'red',
                fillColor: '#f03',
                fillOpacity: 0.5,
                radius: {{ $absent->office->radius * 2 }}
            }).addTo(map).bindPopup('Radius Kantor');
            // end circle
        
    </script>

</section>

@endsection