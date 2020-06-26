<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="stylesheet" href="{{ asset('assets/modules/bootstrap/css/bootstrap.min.css') }}">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    @include('pages.admin.pelatihan.pdf.css')
    <style>
        table tr th, table thead * , table tr td {
            font-size: 14pt!important;
        }
    </style>
    <title>sertifikat</title>
</head>
<body>
    <footer>
        <span>PELATIHAN</span>
        <span class="right">
            {{ @$pelatihan->no_dokumentasi }}.13 /
            {{ @$pelatihan->no_revisi }} / 
            {{ @$pelatihan->terbit }}
        </span>
    </footer>

    <div class="content">
        <div>
            <h2 class="text-center" style="padding-left: 11rem;">SERTIFIKAT</h2>
            <hr>

            <p>Sertifikat ini diberikan kepada :</p>
            <div>
                <table style="width: 100%;">
                    <tr>
                        <th width="15%">Nama</th>
                        <td width="5%">:</td>
                        <td>{{ @$karyawan->nama }}</td>
                    </tr>
                    <tr>
                        <th width="15%">Bagian</th>
                        <td width="5%">:</td>
                        <td>{{ @$karyawan->bagian->nama }}</td>
                    </tr>
                </table>
            </div>     
            
            <p class="mt-4">Telah mengikuti pelatihan :</p>
            <div>
                <ul>
                    @foreach (@$pelatihan->materi as $materi)
                        <li>{{ $materi }}</li>
                    @endforeach
                </ul>
            </div>

            <p>
                Yang dilaksanakan pada tanggal {{ @$pelatihan->pelatihan->format('d-m-Y') }} di
                {{ @env('COMPANY_NAME', 'EM-MAN') }}.
            </p>


            <div style="position: absolute;bottom:0;margin-bottom:10rem;">
                <div class="text-right">
                    {{ @env('COMPANY_NAME', 'EM-MAN') }},  {{ @$pelatihan->pelatihan->format('d-m-Y') }}
                </div>
                <div class="text-center float-left" style="width: 20%;">
                    <p>Instruktur</p>
                    <div style="height: 50px">&nbsp;</div>
                    <p>{{ @$pelatihan->instruktur }}</p>
                </div>
                <div class="text-center float-right" style="width: 35%;">
                    <p>{{ @$pelatihan->dibuat_jabatan }}</p>
                    <div style="height: 50px">&nbsp;</div>
                    <p>{{ @$pelatihan->dibuat }}</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>