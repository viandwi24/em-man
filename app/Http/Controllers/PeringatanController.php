<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;

use App\Models\Peringatan;
use App\Models\Karyawan;

class PeringatanController extends Controller
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
            $peringatan = Peringatan::with('karyawan');
            return DataTables::of($peringatan)->make();
        }
        return view('pages.admin.peringatan.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $karyawans = Karyawan::all();
        return view('pages.admin.peringatan.create', compact('karyawans'));
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
            'perihal' => 'required',
            'nomor' => 'required',
            'pelanggaran' => 'required',
            'tanggal_pelanggaran' => 'required|date',
            'berkas' => 'required'
        ]);

        // upload
        $berkas = $request->berkas;
        $upload = $berkas->store('berkas_peringatan');
        $berkas_nama = str_replace('berkas_peringatan/', '', $upload);

        // define
        $data = $request->only('karyawan_id', 'perihal', 'nomor', 'pelanggaran', 'tanggal_pelanggaran', 'berkas');
        $data['berkas'] = $berkas_nama;

        // insert
        $store = Peringatan::create($data);

        return redirect()->route('admin.peringatan.index')->with('alert', ['title' => 'Sukses', 'text' => 'Tambah Data Berhasil.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Peringatan $peringatan)
    {
        if (isset($_GET['berkas'])) return response()->download(storage_path('app/berkas_peringatan/' . $peringatan->berkas));
        return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Peringatan $peringatan)
    {
        $karyawans = Karyawan::all();
        return view('pages.admin.peringatan.edit', compact('peringatan', 'karyawans'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Peringatan $peringatan)
    {
        $request->validate([
            'karyawan_id' => 'required|numeric',
            'perihal' => 'required',
            'nomor' => 'required',
            'pelanggaran' => 'required',
            'tanggal_pelanggaran' => 'required|date',
        ]);
        
        // define
        $data = $request->only('karyawan_id', 'perihal', 'nomor', 'pelanggaran', 'tanggal_pelanggaran', 'berkas');

        if ($request->has('berkas'))
        {
            // upload
            $berkas = $request->berkas;
            $upload = $berkas->store('berkas_peringatan');
            $berkas_nama = str_replace('berkas_peringatan/', '', $upload);
            $data['berkas'] = $berkas_nama;
        }

        $update = $peringatan->update($data);

        return redirect()->route('admin.peringatan.index')->with('alert', ['title' => 'Sukses', 'text' => 'Memperbarui Data Berhasil.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Peringatan $peringatan)
    {
        $delete = $peringatan->delete();
        return redirect()->back()->with('alert', ['title' => 'Sukses', 'text' => 'Hapus Data Berhasil.']);
    }
}
