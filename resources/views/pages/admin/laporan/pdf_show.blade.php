<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PDF</title>
    <link rel="stylesheet" href="{{ asset('assets/modules/bootstrap/css/bootstrap.min.css') }}">
</head>
<body>
    <style type="text/css">
		table tr td, table tr th{ font-size: 9pt; }
    </style>

    <div class="text-center mb-4 mt-4">
        <h5>Data Karyawan</h4>
    </div>
    
    <div>
        <h6>1. DATA PRIBADI</h6>
        <table>
            <tr>
                <td width="50%">
                    <table>
                        <tr>
                            <th style="padding-right: 2rem;">ID</th>
                            <td>: {{ $karyawan->id }}</td>
                        </tr>
                        <tr>
                            <th style="padding-right: 2rem;">Nama</th>
                            <td>: {{ $karyawan->nama }}</td>
                        </tr>
                        <tr>
                            <th style="padding-right: 2rem;">NIK</th>
                            <td>: {{ $karyawan->nik }}</td>
                        </tr>
                        <tr>
                            <th style="padding-right: 2rem;">Tempat Lahir</th>
                            <td>: {{ $karyawan->tempat_lahir }}</td>
                        </tr>
                        <tr>
                            <th style="padding-right: 2rem;">Tanggal Lahir</th>
                            <td>: {{ $karyawan->tanggal_lahir }}</td>
                        </tr>
                        <tr>
                            <th style="padding-right: 2rem;">Alamat</th>
                            <td>: {{ $karyawan->alamat }}</td>
                        </tr>
                        <tr>
                            <th style="padding-right: 2rem;">Tanggal Masuk Kerja</th>
                            <td>: {{ $karyawan->tanggal_masuk }}</td>
                        </tr>
                    </table>
                </td>
                <td width="50%" style="text-align: right;padding-left: 15rem;">
                    <img alt="image" src="{{ url()->route('foto_karyawan', [$karyawan->foto]) }}" width="150" style="display: inline-block;">
                </td>
            </tr>
        </table>
    </div>

    <div style="margin-top: 2rem;">
        <h6>2. Pendidikan Terakhir</h6>

        <table>
            <tr>
                <th style="padding-right: 2rem;">Jenjang</th>
                <td>: {{ $karyawan->pendidikan->jenjang }}</td>
            </tr>
            <tr>
                <th style="padding-right: 2rem;">Nama</th>
                <td>: {{ $karyawan->pendidikan->nama }}</td>
            </tr>
            <tr>
                <th style="padding-right: 2rem;">Jurusan</th>
                <td>: {{ $karyawan->pendidikan->jurusan }}</td>
            </tr>
            <tr>
                <th style="padding-right: 2rem;">Tahun lulus</th>
                <td>: {{ $karyawan->pendidikan->tahun_lulus }}</td>
            </tr>
            <tr>
                <th style="padding-right: 2rem;">Nomor Ijazah</th>
                <td>: {{ $karyawan->pendidikan->nomor_ijazah }}</td>
            </tr>
        </table>
    </div>


    <div style="margin-top: 2rem;">
        <h6>3. Riwayat Pekerjaan</h6>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Tanggal</th>
                    <th>Bagian</th>
                    <th>Jabatan</th>
                </tr>
            </thead>
            <tbody>
                @php $i = 1; @endphp
                @foreach ($karyawan->mutasi as $item)
                <tr>
                    <td>{{ $i }}</td>
                    <td>{{ $item->tanggal }}</td>
                    <td>{{ $item->bagian->nama }}</td>
                    <td>{{ $item->jabatan->nama }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div style="margin-top: 2rem;">
        <h6>4. Riwayat Peringatan</h6>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Tanggal</th>
                    <th>Nomor</th>
                    <th>Perihal</th>
                </tr>
            </thead>
            <tbody>
                @php $i = 1; @endphp
                @foreach ($karyawan->peringatan as $item)
                    <td>{{ $i }}</td>
                    <td>{{ $item->tanggal_pelanggaran }}</td>
                    <td>{{ $item->nomor }}</td>
                    <td>{{ $item->perihal }}</td>
                @endforeach
            </tbody>
        </table>
    </div>

    <div style="margin-top: 2rem;">
        <h6>5. Riwayat Cuti</h6>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Tanggal Cuti</th>
                    <th>Lama Cuti</th>
                    <th>Alasan</th>
                </tr>
            </thead>
            <tbody>
                @php $i = 1; @endphp
                @foreach ($karyawan->cuti as $item)
                    <td>{{ $i }}</td>
                    <td>{{ $item->tanggal_cuti }}</td>
                    <td>
                        @php
                            $to = \Carbon\Carbon::parse($item->tanggal_masuk);
                            $from = \Carbon\Carbon::parse($item->tanggal_cuti);
                            $diff_in_days = $to->diffInDays($from);
                            echo $diff_in_days;
                        @endphp
                        Hari
                    </td>
                    <td>{{ $item->alasan }}</td>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>