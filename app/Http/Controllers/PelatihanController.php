<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use App\Models\Pelatihan;
use App\Models\Periode;
use App\Services\Select2;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class PelatihanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Periode $periode)
    {
        if ($request->ajax())
        {
            $pelatihan = Pelatihan::where('periode_id', $periode->id)->get();
            return DataTables::of($pelatihan)
                ->addColumn('action', function (Pelatihan $pelatihan) use ($periode) {
                    return '<div class="btn-group mb-3" role="group" aria-label="Basic example">
                        <a href="'. url()->route('admin.pelatihan.edit', [$periode->id, $pelatihan->id]) .'" class="btn btn-sm btn-icon text-white btn-warning"><i class="fa fa-edit"></i></a>
                        <form method="post" action="'. url()->route('admin.pelatihan.destroy', [$periode->id, $pelatihan->id]) .'">
                            '. method_field('delete') .'
                            '. csrf_field() .'
                            <button type="submit" class="btn btn-sm btn-icon text-white btn-danger"><i class="fa fa-trash"></i></button>
                        </form>
                    </div>';
                })
                ->make();
        }
        return view('pages.admin.pelatihan.index', compact('periode'));  
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Periode $periode)
    {
        return view('pages.admin.pelatihan.create', compact('periode'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Periode $periode)
    {
        $request->validate([
            'nama' => 'required'
        ]);

        $pelatihan = null;
        DB::transaction(function () use ($request, $periode, &$pelatihan) {
            $pelatihan = Pelatihan::create([
                'periode_id' => $periode->id,
                'nama' => $request->nama,
                'materi' => [],
                'usulan' => [ 'pelatihan' => [], 'hasil' => '' ],
                'laporan' => [ 'hasil' => [], 'kesimpulan' => [] ],
                'evaluasi' => [ 'hasil' => [], 'evaluasi' => [] ],
            ]);
        });

        return redirect()->route('admin.pelatihan.index', [$periode->id])->with('alert', ['title' => 'Sukses', 'text' => 'Tambah Data Berhasil.']);
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
    public function edit(Periode $periode, Pelatihan $pelatihan)
    {
        $karyawans = new Select2(Karyawan::all(), ['id', 'nama']);
        return view('pages.admin.pelatihan.edit', compact('periode', 'pelatihan', 'karyawans'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Periode $periode, Pelatihan $pelatihan)
    {
        $request->validate([
            'nama' => 'required',
            'no_dokumentasi' => 'required|nullable',
            'no_revisi' => 'required|nullable',
            'karyawan' => 'required|json',
            'materi' => 'required|json',
            'dibuat' => 'required|nullable',
            'dibuat_jabatan' => 'required|nullable',
            'disetujui' => 'required|nullable',
            'disetujui_jabatan' => 'required|nullable',
            'instruktur' => 'required|nullable',
            'lokasi' => 'required|nullable',
            'terbit' => 'required|nullable|date',
            'pelatihan' => 'required|nullable|date',

            'usulan.hasil' => 'required|nullable',
            'laporan.hasil' => 'required|nullable',
            'laporan.kesimpulan' => 'required|nullable',
            'evaluasi.hasil' => 'required|nullable',
            'evaluasi.evaluasi' => 'required|nullable',
        ]);

        $karyawan = json_decode($request->karyawan);
        $materi = json_decode($request->materi);

        $update = $pelatihan->update([
            'nama' => $request->nama,
            'materi' => $materi,
            'no_dokumentasi' => $request->no_dokumentasi,
            'no_revisi' => $request->no_revisi,
            'dibuat' => $request->dibuat,
            'dibuat_jabatan' => $request->dibuat_jabatan,
            'disetujui' => $request->disetujui,
            'disetujui_jabatan' => $request->disetujui_jabatan,
            'instruktur' => $request->instruktur,
            'lokasi' => $request->lokasi,
            'terbit' => $request->terbit,
            'pelatihan' => $request->pelatihan,

            'usulan' => $request->usulan,
            'laporan' => $request->laporan,
            'evaluasi' => $request->evaluasi,
        ]);

        $pelatihan->karyawan()->sync($karyawan);

        return redirect()->back()->with('alert', ['title' => 'Sukses', 'text' => 'Update Data Berhasil.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Periode $periode, Pelatihan $pelatihan)
    {
        $delete = $pelatihan->delete();
        return redirect()->back()->with('alert', ['title' => 'Sukses', 'text' => 'Hapus Data Berhasil.']);
    }
}
