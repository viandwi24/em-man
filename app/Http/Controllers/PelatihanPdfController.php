<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use App\Models\Pelatihan;
use App\Models\Periode;
use App\Models\Web;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;

class PelatihanPdfController extends Controller
{
    public function __construct() {
        PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif', 'orientation' => 'landscape']);
    }

    private function pdf($view, $data, $name = "", $orientation = "potrait", $download = false)
    {
        $name = $name . '.pdf';
        $pdf = PDF::loadView($view, $data)->setPaper('a4', $orientation);
        // return view($view, $data);
        return ($download) ? $pdf->download($name) : $pdf->stream($name);
    }

    public function usulan(Periode $periode, Pelatihan $pelatihan)
    {
        return $this->pdf(
            'pages.admin.pelatihan.pdf.usulan',
            compact('periode', 'pelatihan'),
            "usulan-kegiatan-pelatihan",
            "landscape"
        );
    }

    public function daftar_hadir(Periode $periode, Pelatihan $pelatihan)
    {
        return $this->pdf(
            'pages.admin.pelatihan.pdf.daftar_hadir',
            compact('periode', 'pelatihan'),
            "daftar-hadir",
            "potrait"
        );
    }

    public function laporan(Periode $periode, Pelatihan $pelatihan)
    {
        return $this->pdf(
            'pages.admin.pelatihan.pdf.laporan',
            compact('periode', 'pelatihan'),
            "laporan",
            "potrait"
        );
    }

    public function evaluasi(Periode $periode, Pelatihan $pelatihan)
    {
        return $this->pdf(
            'pages.admin.pelatihan.pdf.evaluasi',
            compact('periode', 'pelatihan'),
            "evaluasi",
            "potrait"
        );
    }

    public function riwayat(Periode $periode, Pelatihan $pelatihan)
    {
        $karyawan = Karyawan::findOrFail(request()->get('karyawan', null));
        return $this->pdf(
            'pages.admin.pelatihan.pdf.riwayat',
            compact('periode', 'pelatihan', 'karyawan'),
            "riwayat",
            "potrait"
        );
    }

    public function sertifikat(Periode $periode, Pelatihan $pelatihan)
    {
        $karyawan = Karyawan::findOrFail(request()->get('karyawan', null));
        $web = Web::first();
        return $this->pdf(
            'pages.admin.pelatihan.pdf.sertifikat',
            compact('periode', 'pelatihan', 'karyawan', 'web'),
            "sertifikat",
            "potrait"
        );
    }
}
