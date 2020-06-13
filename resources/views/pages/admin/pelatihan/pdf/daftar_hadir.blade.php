<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="stylesheet" href="{{ asset('assets/modules/bootstrap/css/bootstrap.min.css') }}">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    @include('pages.admin.pelatihan.pdf.css')
    <title>daftar-hadir</title>
</head>
<body>
    <footer>
        <span>PELATIHAN</span>
        <span class="right">
            {{ @$pelatihan->no_dokumentasi }}.08 /
            {{ @$pelatihan->no_revisi }} / 
            {{ @$pelatihan->terbit }}
        </span>
    </footer>

    <div class="content">
        <div>
            <h5 class="text-center" style="padding-left: 11rem;">DAFTAR HADIR PELATIHAN</h5>

            <table class="table table-bordered">
                <tr>
                    <th>No</th>
                    <th class="text-center">Nama</th>
                    <th class="text-center">Jabatan</th>
                    <th class="text-center">Tanda Tangan</th>
                </tr>

                @php $i = 1; @endphp
                @foreach ($pelatihan->karyawan as $karyawan)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ $karyawan->nama }}</td>
                        <td>{{ $karyawan->jabatan->nama }}</td>
                        <td></td>
                    </tr>
                @endforeach

                @for ($j = 0; $j < (18-$i); $j++)
                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                @endfor
            </table>

            <div>
                <div class="mt-4 text-center float-right" style="padding-right: -11rem;width: 35%;">
                    <p>Instruktur / Pembimbing</p>
                    <div style="height: 50px">&nbsp;</div>
                    <p>{{ @$pelatihan->instruktur }}</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>