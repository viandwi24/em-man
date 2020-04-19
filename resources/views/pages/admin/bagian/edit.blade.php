@extends('layouts.admin')

@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Edit Bagian</h4>
            </div>
            <div class="card-body">
                <form action="{{ url()->route('admin.bagian.update', [$bagian->id]) }}" method="post">
                    @csrf
                    @method('put')
                    
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" name="nama" class="form-control" value="{{ $bagian->nama }}">
                    </div>

                    <button class="btn btn-primary float-right"><i class="fa fa-save"></i> Perbarui</button>
                </form>
            </div>
        </div>
    </div>
@stop