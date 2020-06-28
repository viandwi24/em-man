<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="stylesheet" href="{{ asset('assets/modules/bootstrap/css/bootstrap.min.css') }}">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    @include('pages.admin.pelatihan.pdf.css')
    <title>usulan-kegiatan-pelatihan</title>
</head>
<body>
    <footer>
        <span>PELATIHAN</span>
        <span class="right">
            {{ @$pelatihan->no_dokumentasi }}.05 /
            {{ @$pelatihan->no_revisi }} / 
            {{ @$pelatihan->terbit }}
        </span>
    </footer>

    <div class="content">
        <div>
            {{-- <h5 class="text-center" style="padding-left: 10rem;">USULAN KEGIATAN PELATIHAN</h5> --}}
            <img src="{{ asset('assets/img/header/usulan.jpg') }}" width="100%">
        </div>
        <table class="table">
            <tr>
                <td class="p-0">
                    <table class="table table-bordered">
                        <tr class="highlight">
                            <th>No.</th>
                            <th>Nama Karyawan</th>
                            <th>Jabatan</th>
                            <th>Pelatihan Yang Diusulkan</th>
                            <th>Hasil Yang Diharapkan</th>
                            <th>Waktu Pelatihan</th>
                        </tr>

                        <tr>
                            <td>1</td>
                            <td>{{ @$pelatihan->karyawan[0]->nama }}</td>
                            <td>{{ @$pelatihan->karyawan[0]->jabatan->nama }}</td>
                            <td rowspan="11">
                                <ul>
                                    @foreach ($pelatihan->materi as $materi)
                                        <li>{{ $materi }}</li>
                                    @endforeach
                                </ul>
                            </td>
                            <td rowspan="11">{{ @$pelatihan->usulan->hasil }}</td>
                            <td rowspan="11">{{ @$pelatihan->pelatihan }}</td>
                        </tr>
            
                        @php $i = 1; @endphp
                        @foreach ($pelatihan->karyawan as $karyawan)
                            @php if ($i == 1) { $i++; continue; } @endphp
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $karyawan->nama }}</td>
                                <td>{{ $karyawan->jabatan->nama }}</td>
                            </tr>                
                        @endforeach

                        @for ($j = 0; $j < (12-$i); $j++)
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        @endfor
                    </table>
                </td>
            </tr>
        </table>


        <div style="position: relative;">
            <div style="width: 50%;display: block;position: absolute;left: 50%;transform: translateX(-50%);">
                <table class="table table-bordered text-center">
                    <tr>
                        <td>Disetujui Oleh</td>
                        <td>Diajukan Oleh</td>
                    </tr>
                    <tr>
                        <td>{{ $pelatihan->disetujui_jabatan }}</td>
                        <td>{{ $pelatihan->dibuat_jabatan }}</td>
                    </tr>
                    <tr>
                        <td style="height: 50px;"></td>
                        <td style="height: 50px;"></td>
                    </tr>
                    <tr>
                        <td>{{ $pelatihan->disetujui }}</td>
                        <td>{{ $pelatihan->dibuat }}</td>
                    </tr>
                </table>
            </div>
        </div>
        
    </div>    
</body>
</html>