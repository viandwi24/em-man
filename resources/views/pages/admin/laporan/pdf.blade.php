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
		table tr td, table tr th{ font-size: 8pt; }
    </style>

    <div class="text-center mb-4 mt-4">
        <h5>Laporan Karyawan</h4>
    </div>
    
    <table class='table table-bordered'>
        <thead>
            <tr>
                <th>#</th>
                <th>ID</th>
                <th>Nama</th>
                <th>Unit</th>
                <th>Outsourcing</th>
                <th>Bagian</th>
                <th>Jabatan</th>
                <th>Peringatan</th>
                <th>Cuti</th>
            </tr>
        </thead>
        <tbody>
            @php $i=1 @endphp
            @foreach($karyawans as $karyawan)
            <tr>
                <td>{{ $i++ }}</td>
                <td>{{ $karyawan->id }}</td>
                <td>{{ $karyawan->nama }}</td>
                <td>{{ $karyawan->unit->nama }}</td>
                <td>{{ $karyawan->outsourcing->nama }}</td>
                <td>{{ $karyawan->bagian->nama }}</td>
                <td>{{ $karyawan->jabatan->nama }}</td>
                <td>{{ ($karyawan->peringatan->count() == 0) ? '-' : $karyawan->peringatan->count() . 'x' }}</td>
                <td>{{ ($karyawan->cuti->count() == 0) ? '-' : $karyawan->cuti->count() . 'x' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>