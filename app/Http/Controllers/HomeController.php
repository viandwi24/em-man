<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Karyawan;
use App\Models\Unit;
use App\Models\Outsourcing;
use App\Models\Bagian;

class HomeController extends Controller
{
    public function index()
    {
        $units = Unit::with('karyawan')->get();
        $outsourcings = Outsourcing::with('karyawan')->get();
        $bagians = Bagian::with('karyawan')->get();
        $jumlah_karyawan = Karyawan::count();
        return view('pages.home', compact('jumlah_karyawan', 'units', 'outsourcings', 'bagians'));
    }

    public function admin()
    {
        $units = Unit::with('karyawan')->get();
        $outsourcings = Outsourcing::with('karyawan')->get();
        $bagians = Bagian::with('karyawan')->get();
        $jumlah_karyawan = Karyawan::count();
        return view('pages.admin.index', compact('jumlah_karyawan', 'units', 'outsourcings', 'bagians'));
    }
}
