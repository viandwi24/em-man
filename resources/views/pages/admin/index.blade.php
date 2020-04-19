@extends('layouts.admin')

@section('content')

    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-primary"><i class="fas fa-user"></i></div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Semua Karyawan</h4>
                    </div>
                    <div class="card-body">
                        <?= $jumlah_karyawan; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-success"><i class="fas fa-building"></i></div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total Unit</h4>
                    </div>
                    <div class="card-body">
                        <?= $jumlah_karyawan; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-warning"><i class="fas fa-user"></i></div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total Outsourcing</h4>
                    </div>
                    <div class="card-body">
                        <?= $jumlah_karyawan; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-danger"><i class="fas fa-user"></i></div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total Bagian</h4>
                    </div>
                    <div class="card-body">
                        <?= $jumlah_karyawan; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4 col-sm-12">
            <div class="card">
                <div class="card-header"><h4>Daftar Unit</h4></div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered">
                            <thead>
                                <th>Unit</th>
                                <th>Jumlah Karyawan</th>
                            </thead>
                            <tbody>
                                @foreach ($units as $item)
                                <tr>
                                    <td>{{ $item->nama }}</td>
                                    <td>{{ $item->karyawan()->count() }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-sm-12">
            <div class="card">
                <div class="card-header"><h4>Daftar Outsourcing</h4></div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered">
                            <thead>
                                <th>Outsourcing</th>
                                <th>Jumlah Karyawan</th>
                            </thead>
                            <tbody>
                                @foreach ($outsourcings as $item)
                                <tr>
                                    <td>{{ $item->nama }}</td>
                                    <td>{{ $item->karyawan()->count() }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-sm-12">
            <div class="card">
                <div class="card-header"><h4>Daftar Bagian</h4></div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered">
                            <thead>
                                <th>Bagian</th>
                                <th>Jumlah Karyawan</th>
                            </thead>
                            <tbody>
                                @foreach ($bagians as $item)
                                <tr>
                                    <td>{{ $item->nama }}</td>
                                    <td>{{ $item->karyawan()->count() }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection