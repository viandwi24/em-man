<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="stylesheet" href="{{ asset('assets/modules/bootstrap/css/bootstrap.min.css') }}">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    @include('pages.admin.pelatihan.pdf.css')
    <title>evaluasi</title>
</head>
<body>
    <footer>
        <span>PELATIHAN</span>
        <span class="right">
            {{ @$pelatihan->no_dokumentasi }}.10 /
            {{ @$pelatihan->no_revisi }} / 
            {{ @$pelatihan->terbit }}
        </span>
    </footer>

    <div class="content">
        <div>
            <img src="{{ asset('assets/img/header/evaluasi.jpg') }}" width="100%" class="mb-2">
            <h5 class="text-center" style="padding-left: 11rem;">EVALUASI PELATIHAN</h5>

            <table class="table table-bordered">
                <tr>
                    <th>Jenis Pelatihan</th>
                    <td width="3%">:</td>
                    <td>{{ @$pelatihan->nama }}</td>
                </tr>
                <tr>
                    <th>Lokasi</th>
                    <td width="3%">:</td>
                    <td>{{ @$pelatihan->lokasi }}</td>
                </tr>
                <tr>
                    <th>Instruktur</th>
                    <td width="3%">:</td>
                    <td>{{ @$pelatihan->instruktur }}</td>
                </tr>
                <tr>
                    <th>Tanggal</th>
                    <td width="3%">:</td>
                    <td>{{ @$pelatihan->pelatihan }}</td>
                </tr>
                <tr>
                    <th>Peserta</th>
                    <td width="3%">:</td>
                    <td>
                        <ul>
                            @foreach (@$pelatihan->karyawan as $karyawan)
                                <li>{{ $karyawan->nama }}</li>
                            @endforeach
                        </ul>
                    </td>
                </tr>
                <tr>
                    <th>Materi Pelatihan</th>
                    <td width="3%">:</td>
                    <td>
                        <ul>
                            @foreach (@$pelatihan->materi as $materi)
                                <li>{{ $materi }}</li>
                            @endforeach
                        </ul>
                    </td>
                </tr>
                <tr>
                    <th>Hasil</th>
                    <td width="3%">:</td>
                    <td>{{ @$pelatihan->evaluasi->hasil }}</td>
                </tr>
                <tr>
                    <th>Evaluasi</th>
                    <td width="3%">:</td>
                    <td>{{ @$pelatihan->evaluasi->evaluasi }}</td>
                </tr>
            </table>
            
            <div>
                <div class="mt-4 text-center float-right" style="width: 35%;">
                    <p>Bagian Administrasi</p>
                    <div style="height: 50px">&nbsp;</div>
                    <p>{{ @$pelatihan->dibuat }}</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>