@extends('layouts.admin')

@section('navbar') <!-- nv --> @endsection
@section('sidebar') <!-- nv --> @endsection
@section('footer') <!-- nv --> @endsection


@section('page')
    <div class="container">
        <div class="row pt-4">
            <div class="col-lg-6 offset-3">
                <div class="title text-center">
                    <h1>Selamat Datang di Em-man!</h1>
                    <p class="m-0">Employees Management App</p> 
                    <a href="{{ url()->route('login') }}" class="link text-primary">Admin Login</a>
                </div>
            </div>
        </div>
        <div class="row justify-content-center mt-4">
            @foreach ($units as $item)
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1 shadow">
                    <div class="card-icon bg-primary"><i class="fas fa-user"></i></div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>{{ $item->nama }}</h4>
                        </div>
                        <div class="card-body">
                            {{ $item->karyawan()->count() }} Karyawan
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        
    <div class="row">
        <div class="col-lg-4 col-sm-12">
            <div class="card shadow">
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
            <div class="card shadow">
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
            <div class="card shadow">
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
    </div>
@stop

@push('js')
    <script>$('.main-wrapper').remove()</script>
@endpush