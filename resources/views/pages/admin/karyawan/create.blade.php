@extends('layouts.admin')

@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Tambah Karyawan</h4>
            </div>
            <form action="{{ url()->route('admin.karyawan.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-3 mb-4">
                            <img id="image" alt="image" src="{{ asset('assets/img/no-avatar.png') }}" class="img-fluid border">
                            <input type="file" name="foto" id="foto" style="display: none;">
                            <button id="btn-change-foto" type="button" class="btn btn-primary btn-block"><i class="fa fa-image"></i> Ganti Foto</button>
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
                                    <a class="nav-link" id="keluarga-tab" data-toggle="tab" href="#keluarga">Keluarga</a>
                                </li>
                            </ul>

                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="umum" role="tabpanel" aria-labelledby="umum-tab">
                                    <div class="row">
                                        <div class="col-lg-12 col-sm-12">
                                            <div class="form-group">
                                                <label>Nama Lengkap</label>
                                                <input value="{{ old('nama') }}" type="text" name="nama" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4 col-sm-6">
                                            <div class="form-group">
                                                <label>Tempat Lahir</label>
                                                <input value="{{ old('tempat_lahir') }}" type="text" name="tempat_lahir" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-sm-6">
                                            <div class="form-group">
                                                <label>Tanggal Lahir</label>
                                                <input value="{{ old('tanggal_lahir') }}" name="tanggal_lahir" type="text" class="form-control datepicker">
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-sm-12">
                                            <div class="form-group">
                                                <label>Nik</label>
                                                <input value="{{ old('nik') }}" type="text" name="nik" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6 col-sm-12">
                                            <div class="form-group">
                                                <label>Alamat</label>
                                                <input value="{{ old('alamat') }}" type="text" name="alamat" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-sm-12">
                                            <div class="form-group">
                                                <label>Tanggal Masuk Kerja</label>
                                                <input value="{{ old('tanggal_masuk') }}" type="text" name="tanggal_masuk" class="form-control datepicker">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="pendidikan" role="tabpanel" aria-labelledby="pendidikan-tab">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label>Jenjang</label>
                                                <input value="{{ old('jenjang') }}" placeholder="Ex: SMA, SMK, KULIAH..." type="text" name="jenjang" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6 col-sm-12">
                                            <div class="form-group">
                                                <label>Nama</label>
                                                <input value="{{ old('nama_tempat') }}" placeholder="Ex: SMKN 1 ... Universitas ..." type="text" name="nama_tempat" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-sm-12">
                                            <div class="form-group">
                                                <label>Jurusan</label>
                                                <input value="{{ old('jurusan') }}" type="text" name="jurusan" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6 col-sm-12">
                                            <div class="form-group">
                                                <label>Nomor Ijazah</label>
                                                <input value="{{ old('nomor_ijazah') }}" type="text" name="nomor_ijazah" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-sm-12">
                                            <div class="form-group">
                                                <label>Tahun Lulus</label>
                                                <input value="{{ old('tahun_lulus') }}" type="text" name="tahun_lulus" class="form-control">
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
                                                    <select value="{{ old('unit_id') }}" name="unit_id" class="form-control select2" style="width: 100%;">
                                                        @if (!old('unit_id'))                                           
                                                            <option value="" selected>--Pilih Unit--</option>
                                                        @endif
                                                        @foreach ($units as $item)
                                                            <option value="{{ $item->id }}" {{ old('unit_id') ? (old('unit_id') == $item->id ? 'selected' : '') : '' }}>{{ $item->nama }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-sm-12">
                                            <div class="form-group">
                                                <label>Outsourcing</label>
                                                <div>
                                                    <select value="{{ old('outsourcing_id') }}" name="outsourcing_id" class="form-control select2" style="width: 100%;">
                                                        @if (!old('outsourcing_id'))                                                            
                                                            <option value="" selected>--Pilih Outsourcing--</option>
                                                        @endif
                                                        @foreach ($outsourcings as $item)
                                                            <option value="{{ $item->id }}" {{ old('outsourcing_id') ? (old('outsourcing_id') == $item->id ? 'selected' : '') : '' }}>{{ $item->nama }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6 col-sm-12">
                                            <div class="form-group">
                                                <label>Bagian</label>
                                                <div>
                                                    <select value="{{ old('bagian_id') }}" name="bagian_id" class="form-control select2" style="width: 100%;">
                                                        @if (!old('bagian_id'))                                                            
                                                            <option value="" selected>--Pilih Bagian--</option>
                                                        @endif
                                                        @foreach ($bagians as $item)
                                                            <option value="{{ $item->id }}" {{ old('bagian_id') ? (old('bagian_id') == $item->id ? 'selected' : '') : '' }}>{{ $item->nama }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-sm-12">
                                            <div class="form-group">
                                                <label>Jabatan</label>
                                                <div>
                                                    <select value="{{ old('jabatan_id') }}" name="jabatan_id" class="form-control select2" style="width: 100%;">
                                                        @if (!old('jabatan_id'))                                                            
                                                            <option value="" selected>--Pilih Jabatan--</option>
                                                        @endif
                                                        @foreach ($jabatans as $item)
                                                            <option value="{{ $item->id }}" {{ old('jabatan_id') ? (old('jabatan_id') == $item->id ? 'selected' : '') : '' }}>{{ $item->nama }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="keluarga" role="tabpanel" aria-labelledby="keluarga-tab">
                                    <div class="alert alert-danger text-center">
                                        Menambahkan keluarga dilakukan di halaman edit karyawan. Silahkan tambah karyawan ini dulu.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    
                </div>
                <div class="card-footer text-right">
                    <button class="btn btn-primary"><i class="fa fa-save"></i> Tambah</button>
                </div>
            </form>
        </div>
    </div>
@stop

@push('css-library')
    <link rel="stylesheet" href="{{ asset('assets/modules/select2/dist/css/select2.min.css') }}"> 
    <link rel="stylesheet" href="{{ asset('assets/modules/bootstrap-daterangepicker/daterangepicker.css') }}">
@endpush

@push('js-library')
    <script src="{{ asset('assets/modules/select2/dist/js/select2.full.min.js') }}"></script>  
    <script src="{{ asset('assets/modules/bootstrap-daterangepicker/daterangepicker.js') }}"></script>  
@endpush

@push('js')
    <script>
        $('#btn-change-foto').on('click', () => $('#foto').click())
        $('#foto').on('change', (evt) => {
            var tgt = evt.target || window.event.srcElement,
            files = tgt.files;
            // FileReader support
            if (FileReader && files && files.length) {
                var fr = new FileReader();
                fr.onload = function () {
                    $('#image').attr('src', fr.result);
                }
                fr.readAsDataURL(files[0]);
            }
        })
    </script>
@endpush