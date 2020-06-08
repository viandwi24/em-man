@extends('layouts.admin')

@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Laporan Karyawan</h4>
                <div class="card-header-action">
                    <a href="#" id="btn-download" class="btn btn-primary btn-icon"> <i class="fas fa-download"></i> Download .pdf </a>
                    <a href="#" id="btn-view" class="btn btn-primary btn-icon"> <i class="fas fa-eye"></i> View .pdf </a>
                </div>
            </div>
            <div class="card-body m-0">
                <div class="form">
                    <div class="row justify-content-center">
                        <div class="col-lg-3 col-sm-12">
                            <div class="form-group">
                                <label>Filter Unit :</label>
                                <select name="unit_id" class="form-control select2" style="width: 100%;">
                                    <option value="" selected>Semua</option>
                                    @foreach ($units as $item)
                                        <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-12">
                            <div class="form-group">
                                <label>Filter Outsourcing :</label>
                                <select name="outsourcing_id" class="form-control select2" style="width: 100%;">
                                    <option value="" selected>Semua</option>
                                    @foreach ($outsourcings as $item)
                                        <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-12">
                            <div class="form-group">
                                <label>Filter Bagian :</label>
                                <select name="bagian_id" class="form-control select2" style="width: 100%;">
                                    <option value="" selected>Semua</option>
                                    @foreach ($bagians as $item)
                                        <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-12">
                            <div class="form-group">
                                <label>Filter Jabatan :</label>
                                <select name="jabatan_id" class="form-control select2" style="width: 100%;">
                                    <option value="" selected>Semua</option>
                                    @foreach ($jabatans as $item)
                                        <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-md table-striped" id="table">
                        <thead>
                            <th>ID</th>
                            <th>Nama</th>
                            <th>Unit</th>
                            <th>Outsourcing</th>
                            <th>Bagian</th>
                            <th>Jabatan</th>
                            <th>Peringatan</th>
                            <th>Cuti</th>
                            <th>...</th>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop


@push('css-library')
    <link rel="stylesheet" href="{{ asset('assets/modules/select2/dist/css/select2.min.css') }}"> 
    <link rel="stylesheet" href="{{ asset('assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
@endpush

@push('js-library')
    <script src="{{ asset('assets/modules/select2/dist/js/select2.full.min.js') }}"></script>  
    <script type="text/javascript" charset="utf8" src="{{  asset('assets/modules/datatables/datatables.min.js')  }}"></script>
@endpush

@push('js')
    <script>
        var dataTable = null;
        function loadDatatable() {
            let filter = {
                unit: $('[name=unit_id]').val(),
                outsourcing: $('[name=outsourcing_id]').val(),
                bagian: $('[name=bagian_id]').val(),
                jabatan: $('[name=jabatan_id]').val(),
            }      

            if (dataTable != null) $('#table').DataTable().destroy();
            dataTable = $('#table').DataTable( {
                ajax: {
                    url: "{{ url()->route('admin.laporan') }}",
                    data: { filter },
                    type:"GET",
                },
                columns: [
                    { data: 'id' },
                    { data: 'nama' },
                    { data: 'unit.nama' },
                    { data: 'outsourcing.nama' },
                    { data: 'bagian.nama' },
                    { data: 'jabatan.nama' },
                    {
                        data: 'peringatan',
                        render: function ( data, type, row ) {
                            return (data.length == 0) ? '-' : data.length + 'x'
                        }
                    },
                    {
                        data: 'cuti',
                        render: function ( data, type, row ) {
                            return (data.length == 0) ? '-' : data.length + 'x'
                        }
                    },
                    {
                        data: null,
                        render: function ( data, type, row ) {
                            return `
                            <div class="btn-group mb-3" role="group" aria-label="Basic example">
                                <a href="{{ url()->route('admin.laporan') . '/' }}`+data.id+`" class="btn btn-sm btn-icon text-white btn-warning"><i class="fa fa-eye"></i></a>
                            </div>
                            `;
                        }
                    }
                ]
            });
        }

        $('[name=unit_id]').change(() => loadDatatable());
        $('[name=outsourcing_id]').change(() => loadDatatable());
        $('[name=bagian_id]').change(() => loadDatatable());
        $('[name=jabatan_id]').change(() => loadDatatable());
        $(document).ready(() => loadDatatable());
        $('#btn-download').on("click", (e) => {
            e.preventDefault()
            let filter = {
                unit: $('[name=unit_id]').val(),
                outsourcing: $('[name=outsourcing_id]').val(),
                bagian: $('[name=bagian_id]').val(),
                jabatan: $('[name=jabatan_id]').val(),
            }
            let param = '?download=&filter=' + JSON.stringify(filter)
            window.open("{{ url()->route('admin.laporan') }}" + param, "_blank");
        })
        $('#btn-view').on("click", (e) => {
            e.preventDefault()
            let filter = {
                unit: $('[name=unit_id]').val(),
                outsourcing: $('[name=outsourcing_id]').val(),
                bagian: $('[name=bagian_id]').val(),
                jabatan: $('[name=jabatan_id]').val(),
            }
            let param = '?stream=&filter=' + JSON.stringify(filter)
            window.open("{{ url()->route('admin.laporan') }}" + param, "_blank");
        })
    </script>
@endpush