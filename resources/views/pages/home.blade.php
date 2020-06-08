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
        
        <div class="row justify-content-center mt-4">
            @foreach ($units as $unit)
            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="card shadow">
                    <div class="card-header"><h4 class="card-title">{{ $unit->nama }}</h4></div>
                    <div class="card-body p-0">
                        {{-- karyawan outsourcing --}}
                        <div class="d-w w-100 bg-primary text-white" style="padding: 1.5rem;">
                            <div style="display: inline-block;">Outsourcing</div>
                            <a class="btn d-b btn-sm btn-warning float-md-right" onclick="bukaTutup('t1-{{ $unit->id }}')">
                                Buka / Tutup
                            </a>
                        </div>
                        <table class="table" id="t1-{{ $unit->id }}">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Jumlah Karyawan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $ids = $unit->karyawan()->select('outsourcing_id')->get();
                                    $outsourcings = \App\Models\Outsourcing::with('karyawan')->whereIn('id', $ids)->get();
                                @endphp
                                @foreach ($outsourcings as $outsourcing)
                                <tr>
                                    <td>{{ $outsourcing->nama }}</td>
                                    <td>{{ $outsourcing->karyawan()->count() }}</td>
                                </tr>                                    
                                @endforeach
                                @if (count($outsourcings) == 0)
                                <tr>
                                    <td class="text-center" colspan="2">Tidak ada</td>
                                </tr>                                    
                                @endif
                            </tbody>
                        </table>

                        {{-- karyawn bagian --}}                        
                        <div class="d-w w-100 bg-primary text-white" style="padding: 1.5rem;">
                            <div style="display: inline-block;">Bagian</div>
                            <a class="btn d-b btn-sm btn-warning float-md-right" onclick="bukaTutup('t2-{{ $unit->id }}')">
                                Buka / Tutup
                            </a>
                        </div>
                        <table class="table m-0" id="t2-{{ $unit->id }}">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Jumlah Karyawan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $ids = $unit->karyawan()->select('bagian_id')->get();
                                    $bagians = \App\Models\Bagian::with('karyawan')->whereIn('id', $ids)->get();
                                @endphp
                                @foreach ($bagians as $bagian)
                                <tr>
                                    <td>{{ $bagian->nama }}</td>
                                    <td>{{ $bagian->karyawan()->count() }}</td>
                                </tr>                                    
                                @endforeach
                                @if (count($bagians) == 0)
                                <tr>
                                    <td class="text-center" colspan="2">Tidak ada</td>
                                </tr>                                    
                                @endif
                            </tbody>
                        </table>

                        {{-- karyawn jabatan --}}
                        {{-- <table class="table">
                            <thead>
                                <tr>
                                    <th colspan="2" class="text-center bg-primary text-white">Jabatan</th>
                                </tr>
                                <tr>
                                    <th>Nama</th>
                                    <th>Jumlah Karyawan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $ids = $unit->karyawan()->select('jabatan_id')->get();
                                    $jabatans = \App\Models\Jabatan::with('karyawan')->whereIn('id', $ids)->get();
                                @endphp
                                @foreach ($jabatans as $jabatan)
                                <tr>
                                    <td>{{ $jabatan->nama }}</td>
                                    <td>{{ $jabatan->karyawan()->count() }}</td>
                                </tr>                                    
                                @endforeach
                                @if (count($jabatans) == 0)
                                <tr>
                                    <td class="text-center" colspan="2">Tidak ada</td>
                                </tr>                                    
                                @endif
                            </tbody>
                        </table> --}}
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        {{-- <div class="row">
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
        </div> --}}
    </div>
@stop

@push('js')
    <script>
        $('.main-wrapper').remove()
        function bukaTutup(target)
        {
            let el = $('#' + target)
            if (el.css('display') == 'none') {
                el.fadeIn(100)
            } else {
                el.fadeOut(100)
            }
        }
        $('table').fadeOut(2)
    </script>
@endpush