<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use PDF;

use App\Models\Karyawan;
use App\Models\Unit;
use App\Models\Outsourcing;
use App\Models\Bagian;
use App\Models\Jabatan;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        // pdf download
        if (isset($_GET['download'])) return $this->proccessPdf($request, 'download');
        if (isset($_GET['stream'])) return $this->proccessPdf($request);

        // dataables
        if ($request->ajax())
        {
            $karyawan = Karyawan::with('unit', 'outsourcing', 'bagian', 'jabatan', 'peringatan', 'cuti');
            $karyawan = $this->applyFilter($request, $karyawan);
            // return $karyawan->get();
            return DataTables::of($karyawan)->make();
        }

        // view
        $units = Unit::all();
        $outsourcings = Outsourcing::all();
        $bagians = Bagian::all();
        $jabatans = Jabatan::all();
        $data = compact('units', 'outsourcings', 'bagians', 'jabatans');
        return view('pages.admin.laporan.index', $data);
    }

    public function proccessPdf($request, $response = 'stream')
    {
        $karyawans = Karyawan::with('unit', 'outsourcing', 'bagian', 'jabatan', 'peringatan', 'cuti');
        $karyawans = $this->applyFilter($request, $karyawans)->get();
        
        $pdf = PDF::loadview('pages.admin.laporan.pdf', compact('karyawans'));
        return ($response == 'stream') ? $pdf->stream() : $pdf->download();
    }

    protected function applyFilter($request, $karyawan)
    {
        // filter
        $req_filter = is_string($request->filter) ? (array) json_decode($request->filter) : $request->filter;
        $filter = [];
        if (!isset($req_filter['unit'])) $filter['unit'] = null;
        if (!isset($req_filter['outsourcing'])) $filter['outsourcing'] = null;
        if (!isset($req_filter['bagian'])) $filter['bagian'] = null;
        if (!isset($req_filter['jabatan'])) $filter['jabatan'] = null;
        $filter = (object) $req_filter;
        // dd($filter);

        // apply on model
        if ($filter->unit != null) $karyawan->whereHas('unit', function ($q) use ($filter) { return $q->where('id', $filter->unit); });
        if ($filter->outsourcing != null) $karyawan->whereHas('outsourcing', function ($q) use ($filter) { return $q->where('id', $filter->outsourcing); });
        if ($filter->bagian != null) $karyawan->whereHas('bagian', function ($q) use ($filter) { return $q->where('id', $filter->bagian); });
        if ($filter->jabatan != null) $karyawan->whereHas('jabatan', function ($q) use ($filter) { return $q->where('id', $filter->jabatan); });

        // return
        return $karyawan;
    }



    public function show($id)
    {
        $karyawan = Karyawan::with('mutasi', 'pendidikan', 'peringatan', 'cuti')->findOrFail($id);
        
        $pdf = PDF::loadview('pages.admin.laporan.pdf_show', compact('karyawan'));
        return $pdf->stream();
    }
}
