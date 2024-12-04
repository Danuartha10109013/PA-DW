@extends('backoffice.layout.main')

@section('content')

<meta name="csrf-token" content="{{ csrf_token() }}">

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Data Kantor / QR Code</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active">Data Kantor / QR Code</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<section class="content">

    <div class="row justify-content-center">
        <div class="col-md-12">
            {{-- <div class="card">
                <div class="card-header text-center">
                    <img src="{{ asset('images/office-default.jpg') }}" class="card-img-top" style="width: 80%; height: 200px" alt="...">
                    <p><b>Kantor / QR Code</b></p>
                </div>
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">This is a longer card with supporting text below as a natural lead-in to
                        additional content. This content is a little bit longer.</p>
                </div>
            </div> --}}
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">Kantor / QR Code</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-success btn-sm" data-toggle="modal"
                            data-target="#add" title="Tambah">
                            <i class="fa fa-add"></i> Tambah
                        </button>
                        @include('backoffice.office.modal.add')
                        
                    </div>
                </div>
                <div class="card-body">

                    @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" office="alert">
                        <strong class="ml-2 mr-2">Berhasil </strong> | {{ session('success') }}
                            <button type="button" class="close" style="margin-top: -17px" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif

                    <div class="row">
                        @foreach ($offices as $office)
                            <div class="col-md-4">
                                <div class="card card-outline card-primary">
                                    <div class="card-header text-center">
                                        <h3 class="card-title">{{ $office->name }}</h3>
                                        <div class="card-tools">

                                            {{-- download qrcode --}}
                                            <a href="/backoffice/office/{{ $office->id }}/download" class="btn btn-primary btn-sm">
                                                <i class="fa fa-download"></i> 
                                            </a>

                                            <a href="/backoffice/office/{{ $office->id }}/detail" class="btn btn-primary btn-sm">
                                                <i class="fa fa-eye"></i> 
                                            </a>
                                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                                data-target="#edit-{{ $office->id }}" title="Ubah">
                                                <span><i class="fa fa-edit"></i></span>
                                            </button>
                                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                                data-target="#delete-{{ $office->id }}" title="Hapus">
                                                <span><i class="fa fa-trash"></i></span>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="text-center">
                                            {!! QrCode::size(300)->generate($office->qrcode) !!}
                                            <hr>
                                            <p>{{ $office->address }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    {{-- modal --}}
                    @foreach ($offices as $office)
                        @include('backoffice.office.modal.edit')
                        @include('backoffice.office.modal.delete')
                    @endforeach

                </div>

            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        {{-- <div class="col-md-12">

            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">Kantor</h3>

                    <div class="card-tools">
                        <button title="Tambah" type="button" class="btn btn-success btn-sm" data-toggle="modal"
                            data-target="#tambah">
                            <span class="fa fa-plus"></span> Tambah
                        </button>

                        @if ($errors->any())
                        <script>
                            jQuery(function() {
                                        $('#tambah').modal('show');
                                    });
                        </script>
                        @endif

                        @include('backoffice.master-data.Kantor.modal.add')

                        
                    </div>

                </div>
                <div class="card-body">

                    @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" Kantor="alert">
                        <strong>Berhasil </strong>{{ session('success') }}
          <button type="button" class="close"  data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif

                    <table class="table table-bordered table-hover text-center" id="myTable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Kantor</th>
                                <th>Mulai</th>
                                <th>Selesai</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach($offices as $key => $office)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $office->name }}</td>
                                <td>{{ $office->start }}</td>
                                <td>{{ $office->end }}</td>
                                <td>
                                    <button class="btn btn-warning btn-sm" data-toggle="modal"
                                        data-target="#edit-{{ $office->id }}" title="Ubah">
                                        <i class="fa fa-edit"></i> Ubah
                                    </button>
                                    <button class="btn btn-danger btn-sm" data-toggle="modal"
                                        data-target="#delete-{{ $office->id }}" title="Hapus">
                                        <i class="fa fa-trash"></i> Hapus
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    @foreach ($offices as $office)
                    @include('backoffice.master-data.Kantor.modal.edit')
                    @include('backoffice.master-data.Kantor.modal.delete')
                    @endforeach

                </div>

            </div>

        </div> --}}
        {{-- <div class="col-md-12">
            <div id="map" style="height: 400px"></div>
        </div> --}}
    </div>

</section>

{{-- <script>
    const map = L.map('map').setView([51.505, -0.09], 13);
    
        const tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);
    
        const marker = L.marker([51.5, -0.09]).addTo(map)
            .bindPopup('<b>Hello world!</b><br />I am a popup.').openPopup();
    
        const circle = L.circle([51.508, -0.11], {
            color: 'red',
            fillColor: '#f03',
            fillOpacity: 0.5,
            radius: 500
        }).addTo(map).bindPopup('I am a circle.');
    
        const polygon = L.polygon([
            [51.509, -0.08],
            [51.503, -0.06],
            [51.51, -0.047]
        ]).addTo(map).bindPopup('I am a polygon.');
    
    
        const popup = L.popup()
            .setLatLng([51.513, -0.09])
            .setContent('I am a standalone popup.')
            .openOn(map);
    
        function onMapClick(e) {
            popup
                .setLatLng(e.latlng)
                .setContent(`You clicked the map at ${e.latlng.toString()}`)
                .openOn(map);
        }
    
        map.on('click', onMapClick);
    
</script> --}}

{{-- <script>
    const map = L.map('map').setView([-6.239028847049527, 106.79918337392736], 13);
    
        const tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);

        // start marker
        var marker = L.marker([-6.239028847049527, 106.79918337392736])
                        .bindPopup('Tampilan pesan disini')
                        .addTo(map);
        
        var iconMarker = L.icon({
            iconUrl: 'https://cdn0.iconfinder.com/data/icons/small-n-flat/24/678111-map-marker-512.png',
            iconSize:     [50, 50], // size of the icon
            iconAnchor:   [25, 50], // point of the icon which will correspond to marker's location
            popupAnchor:  [-3, -76] // point from which the popup should open relative to the iconAnchor
        });

        var marker2 = L.marker([-6.25669089852724, 106.79641151260287], {
            icon: iconMarker,
            draggable: false
        })
        .bindPopup('homebase')
        .addTo(map);
        // end marker

        // start circle
        var circle = L.circle([-6.239028847049527, 106.79918337392736], {
            color: 'red',
            fillColor: '#f03',
            fillOpacity: 0.5,
            radius: 500
        }).addTo(map).bindPopup('I am a circle.');
        // end circle
    
</script> --}}

@endsection