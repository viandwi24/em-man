@extends('layouts.admin')

@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Tambah Cuti</h4>
            </div>
            <div class="card-body">
                <form action="{{ url()->route('admin.cuti.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="form-group">
                        <label>Karyawan</label>
                        <div>
                            <select value="{{ old('karyawan_id') }}" name="karyawan_id" class="form-control select2" style="width: 100%;">
                                <option value="" selected>--Pilih Karyawan--</option>
                                @foreach ($karyawans as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-4 col-sm-12">
                            <div class="form-group">
                                <label>Alasan</label>
                                <div>
                                    <input type="text" name="alasan" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-12">
                            <div class="form-group">
                                <label>Tanggal Cuti</label>
                                <div>
                                    <input type="text" name="tanggal_cuti" class="form-control datepicker">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-12">
                            <div class="form-group">
                                <label>Tanggal Masuk</label>
                                <div>
                                    <input type="text" name="tanggal_masuk" class="form-control datepicker">
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