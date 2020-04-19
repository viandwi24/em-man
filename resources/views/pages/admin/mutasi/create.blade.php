@extends('layouts.admin')

@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Tambah Mutasi</h4>
            </div>
            <div class="card-body">
                <form action="{{ url()->route('admin.mutasi.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="row">
                        <div class="col-lg-9 col-sm-12">
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
                        </div>
                        <div class="col-lg-3 col-sm-12">
                            <div class="form-group">
                                <label>Tanggal</label>
                                <div>
                                    <input type="text" name="tanggal" class="form-control datepicker">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6 col-sm-12">
                            <div class="form-group">
                                <label>Unit</label>
                                <div>
                                    <select value="{{ old('unit_id') }}" name="unit_id" class="form-control select2" style="width: 100%;">
                                        <option value="" selected>--Pilih unit--</option>
                                        @foreach ($units as $item)
                                            <option value="{{ $item->id }}">{{ $item->nama }}</option>
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
                                        <option value="" selected>--Pilih outsourcing--</option>
                                        @foreach ($outsourcings as $item)
                                            <option value="{{ $item->id }}">{{ $item->nama }}</option>
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
                                        <option value="" selected>--Pilih bagian--</option>
                                        @foreach ($bagians as $item)
                                            <option value="{{ $item->id }}">{{ $item->nama }}</option>
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
                                        <option value="" selected>--Pilih jabatan--</option>
                                        @foreach ($jabatans as $item)
                                            <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                        @endforeach
                                    </select>
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