@extends('backoffice.layout.main')

@section('content')

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Detail Kantor / QR Code</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active">Detail Kantor / QR Code</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<section class="content">

    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">Kantor / QR Code</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                            data-target="#generate-{{ $office->id }}" title="Generate">
                            <span><i class="fa fa-qrcode"></i></span>
                        </button>
                        @include('backoffice.office.modal.generate')
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                            data-target="#edit-{{ $office->id }}" title="Ubah">
                            <span><i class="fa fa-edit"></i></span>
                        </button>
                        @include('backoffice.office.modal.edit')
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                            data-target="#delete-{{ $office->id }}" title="Hapus">
                            <span><i class="fa fa-trash"></i></span>
                        </button>
                        @include('backoffice.office.modal.delete')
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

                    <div class="row">
                        <div class="col-md-6">
                            <div class="row text-center">
                                <div class="col-md-6">
                                    @if ($office->image)
                                        <img src="{{ asset('storage/' . $office->image) }}" class="card-img-top" style="width: 80%; height: 300px" alt="...">
                                    @else
                                        <img src="{{ asset('images/office-default.avif') }}" class="card-img-top" style="width: 80%; height: 300px" alt="...">
                                    @endif
                                </div>
                                <div class="col-md-6">
                                    {!! QrCode::size(300)->generate($office->qrcode) !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="callout callout-info bg-light p-4">
                                <b>Nama Kantor: </b> {{ $office->name }} <br>
                                <b>Alamat Kantor: </b> {{ $office->address }} <br>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </div>
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

<script>
    const map = L.map('map').setView([{{ $office->latitude }}, {{ $office->longitude }}], 13);
    
        const tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);

        // start marker
        var marker = L.marker([{{ $office->latitude }}, {{ $office->longitude }}])
                        .bindPopup('Tampilan pesan disini')
                        .addTo(map);
        // end marker

        // start circle
        var circle = L.circle([{{ $office->latitude }}, {{ $office->longitude }}], {
            color: 'red',
            fillColor: '#f03',
            fillOpacity: 0.5,
            radius: {{ $office->radius * 2 }}
        }).addTo(map).bindPopup('I am a circle.');
        // end circle
    
</script>

@endsection