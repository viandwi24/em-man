@extends('layouts.admin')

@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Tambah Orang Tua</h4>
            </div>
            <div class="card-body">
                <form action="{{ url()->route('admin.karyawan.store') . '?orangtua=' . @$_GET['orangtua'] }}" method="post">
                    @csrf
                    
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" name="nama" class="form-control">
                    </div>
                    
                    <div class="form-group">
                        <label>Usia</label>
                        <input type="number" name="usia" class="form-control">
                    </div>
                    
                    <div class="form-group">
                        <label>Pendidikan</label>
                        <input type="text" name="pendidikan" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Keterangan</label>
                        <select name="keterangan" class="form-control">
                            <option value="hidup">Hidup</option>
                            <option value="meninggal">Meninggal Dunia</option>
                        </select>
                    </div>

                    <button class="btn btn-primary float-right"><i class="fa fa-save"></i> Tambah</button>
                </form>
            </div>
        </div>
    </div>
@stop