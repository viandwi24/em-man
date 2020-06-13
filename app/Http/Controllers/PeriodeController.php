<?php

namespace App\Http\Controllers;

use App\Models\Periode;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PeriodeController extends Controller
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
            $periode = Periode::query();
            return DataTables::eloquent($periode)
                ->addColumn('periode', function (Periode $periode) {
                    return Carbon::parse($periode->mulai)->format('F Y')
                        . ' - ' . Carbon::parse($periode->selesai)->format('F Y');
                })
                ->addColumn('action', function (Periode $periode) {
                    return '<div class="btn-group mb-3" role="group" aria-label="Basic example">
                        <a href="'. url()->route('admin.periode.edit', [$periode->id]) .'" class="btn btn-sm btn-icon text-white btn-warning"><i class="fa fa-edit"></i></a>
                        <form method="post" action="'. url()->route('admin.periode.destroy', [$periode->id]) .'">
                            '. method_field('delete') .'
                            '. csrf_field() .'
                            <button type="submit" class="btn btn-sm btn-icon text-white btn-danger"><i class="fa fa-trash"></i></button>
                        </form>
                        <a href="'. url()->route('admin.pelatihan.index', [$periode->id]) .'" class="btn btn-sm btn-icon text-white btn-primary">Manajemen Pelatihan</a>
                    </div>';
                })
                ->make();
        }
        return view("pages.admin.periode.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.periode.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(['mulai' => 'required', 'selesai' => 'required']);
        $mulai = explode('/', $request->mulai);
        $mulai = Carbon::createFromDate($mulai[1], $mulai[0])->startOfMonth();
        $selesai = explode('/', $request->selesai);
        $selesai = Carbon::createFromDate($selesai[1], $selesai[0])->startOfMonth();
        $store = Periode::create(['mulai' => $mulai, 'selesai' => $selesai]);
        return redirect()->route('admin.periode.index')->with('alert', ['title' => 'Sukses', 'text' => 'Tambah Data Berhasil.']);
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
    public function edit(Periode $periode)
    {
        return view('pages.admin.periode.edit', compact('periode'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Periode $periode)
    {
        $request->validate(['mulai' => 'required', 'selesai' => 'required']);
        $mulai = explode('/', $request->mulai);
        $mulai = Carbon::createFromDate($mulai[1], $mulai[0])->startOfMonth();
        $selesai = explode('/', $request->selesai);
        $selesai = Carbon::createFromDate($selesai[1], $selesai[0])->startOfMonth();
        $update = $periode->update(['mulai' => $mulai, 'selesai' => $selesai]);
        return redirect()->route('admin.periode.index')->with('alert', ['title' => 'Sukses', 'text' => 'Update Data Berhasil.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Periode $periode)
    {
        $delete = $periode->delete();
        return redirect()->back()->with('alert', ['title' => 'Sukses', 'text' => 'Hapus Data Berhasil.']);
    }
}
