@extends('layouts.admin')

@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Edit Peringatan</h4>
            </div>
            <div class="card-body">
                <form action="{{ url()->route('admin.peringatan.update', [$peringatan->id]) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    
                    <div class="form-group">
                        <label>Karyawan</label>
                        <div>
                            <select value="{{ old('karyawan_id') }}" name="karyawan_id" class="form-control select2" style="width: 100%;">
                                <option value="" selected>--Pilih Karyawan--</option>
                                @foreach ($karyawans as $item)
                                    <option value="{{ $item->id }}" {{ ($item->id == $peringatan->karyawan_id) ? 'selected' : '' }}>{{ $item->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6 col-sm-12">
                            <div class="form-group">
                                <label>Perihal</label>
                                <div>
                                    <input value="{{ $peringatan->perihal }}" type="text" name="perihal" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12">
                            <div class="form-group">
                                <label>Nomor</label>
                                <div>
                                    <input value="{{ $peringatan->nomor }}" type="text" name="nomor" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6 col-sm-12">
                            <div class="form-group">
                                <label>Pelanggaran</label>
                                <div>
                                    <input value="{{ $peringatan->pelanggaran }}" type="text" name="pelanggaran" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12">
                            <div class="form-group">
                                <label>Tanggal Pelanggaran</label>
                                <div>
                                    <input value="{{ $peringatan->tanggal_pelanggaran }}" type="text" name="tanggal_pelanggaran" class="form-control datepicker">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Berkas Surat</label>
                        <div>
                            <input type="file" name="berkas" class="form-control">
                            <span>
                                File Sekarang :
                                <a target="_blank" href="{{ url()->route('admin.peringatan.show', $peringatan->id) }}">{{ $peringatan->berkas }}</a>
                            </span>
                        </div>
                    </div>

                    <button class="btn btn-primary float-right"><i class="fa fa-save"></i> Perbarui</button>
                </form>
            </div>
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