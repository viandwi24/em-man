@extends('layouts.admin')

@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Edit Cuti</h4>
            </div>
            <div class="card-body">
                <form action="{{ url()->route('admin.cuti.update', [$cuti->id]) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    
                    <div class="form-group">
                        <label>Karyawan</label>
                        <div>
                            <select value="{{ old('karyawan_id') }}" name="karyawan_id" class="form-control select2" style="width: 100%;">
                                @foreach ($karyawans as $item)
                                    <option value="{{ $item->id }}" {{ ($item->id == $cuti->karyawan_id) ? 'selected' : '' }}>{{ $item->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-4 col-sm-12">
                            <div class="form-group">
                                <label>Alasan</label>
                                <div>
                                    <input value="{{ $cuti->alasan }}" type="text" name="alasan" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-12">
                            <div class="form-group">
                                <label>Tanggal Cuti</label>
                                <div>
                                    <input  value="{{ $cuti->tanggal_cuti }}" type="text" name="tanggal_cuti" class="form-control datepicker">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-12">
                            <div class="form-group">
                                <label>Tanggal Masuk</label>
                                <div>
                                    <input  value="{{ $cuti->tanggal_masuk }}" type="text" name="tanggal_masuk" class="form-control datepicker">
                                </div>
                            </div>
                        </div>
                    </div>

                    <button class="btn btn-primary float-right"><i class="fa fa-save"></i> Tambah</button>
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