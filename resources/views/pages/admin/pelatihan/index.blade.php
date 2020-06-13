@extends('layouts.admin')

@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Pelatihan Periode "{{ $periode->diff }}"</h4>
                <div class="card-header-action">
                    <a href="{{ url()->route('admin.pelatihan.create', [$periode->id]) }}" class="btn btn-success btn-icon"><i class="fa fa-plus"></i></a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-md table-striped" id="table">
                        <thead>
                            <th>ID</th>
                            <th>Nama</th>
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
            ajax: "{{ url()->route('admin.pelatihan.index', [$periode->id]) }}",
            columns: [
                { data: 'id' },
                { data: 'nama' },
                { data: 'action' },
            ]
        });
    </script>
@endpush