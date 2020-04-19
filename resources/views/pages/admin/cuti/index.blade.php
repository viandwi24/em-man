@extends('layouts.admin')

@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Cuti</h4>
                <div class="card-header-action">
                    <a href="{{ url()->route('admin.cuti.create') }}" class="btn btn-success btn-icon"><i class="fa fa-plus"></i></a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-md table-striped" id="table">
                        <thead>
                            <th>ID</th>
                            <th>Karyawan</th>
                            <th>Alasan</th>
                            <th>Tanggal Cuti</th>
                            <th>Tanggal Masuk</th>
                            <th>...</th>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop


@push('css')
    <link rel="stylesheet" href="{{ asset('assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
@endpush

@push('js')
    <script type="text/javascript" charset="utf8" src="{{  asset('assets/modules/datatables/datatables.min.js')  }}"></script>
    <script>
        $('#table').DataTable( {
            ajax: "{{ url()->route('admin.cuti.index') }}",
            columns: [
                { data: 'id' },
                { data: 'karyawan.nama' },
                { data: 'alasan' },
                { data: 'tanggal_cuti' },
                { data: 'tanggal_masuk' },
                {
                    data: null,
                    render: function ( data, type, row ) {
                        return `
                        <div class="btn-group mb-3" role="group" aria-label="Basic example">
                            <a href="{{ url()->route('admin.cuti.index') . '/' }}`+data.id+`/edit" class="btn btn-sm btn-icon text-white btn-warning"><i class="fa fa-edit"></i></a>
                            <form method="post" action="{{ url()->route('admin.cuti.index') . '/' }}`+data.id+`">
                                @method('delete')
                                @csrf
                                <button type="submit" class="btn btn-sm btn-icon text-white btn-danger"><i class="fa fa-trash"></i></button>
                            </form>
                        </div>
                        `;
                    }
                }
            ]
        });
    </script>
@endpush