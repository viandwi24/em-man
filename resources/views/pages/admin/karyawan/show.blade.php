@extends('layouts.admin')

@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Detail Karyawan</h4>
            </div>
            <form>
                @csrf
                @method('put')
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-3 mb-4">
                            <img alt="image" src="{{ url()->route('foto_karyawan', [$karyawan->foto]) }}" class="img-fluid border" id="image">
                        </div>

                        <div class="col-lg-9">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="umum-tab" data-toggle="tab" href="#umum">Data Umum</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pendidikan-tab" data-toggle="tab" href="#pendidikan">Pendidikan</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="karyawan-tab" data-toggle="tab" href="#karyawan">Detail Karyawan</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="cuti-tab" data-toggle="tab" href="#cuti">Riwayat Cuti</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="peringatan-tab" data-toggle="tab" href="#peringatan">Riwayat Peringatan</a>
                                </li>
                            </ul>

                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="umum" role="tabpanel" aria-labelledby="umum-tab">
                                    <div class="row">
                                        <div class="col-lg-12 col-sm-12">
                                            <div class="form-group">
                                                <label>Nama Lengkap</label>
                                                <input readonly value="{{ $karyawan->nama }}" type="text" name="nama" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4 col-sm-6">
                                            <div class="form-group">
                                                <label>Tempat Lahir</label>
                                                <input readonly value="{{ $karyawan->tempat_lahir }}" type="text" name="tempat_lahir" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-sm-6">
                                            <div class="form-group">
                                                <label>Tanggal Lahir</label>
                                                <input readonly value="{{ $karyawan->tanggal_lahir }}" name="tanggal_lahir" type="text" class="form-control datepicker">
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-sm-12">
                                            <div class="form-group">
                                                <label>Nik</label>
                                                <input readonly value="{{ $karyawan->nik }}" type="text" name="nik" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6 col-sm-12">
                                            <div class="form-group">
                                                <label>Alamat</label>
                                                <input readonly value="{{ $karyawan->alamat }}" type="text" name="alamat" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-sm-12">
                                            <div class="form-group">
                                                <label>Tanggal Masuk Kerja</label>
                                                <input readonly value="{{ $karyawan->tanggal_masuk }}" type="text" name="tanggal_masuk" class="form-control datepicker">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="pendidikan" role="tabpanel" aria-labelledby="pendidikan-tab">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label>Jenjang</label>
                                                <input readonly value="{{ $karyawan->pendidikan->jenjang }}" placeholder="Ex: SMA, SMK, KULIAH..." type="text" name="jenjang" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6 col-sm-12">
                                            <div class="form-group">
                                                <label>Nama</label>
                                                <input readonly value="{{ $karyawan->pendidikan->nama }}" placeholder="Ex: SMKN 1 ... Universitas ..." type="text" name="nama_tempat" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-sm-12">
                                            <div class="form-group">
                                                <label>Jurusan</label>
                                                <input readonly value="{{ $karyawan->pendidikan->jurusan }}" type="text" name="jurusan" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6 col-sm-12">
                                            <div class="form-group">
                                                <label>Nomor Ijazah</label>
                                                <input readonly value="{{ $karyawan->pendidikan->nomor_ijazah }}" type="text" name="nomor_ijazah" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-sm-12">
                                            <div class="form-group">
                                                <label>Tahun Lulus</label>
                                                <input readonly value="{{ $karyawan->pendidikan->tahun_lulus }}" type="text" name="tahun_lulus" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="karyawan" role="tabpanel" aria-labelledby="karyawan-tab">
                                    <div class="row">
                                        <div class="col-lg-6 col-sm-12">
                                            <div class="form-group">
                                                <label>Unit</label>
                                                <div>
                                                    <input readonly value="{{ $karyawan->unit->nama }}" type="text" name="unit" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-sm-12">
                                            <div class="form-group">
                                                <label>Outsourcing</label>
                                                <div>
                                                    <input readonly value="{{ $karyawan->outsourcing->nama }}" type="text" name="outsourcing" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6 col-sm-12">
                                            <div class="form-group">
                                                <label>Bagian</label>
                                                <div>
                                                    <input readonly value="{{ $karyawan->bagian->nama }}" type="text" name="bagian" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-sm-12">
                                            <div class="form-group">
                                                <label>Jabatan</label>
                                                <div>
                                                    <input readonly value="{{ $karyawan->jabatan->nama }}" type="text" name="jabatan" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="cuti" role="tabpanel" aria-labelledby="cuti-tab">
                                    <div class="table-responsive">
                                        <table class="table table-md table-striped" id="table-cuti" style="width: 100%;">
                                            <thead>
                                                <th>ID</th>
                                                <th>Alasan</th>
                                                <th>Tanggal Cuti</th>
                                                <th>Tanggal Masuk</th>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="peringatan" role="tabpanel" aria-labelledby="peringatan-tab">
                                    <div class="table-responsive">
                                        <table class="table table-md table-striped" id="table-peringatan" style="width: 100%;">
                                            <thead>
                                                <th>ID</th>
                                                <th>Pelanggaran</th>
                                                <th>Tanggal</th>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    
                </div>
                <div class="card-footer text-right">
                    <a href="{{ url()->route('admin.karyawan.edit', [$karyawan->id]) }}" class="btn btn-sm btn-icon text-white btn-warning"><i class="fa fa-edit"></i> Edit</a>
                    <form method="post" action="{{ url()->route('admin.karyawan.edit', [$karyawan->id]) }}">
                        @method('delete')
                        @csrf
                        <button type="submit" class="btn btn-sm btn-icon text-white btn-danger"><i class="fa fa-trash"></i> Hapus</button>
                    </form>
                </div>
            </form>
        </div>
    </div>
@stop

@push('css-library')
    <link rel="stylesheet" href="{{ asset('assets/modules/select2/dist/css/select2.min.css') }}"> 
    <link rel="stylesheet" href="{{ asset('assets/modules/bootstrap-daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
@endpush

@push('js-library')
    <script src="{{ asset('assets/modules/select2/dist/js/select2.full.min.js') }}"></script>  
    <script src="{{ asset('assets/modules/bootstrap-daterangepicker/daterangepicker.js') }}"></script>  
    <script type="text/javascript" charset="utf8" src="{{  asset('assets/modules/datatables/datatables.min.js')  }}"></script>
    <script>
        $('#table-cuti').DataTable( {
            ajax: "{{ url()->route('admin.karyawan.show', [$karyawan->id]) }}?cuti",
            columns: [
                { data: 'id' },
                { data: 'alasan' },
                { data: 'tanggal_cuti' },
                { data: 'tanggal_masuk' },
            ]
        });
        $('#table-peringatan').DataTable( {
            ajax: "{{ url()->route('admin.karyawan.show', [$karyawan->id]) }}?peringatan",
            columns: [
                { data: 'id' },
                { data: 'pelanggaran' },
                { data: 'tanggal_pelanggaran' },
            ]
        });
    </script>
@endpush