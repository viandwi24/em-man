<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use DataTables;

use App\Models\Cuti;
use App\Models\Karyawan;

class CutiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax())
        {
            $cuti = Cuti::with('karyawan');
            return DataTables::of($cuti)->make();
        }
        return view('pages.admin.cuti.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $karyawans = Karyawan::all();
        return view('pages.admin.cuti.create', compact('karyawans'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'karyawan_id' => 'required|numeric',
            'alasan' => 'required',
            'tanggal_cuti' => 'required|date',
            'tanggal_masuk' => 'required|date',
        ]);
        
        // limt cuti
        $max_cuti = 12; // 12 hari
        $to = Carbon::parse($request->tanggal_cuti);
        $from = Carbon::parse($request->tanggal_masuk);
        $diff_in_days = $to->diffInDays($from);
        if ($diff_in_days > $max_cuti)
        {
            return redirect()->back()->withInput()->withErrors(['Cuti maksimal 12 Hari.']);
        }

        $store = Cuti::create($request->only('karyawan_id', 'alasan', 'tanggal_cuti', 'tanggal_masuk'));
        return redirect()->route('admin.cuti.index')->with('alert', ['title' => 'Sukses', 'text' => 'Tambah Data Berhasil.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Cuti $cuti)
    {
        $karyawans = Karyawan::all();
        return view('pages.admin.cuti.edit', compact('cuti', 'karyawans'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cuti $cuti)
    {
        $request->validate([
            'karyawan_id' => 'required|numeric',
            'alasan' => 'required',
            'tanggal_cuti' => 'required|date',
            'tanggal_masuk' => 'required|date',
        ]);
        $update = $cuti->update($request->only('karyawan_id', 'alasan', 'tanggal_cuti', 'tanggal_masuk'));
        return redirect()->route('admin.cuti.index')->with('alert', ['title' => 'Sukses', 'text' => 'Memperbarui Data Berhasil.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cuti $cuti)
    {
        $delete = $cuti->delete();
        return redirect()->back()->with('alert', ['title' => 'Sukses', 'text' => 'Hapus Data Berhasil.']);
    }
}
