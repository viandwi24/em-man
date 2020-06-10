<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use Validator;

use App\Models\Karyawan;
use App\Models\KaryawanPendidikan;
use App\Models\Unit;
use App\Models\Outsourcing;
use App\Models\Bagian;
use App\Models\Jabatan;

class KaryawanController extends Controller
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
            $karyawan = Karyawan::with('unit', 'outsourcing', 'bagian', 'jabatan');
            return DataTables::of($karyawan)->make();
        }
        return view('pages.admin.karyawan.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (isset($_GET['keluarga']))
        {
            return view("pages.admin.karyawan.create_keluarga");
        } else  if (isset($_GET['orangtua'])) {
            return view("pages.admin.karyawan.create_orangtua");
        }

        $units = Unit::all();
        $outsourcings = Outsourcing::all();
        $bagians = Bagian::all();
        $jabatans = Jabatan::all();
        
        return view('pages.admin.karyawan.create', compact('units', 'outsourcings', 'bagians', 'jabatans'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (isset($_GET['keluarga']))
        {
            $request->validate([
                'nama' => 'required',
                'usia' => 'numeric',
                'pendidikan' => 'required',
                'keterangan' => 'required|in:hidup,meninggal',
            ]);

            $karyawan = Karyawan::findOrFail($request->keluarga);
            $store = $karyawan->keluarga()->create([
                'nama' => $request->nama,
                'usia' => $request->usia,
                'pendidikan' => $request->pendidikan,
                'keterangan' => $request->keterangan,
            ]);
            
            // return
            return redirect()->route('admin.karyawan.edit', [$request->keluarga])->with('alert', ['title' => 'Sukses', 'text' => 'Tambah Data Berhasil.']);
        } else if (isset($_GET['orangtua'])) {
            $request->validate([
                'nama' => 'required',
                'usia' => 'numeric',
                'pendidikan' => 'required',
                'keterangan' => 'required|in:hidup,meninggal',
            ]);

            $karyawan = Karyawan::findOrFail($request->orangtua);
            $store = $karyawan->orangtua()->create([
                'nama' => $request->nama,
                'usia' => $request->usia,
                'pendidikan' => $request->pendidikan,
                'keterangan' => $request->keterangan,
            ]);
            
            // return
            return redirect()->route('admin.karyawan.edit', [$request->orangtua])->with('alert', ['title' => 'Sukses', 'text' => 'Tambah Data Berhasil.']);
        }

        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|date',
            'nik' => 'required|numeric',
            'alamat' => 'required',
            'tanggal_masuk' => 'required|date',

            'jenjang' => 'required',
            'nama_tempat' => 'required',
            'jurusan' => 'required',
            'nomor_ijazah' => 'required',
            'tahun_lulus' => 'required',

            'outsourcing_id' => 'required|numeric',
            'unit_id' => 'required|numeric',
            'bagian_id' => 'required|numeric',
            'jabatan_id' => 'required|numeric',

            'foto' => 'required'
        ]);

        // validator
        if ($validator->fails())
        {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }
        
        // 
        $foto = $request->foto;
        $upload = $foto->store('foto_karyawan');
        $foto_nama = str_replace('foto_karyawan/', '', $upload);

        // parse data
        $karyawan_data = $request->only('nama', 'tempat_lahir', 'tanggal_lahir', 'nik', 'alamat', 'tanggal_masuk', 'unit_id', 'outsourcing_id', 'bagian_id', 'jabatan_id');
        $karyawan_data['foto'] = $foto_nama;
        $pendidikan_data = $request->only('jenjang', 'jurusan', 'nomor_ijazah', 'tahun_lulus');
        $pendidikan_data['nama'] = $request->nama_tempat;
        $mutasi_data = $request->only('bagian_id', 'jabatan_id', 'unit_id', 'outsourcing_id');
        $mutasi_data['tanggal'] = $request->tanggal_masuk;

        // create
        $karyawan = Karyawan::create($karyawan_data);
        $pendidikan = $karyawan->pendidikan()->create($pendidikan_data);
        $mutasi = $karyawan->mutasi()->create($mutasi_data);

        // return
        return redirect()->route('admin.karyawan.index')->with('alert', ['title' => 'Sukses', 'text' => 'Tambah Data Berhasil.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Karyawan $karyawan)
    {
        if ($request->ajax() && isset($_GET['cuti']))
        {
            return DataTables::of($karyawan->cuti)->make();
        }


        if ($request->ajax() && isset($_GET['peringatan']))
        {
            return DataTables::of($karyawan->peringatan)->make();
        }

        return view('pages.admin.karyawan.show', compact('karyawan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Karyawan $karyawan)
    {
        if ($request->ajax())
        {
            if (isset($_GET['keluarga']))
            {
                return DataTables::of($karyawan->keluarga)->make();
            } else if (isset($_GET['orangtua']))
            {
                return DataTables::of($karyawan->orangtua)->make();
            }
        }

        $units = Unit::all();
        $outsourcings = Outsourcing::all();
        $bagians = Bagian::all();
        $jabatans = Jabatan::all();

        return view('pages.admin.karyawan.edit', compact('karyawan', 'units', 'outsourcings', 'bagians', 'jabatans'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Karyawan $karyawan)
    {
        // validate
        $request->validate([
            'nama' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|date',
            'nik' => 'required|numeric',
            'alamat' => 'required',
            'tanggal_masuk' => 'required|date',

            'jenjang' => 'required',
            'nama_tempat' => 'required',
            'jurusan' => 'required',
            'nomor_ijazah' => 'required',
            'tahun_lulus' => 'required',

            'outsourcing_id' => 'required|numeric',
            'unit_id' => 'required|numeric',
            'bagian_id' => 'required|numeric',
            'jabatan_id' => 'required|numeric',
        ]);


        // 
        if ($request->has('foto'))
        {
            $foto = $request->foto;
            $upload = $foto->store('foto_karyawan');
            $foto_nama = str_replace('foto_karyawan/', '', $upload);
        }

        // data
        $karyawan_data = $request->only('nama', 'tempat_lahir', 'tanggal_lahir', 'nik', 'alamat', 'tanggal_masuk', 'unit_id', 'outsourcing_id', 'bagian_id', 'jabatan_id');
        if ($request->has('foto')) $karyawan_data['foto'] = $foto_nama; 
        $pendidikan_data = $request->only('jenjang', 'jurusan', 'nomor_ijazah', 'tahun_lulus');
        $pendidikan_data['nama'] = $request->nama_tempat;

        // update
        $update = $karyawan->update($karyawan_data);
        $pendidikan = $karyawan->pendidikan()->update($pendidikan_data);

        // return
        return redirect()->route('admin.karyawan.index')->with('alert', ['title' => 'Sukses', 'text' => 'Memperbarui Data Berhasil.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Karyawan $karyawan)
    {
        if (isset($_GET['keluarga']))
        {
            $delete = $karyawan->keluarga()->find($_GET['keluarga'])->delete();
        } else if (isset($_GET['orangtua'])) {
            $delete = $karyawan->orangtua()->find($_GET['orangtua'])->delete();
        } else {
            $delete = $karyawan->delete();
        }
        return redirect()->back()->with('alert', ['title' => 'Sukses', 'text' => 'Hapus Data Berhasil.']);
    }
}
