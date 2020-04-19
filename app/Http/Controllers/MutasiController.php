<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;

use App\Models\Mutasi;
use App\Models\Karyawan;
use App\Models\Unit;
use App\Models\Outsourcing;
use App\Models\Bagian;
use App\Models\Jabatan;

class MutasiController extends Controller
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
            $mutasi = Mutasi::with('karyawan', 'unit', 'outsourcing', 'bagian', 'jabatan');
            return DataTables::of($mutasi)->make();
        }
        return view('pages.admin.mutasi.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $karyawans = Karyawan::all();
        $units = Unit::all();
        $outsourcings = Outsourcing::all();
        $bagians = Bagian::all();
        $jabatans = Jabatan::all();
        return view('pages.admin.mutasi.create', compact('karyawans', 'units', 'outsourcings', 'bagians', 'jabatans'));
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
            'bagian_id' => 'required|numeric',
            'jabatan_id' => 'required|numeric',
            'unit_id' => 'required|numeric',
            'outsourcing_id' => 'required|numeric',
            'tanggal' => 'required|date',
        ]);
        $update = Karyawan::findOrFail($request->karyawan_id)->update($request->only('bagian_id', 'jabatan_id', 'unit_id', 'outsourcing_id'));
        $store = Mutasi::create($request->only('karyawan_id', 'bagian_id', 'jabatan_id', 'unit_id', 'outsourcing_id', 'tanggal'));
        return redirect()->route('admin.mutasi.index')->with('alert', ['title' => 'Sukses', 'text' => 'Tambah Data Berhasil.']);
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
    public function edit(Mutasi $mutasi)
    {
        $karyawans = Karyawan::all();
        $units = Unit::all();
        $outsourcings = Outsourcing::all();
        $bagians = Bagian::all();
        $jabatans = Jabatan::all();
        return view('pages.admin.mutasi.edit', compact('karyawans', 'units', 'outsourcings', 'bagians', 'jabatans', 'mutasi'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mutasi $mutasi)
    {
        $request->validate([
            'karyawan_id' => 'required|numeric',
            'bagian_id' => 'required|numeric',
            'jabatan_id' => 'required|numeric',
            'unit_id' => 'required|numeric',
            'outsourcing_id' => 'required|numeric',
            'tanggal' => 'required|date',
        ]);
        $update_karyawan = Karyawan::findOrFail($request->karyawan_id)->update($request->only('bagian_id', 'jabatan_id', 'unit_id', 'outsourcing_id'));
        $update = $mutasi->update($request->only('karyawan_id', 'bagian_id', 'jabatan_id', 'unit_id', 'outsourcing_id', 'tanggal'));
        return redirect()->route('admin.mutasi.index')->with('alert', ['title' => 'Sukses', 'text' => 'Memperbarui Data Berhasil.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mutasi $mutasi)
    {
        $delete = $mutasi->delete();
        return redirect()->back()->with('alert', ['title' => 'Sukses', 'text' => 'Hapus Data Berhasil.']);
    }
}
