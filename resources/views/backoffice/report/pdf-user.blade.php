<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Detail Presensi Karyawan</title>
    <style>
        @page {
            size: A4;
            margin: 20mm 25mm;
        }

        body {
            font-family: Arial, sans-serif;
            font-size: 13px;
            color: #000;
        }

        .title {
            text-align: center;
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 20px;
            text-transform: uppercase;
        }

        table.profile-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }

        table.profile-table td {
            vertical-align: top;
            padding: 5px 10px;
        }

        .info-table {
            width: 100%;
        }

        .info-table td {
            padding: 5px 0;
        }

        .info-table td:first-child {
            width: 150px;
            font-weight: bold;
        }

        .badge-warning {
            background-color: #ffc107;
            color: #000;
            padding: 2px 6px;
            border-radius: 4px;
            font-size: 12px;
        }

        .foto-box {
            text-align: center;
        }

        .foto-box img {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 8px;
            border: 1px solid #aaa;
        }

        .rekap-title {
            background-color: #0a4b94;
            color: #fff;
            padding: 8px;
            text-align: center;
            font-weight: bold;
            border-radius: 4px 4px 0 0;
        }

        table.rekap-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 12px;
        }

        .rekap-table th, .rekap-table td {
            border: 1px solid #000;
            padding: 6px;
            text-align: left;
        }

        .rekap-table th {
            background-color: #f0f0f0;
            width: 60%;
        }

        #section-footer {
            margin-top: 50px;
        }

        .signature {
            text-align: right;
            margin-right: 30px;
            font-size: 13px;
        }

        .signature p {
            margin: 4px 0;
        }

        .footer {
            text-align: center;
            margin-top: 60px;
            font-size: 11px;
            color: #999;
        }
    </style>
</head>
<body>
  @php
      $bulan = request('bulan');
      $tahun = request('tahun');

      $tepat_waktu_wfo = \App\Models\Absent::where('user_id', $user->id)->where('status', 'hadir')->where('status_absent', 'tepat waktu')->whereMonth('created_at', $bulan)->whereYear('created_at', $tahun)->count();
      $telat_wfo = \App\Models\Absent::where('user_id', $user->id)->where('status', 'hadir')->where('status_absent', 'telat')->whereMonth('created_at', $bulan)->whereYear('created_at', $tahun)->count();
      $tepat_waktu_wfh = \App\Models\Absent::where('user_id', $user->id)->where('status', 'wfh')->where('status_absent', 'tepat waktu')->whereMonth('created_at', $bulan)->whereYear('created_at', $tahun)->count();
      $telat_wfh = \App\Models\Absent::where('user_id', $user->id)->where('status', 'wfh')->where('status_absent', 'telat')->whereMonth('created_at', $bulan)->whereYear('created_at', $tahun)->count();
      $cuti_setuju = \App\Models\Submission::where('user_id', $user->id)->where('type', 'cuti')->where('status', 'Disetujui')->whereMonth('created_at', $bulan)->whereYear('created_at', $tahun)->count();
      $cuti_tolak = \App\Models\Submission::where('user_id', $user->id)->where('type', 'cuti')->where('status', 'Ditolak')->whereMonth('created_at', $bulan)->whereYear('created_at', $tahun)->count();
      $sakit_setuju = \App\Models\Submission::where('user_id', $user->id)->where('type', 'sakit')->where('status', 'Disetujui')->whereMonth('created_at', $bulan)->whereYear('created_at', $tahun)->count();
      $sakit_tolak = \App\Models\Submission::where('user_id', $user->id)->where('type', 'sakit')->where('status', 'Ditolak')->whereMonth('created_at', $bulan)->whereYear('created_at', $tahun)->count();
      $izin_setuju = \App\Models\Submission::where('user_id', $user->id)->where('type', 'izin')->where('status', 'Disetujui')->whereMonth('created_at', $bulan)->whereYear('created_at', $tahun)->count();
      $izin_tolak = \App\Models\Submission::where('user_id', $user->id)->where('type', 'izin')->where('status', 'Ditolak')->whereMonth('created_at', $bulan)->whereYear('created_at', $tahun)->count();
      $wfh_setuju = \App\Models\Submission::where('user_id', $user->id)->where('type', 'wfh')->where('status', 'Disetujui')->whereMonth('created_at', $bulan)->whereYear('created_at', $tahun)->count();
      $wfh_tolak = \App\Models\Submission::where('user_id', $user->id)->where('type', 'wfh')->where('status', 'Ditolak')->whereMonth('created_at', $bulan)->whereYear('created_at', $tahun)->count();
  @endphp

  <div class="container">
    <div class="title">Detail Karyawan</div>

    <table class="profile-table">
        <tr>
            <td>
                <table class="info-table">
                    <tr><td>Nama</td><td>: {{ $user->name }}</td></tr>
                    <tr><td>Email</td><td>: {{ $user->email }}</td></tr>
                    <tr><td>Peran</td><td>: {{ $user->role->name }}</td></tr>
                    <tr>
                        <td>Jenis Kelamin</td>
                        <td>:
                            @if (!$user->gender)
                                <span class="badge-warning">Belum melengkapi data</span>
                            @else
                                {{ $user->gender }}
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>Agama</td>
                        <td>:
                            @if (!$user->religion)
                                <span class="badge-warning">Belum melengkapi data</span>
                            @else
                                {{ $user->religion }}
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>Tempat, Tgl Lahir</td>
                        <td>:
                            @if (!$user->place_birth && !$user->date_birth)
                                <span class="badge-warning">Belum melengkapi data</span>
                            @else
                                {{ $user->place_birth }}, {{ date('d F Y', strtotime($user->date_birth)) }}
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>Alamat</td>
                        <td>:
                            @if (!$user->address)
                                <span class="badge-warning">Belum melengkapi data</span>
                            @else
                                {{ $user->address }}
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>No HP</td>
                        <td>:
                            @if (!$user->no_hp)
                                <span class="badge-warning">Belum melengkapi data</span>
                            @else
                                {{ $user->no_hp }}
                            @endif
                        </td>
                    </tr>
                </table>
            </td>
            <td class="foto-box">
                @if ($user->foto && file_exists(public_path('storage/'.$user->foto)))
                    <img src="{{ public_path('storage/'.$user->foto) }}" alt="Foto Karyawan">
                @else
                    <img src="{{ public_path('images/profile-default.jpg') }}" alt="Foto Default">
                @endif
            </td>
        </tr>
    </table>

    <div class="rekap-title">Rekap Presensi </div>
    <table class="rekap-table">
        <tr><th>WFO - Tepat Waktu</th><td>{{ $tepat_waktu_wfo }}</td></tr>
        <tr><th>WFO - Telat</th><td>{{ $telat_wfo }}</td></tr>
        <tr><th>WFH - Tepat Waktu</th><td>{{ $tepat_waktu_wfh }}</td></tr>
        <tr><th>WFH - Telat</th><td>{{ $telat_wfh }}</td></tr>
        <tr><th>Cuti Disetujui</th><td>{{ $cuti_setuju }}</td></tr>
        <tr><th>Cuti Ditolak</th><td>{{ $cuti_tolak }}</td></tr>
        <tr><th>Sakit Disetujui</th><td>{{ $sakit_setuju }}</td></tr>
        <tr><th>Sakit Ditolak</th><td>{{ $sakit_tolak }}</td></tr>
        <tr><th>Izin Disetujui</th><td>{{ $izin_setuju }}</td></tr>
        <tr><th>Izin Ditolak</th><td>{{ $izin_tolak }}</td></tr>
        <tr><th>Pengajuan WFH Disetujui</th><td>{{ $wfh_setuju }}</td></tr>
        <tr><th>Pengajuan WFH Ditolak</th><td>{{ $wfh_tolak }}</td></tr>
        <tr><th>Cuti Diambil</th><td>{{ $user->countCutiPerTahun($user->id, now()->format('Y')) }} hari</td></tr>
        <tr><th>Sisa Cuti</th><td>{{ 12 - $user->countCutiPerTahun($user->id, now()->format('Y')) }} hari</td></tr>
    </table>

    <div id="section-footer">
        <div class="signature">
            <p>Purwakarta, {{ \Carbon\Carbon::now()->locale('id')->isoFormat('D MMMM Y') }}</p>
            <p>Human Resource Development</p><br><br><br>
            <p><strong>AHMAD KURNAEPI</strong></p>
        </div>
        <div class="footer">
            © {{ date('Y') }} {{ $office->name }}
        </div>
    </div>
</body>
</html>