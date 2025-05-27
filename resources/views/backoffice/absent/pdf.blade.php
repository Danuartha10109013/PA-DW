<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Presensi</title>
    <style>
      body {
          font-family: Arial, sans-serif;
          margin: 20px;
      }
      .header {
          text-align: center;
          margin-bottom: 20px;
      }
      .header img {
          /* max-width: 100px;
          margin-bottom: 10px;
          height: auto; */
      }
      .header h1 {
          margin: 0;
          font-size: 24px;
      }
      .header p {
          margin: 5px 0;
          font-size: 14px;
          color: #555;
      }
      table {
          width: 100%;
          border-collapse: collapse;
          margin-top: 20px;
      }
      th, td {
          border: 1px solid #000;
          padding: 8px;
          text-align: left;
      }
      th {
          background-color: #f2f2f2;
      }
      .footer {
          text-align: center;
          font-size: 12px;
          margin-top: 30px;
          color: #666;
      }
  </style>
</head>
<body>
    <div class="header">
      {{-- <img src="{{ asset('images/profile-default.jpg') }}" alt="Logo Perusahaan"> --}}
      <h1>{{ $office->name }}</h1>
      <p>{{ $office->address }}</p>
      {{-- <p>Telepon: 08123456789 | Email: info@perusahaan.com</p> --}}
    </div>
    <hr>
    <div>
      <p>Presensi Karyawan
        @if ($bulan && $tahun)
            @if ($bulan == 1)
                Januari
            @elseif ($bulan == 2)
                Februari
            @elseif ($bulan == 3)
                Maret
            @elseif ($bulan == 4)
                April
            @elseif ($bulan == 5)
                Mei
            @elseif ($bulan == 6)
                Juni
            @elseif ($bulan == 7)
                Juli
            @elseif ($bulan == 8)
                Agustus
            @elseif ($bulan == 9)
                September
            @elseif ($bulan == 10)
                Oktober
            @elseif ($bulan == 11)
                November
            @elseif ($bulan == 12)
                Desember
            @endif
            {{ $tahun }}            
        @endif
      </p>
    </div>
    <table>
      <thead>
        <tr>
          <th>No</th>
          <th>Karyawan</th>
          <th>Tanggal</th>
          <th>Jam Masuk</th>
          <th>Jam Pulang</th>
          <th>Status</th>
          <th>Metode Presensi</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($absents as $key => $absent)
          <tr>
            <td>{{ $key + 1 }}</td>
            <td>{{ $absent->user->name }}</td>
            <td>{{ $absent->date }}</td>
            <td>{{ $absent->start }}</td>
            <td>{{ $absent->end }}</td>
            <td>
                @if ($absent->status == 'wfh')
                    hadir
                @else
                    {{ $absent->status }}
                @endif
                @if ($absent->status_absent)
                    | {{ $absent->status_absent }}
                @endif
            </td>
            <td>{{ $absent->type }}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
    <div class="footer">
        © {{ date('Y') }} {{ $office->name }}
    </div>
</body>
</html>