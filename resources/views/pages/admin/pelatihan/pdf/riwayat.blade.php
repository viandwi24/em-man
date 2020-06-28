<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="stylesheet" href="{{ asset('assets/modules/bootstrap/css/bootstrap.min.css') }}">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    @include('pages.admin.pelatihan.pdf.css')
    <title>daftar-riwayat-personil</title>
</head>
<body>
    <footer>
        <span>PELATIHAN</span>
        <span class="right">
            {{ @$pelatihan->no_dokumentasi }}.11 /
            {{ @$pelatihan->no_revisi }} / 
            {{ @$pelatihan->terbit }}
        </span>
    </footer>

    <div class="content">
        <div>
            <img src="{{ asset('assets/img/header/daftar_riwayat.jpg') }}" width="100%" class="mb-2">
            {{-- <h5 class="text-center" style="padding-left: 11rem;">DAFTAR RIWAYAT PERSONIL</h5> --}}
            
            <div class="mb-4">
                <h6>I. IDENTITAS DIRI & KELUARGA</h6>
                <table style="border: none;width: 100%;">
                    <tr>
                        <td width="5%">1.</td>
                        <td>Nama Lengkap</td>
                        <td width="3%">:</td>
                        <td>{{ @$karyawan->nama }}</td>
                    </tr>
                    <tr>
                        <td width="5%">2.</td>
                        <td>Tempat & Tanggal Lahir</td>
                        <td width="3%">:</td>
                        <td>
                            {{ @$karyawan->tempat_lahir }},
                            {{ @$karyawan->tanggal_lahir }}
                        </td>
                    </tr>
                    <tr>
                        <td width="5%">3.</td>
                        <td>Pekerjaan</td>
                        <td width="3%">:</td>
                        <td>{{ @$karyawan->bagian->nama }}</td>
                    </tr>
                    <tr>
                        <td width="5%">4.</td>
                        <td>Alamat</td>
                        <td width="3%">:</td>
                        <td>{{ @$karyawan->alamat }}</td>
                    </tr>
                    <tr>
                        <td width="5%">5.</td>
                        <td>Jumlah Tanggungan</td>
                        <td width="3%">:</td>
                        <td>1</td>
                    </tr>
                    <tr style="vertical-align: top;">
                        <td width="5%">6.</td>
                        <td colspan="3">
                            Nama istri/suami dan anak-anak saudara (bilsa sudah meninggal sebutkan pendidikan dan perkejaan sebelumnya.)
                            <table class="table table-bordered">
                                <tr>
                                    <th>Nama</th>
                                    <th>Usia</th>
                                    <th>Pendidikan</th>
                                    <th>Keterangan</th>
                                </tr>
                                @if (count($karyawan->keluarga) == 0)
                                <tr>
                                    <td colspan="4" class="text-center">Tidak ada.</td>
                                </tr>
                                @endif
                                @foreach ($karyawan->keluarga as $keluarga)
                                    <tr>
                                        <td>{{ @$keluarga->nama }}</td>
                                        <td>{{ @$keluarga->usia }}</td>
                                        <td>{{ @$keluarga->pendidikan }}</td>
                                        <td>{{ @$keluarga->keterangan }}</td>
                                    </tr>
                                @endforeach
                            </table>
                        </td>
                    </tr>
                    <tr style="vertical-align: top;">
                        <td width="5%">6.</td>
                        <td colspan="3">
                            Nama Ayah/Ibu serta saudara kandung (bilsa sudah meninggal sebutkan pendidikan dan perkejaan sebelumnya.)
                            <table class="table table-bordered">
                                <tr>
                                    <th>Nama</th>
                                    <th>Usia</th>
                                    <th>Pendidikan</th>
                                    <th>Keterangan</th>
                                </tr>
                                @if (count($karyawan->orangtua) == 0)
                                <tr>
                                    <td colspan="4" class="text-center">Tidak ada.</td>
                                </tr>
                                @endif
                                @foreach ($karyawan->orangtua as $keluarga)
                                    <tr>
                                        <td>{{ @$keluarga->nama }}</td>
                                        <td>{{ @$keluarga->usia }}</td>
                                        <td>{{ @$keluarga->pendidikan }}</td>
                                        <td>{{ @$keluarga->keterangan }}</td>
                                    </tr>
                                @endforeach
                            </table>
                        </td>
                    </tr>
                </table>
            </div>

            <div class="mb-4">
                <h6>II. Pendidikan Terakhir</h6>

                <table style="border: none;width: 100%;">
                    <tr>
                        <td width="5%">1.</td>
                        <td>Jenjang</td>
                        <td width="3%">:</td>
                        <td>{{ $karyawan->pendidikan->jenjang }}</td>
                    </tr>
                    <tr>
                        <td width="5%">2.</td>
                        <td>Nama</td>
                        <td width="3%">:</td>
                        <td>{{ $karyawan->pendidikan->nama }}</td>
                    </tr>
                    <tr>
                        <td width="5%">3.</td>
                        <td>Jurusan</td>
                        <td width="3%">:</td>
                        <td>{{ $karyawan->pendidikan->jurusan }}</td>
                    </tr>
                    <tr>
                        <td width="5%">4.</td>
                        <td>Tahun lulus</td>
                        <td width="3%">:</td>
                        <td>{{ $karyawan->pendidikan->tahun_lulus }}</td>
                    </tr>
                    <tr>
                        <td width="5%">5.</td>
                        <td>Nomor Ijazah</td>
                        <td width="3%">:</td>
                        <td>{{ $karyawan->pendidikan->nomor_ijazah }}</td>
                    </tr>
                </table>
            </div>


            <div class="mb-4">
                <h6>III. Riwayat Pekerjaan</h6>
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
        </div>
    </div>
</body>
</html>