@extends('layouts.admin')

@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Edit Pelatihan</h4>
            </div>
            <div class="card-body">

                <form id="form" action="{{ url()->route('admin.pelatihan.update', [$periode->id, $pelatihan->id]) }}" method="post">
                    @csrf
                    @method('put')
                    <input type="hidden" name="karyawan" value="">
                    <input type="hidden" name="materi" value="">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="umum-tab" data-toggle="tab" href="#umum">Umum</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="karyawan-tab" data-toggle="tab" href="#karyawan">Karyawan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="materi-tab" data-toggle="tab" href="#materi">Materi</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="usulan-tab" data-toggle="tab" href="#usulan">Usulan Hasil</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="laporan-tab" data-toggle="tab" href="#laporan">laporan Hasil</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="evaluasi-tab" data-toggle="tab" href="#evaluasi">Evaluasi</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="umum" role="tabpanel" aria-labelledby="umum-tab">
                            <div class="form-group">
                                <label>Nama</label>
                                <input type="text" name="nama" class="form-control" value="{{ old('nama', $pelatihan->nama) }}">
                            </div>
                            
                            <div class="form-group">
                                <label>Nama Instruktur</label>
                                <input type="text" name="instruktur" class="form-control" value="{{ old('instruktur', $pelatihan->instruktur) }}">
                            </div>
                            
                            <div class="form-group">
                                <label>Lokasi</label>
                                <input type="text" name="lokasi" class="form-control" value="{{ old('lokasi', $pelatihan->lokasi) }}">
                            </div>

                            <div class="form-group">
                                <label>Tanggal Pelatihan</label>
                                <input placeholder="Click for select date..." readonly type="text" name="pelatihan" class="form-control datepicker" value="{{ old('pelatihan', $pelatihan->pelatihan == null ? '' : $pelatihan->pelatihan->format('m/d/Y')) }}">
                            </div>
                            
                            
                            <div class="form-group">
                                <label>No Dokumentasi</label>
                                <input type="text" name="no_dokumentasi" class="form-control" value="{{ old('no_dokumentasi', $pelatihan->no_dokumentasi) }}">
                            </div>
                            
                            <div class="form-group">
                                <label>No Revisi</label>
                                <input type="text" name="no_revisi" class="form-control" value="{{ old('no_revisi', $pelatihan->no_revisi) }}">
                            </div>

                            <div class="form-group">
                                <label>Tanggal Dokumen Terbit</label>
                                <input placeholder="Click for select date..." readonly type="text" name="terbit" class="form-control datepicker" value="{{ old('terbit', $pelatihan->terbit == null ? '' : $pelatihan->terbit->format('m/d/Y')) }}">
                            </div>

                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Dibuat Oleh</label>
                                        <input type="text" name="dibuat" class="form-control" value="{{ old('dibuat', $pelatihan->dibuat) }}">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Jabatan</label>
                                        <input placeholder="Ex: Kepala Bagian" type="text" name="dibuat_jabatan" class="form-control" value="{{ old('dibuat_jabatan', $pelatihan->dibuat_jabatan) }}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Disetujui Oleh</label>
                                        <input type="text" name="disetujui" class="form-control" value="{{ old('disetujui', $pelatihan->disetujui) }}">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Jabatan</label>
                                        <input placeholder="Ex: Manajer" type="text" name="disetujui_jabatan" class="form-control" value="{{ old('disetujui_jabatan', $pelatihan->disetujui_jabatan) }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade show" id="karyawan" role="tabpanel" aria-labelledby="karyawan-tab">
                            <a class="btn btn-sm btn-primary" href="#" @click.prevent="modalTambah"><i class="ft-plus"></i> Tambah Karyawan</a>
                            <div class="table-responsive mt-2">
                                <table class="table table-hover table-bordered">
                                    <thead>
                                        <th>#</th>
                                        <th>Nama</th>
                                        <th>...</th>
                                    </thead>
                                    <tbody>
                                        <tr v-if="karyawan.length == 0">
                                            <td colspan="3" class="text-center">Tidak ada karyawan.</td>
                                        </tr>
                                        <tr v-for="(item, i) in karyawan">
                                            <td>@{{ i+1 }}</td>
                                            <td>@{{ item.nama }}</td>
                                            <td>
                                                <button @click.prevent="hapusKaryawan(i)" class="btn btn-sm btn-danger">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade show" id="materi" role="tabpanel" aria-labelledby="materi-tab">
                            <a class="btn btn-sm btn-primary" href="#" @click.prevent="tambahMateri"><i class="ft-plus"></i> Tambah Materi</a>
                            <div class="table-responsive mt-2">
                                
                                <!-- table -->
                                <table class="table table-hover table-bordered">
                                    <thead>
                                        <th>#</th>
                                        <th>Materi</th>
                                        <th>...</th>
                                    </thead>
                                    <tbody>
                                        <tr v-if="materi.length == 0">
                                            <td colspan="3" class="text-center">Tidak ada materi.</td>
                                        </tr>
                                        <tr v-for="(item, i) in materi" :key="i">
                                            <th>@{{ i+1 }}</th>
                                            <th>
                                                <input v-model="materi[i]" type="text" class="form-control form-control-sm">
                                            </th>
                                            <th>
                                                <button @click.prevent="hapusMateri(i)" class="btn btn-sm btn-danger">
                                                    <i class="fa fa-times"></i>
                                                </button>
                                            </th>
                                        </tr>
                                    </tbody>
                                </table>

                            </div>
                        </div>
                        <div class="tab-pane fade show" id="usulan" role="tabpanel" aria-labelledby="usulan-tab">
                            <div class="form-group">
                                <label for="usulanHasil">Hasil Yang Diharapkan :</label>
                                <textarea name="usulan[hasil]" class="form-control">{{ $pelatihan->usulan->hasil }}</textarea>
                            </div>
                        </div>
                        <div class="tab-pane fade show" id="laporan" role="tabpanel" aria-labelledby="laporan-tab">
                            <div class="form-group">
                                <label for="laporanHasil">Hasil :</label>
                                <textarea name="laporan[hasil]" class="form-control">{{ $pelatihan->laporan->hasil }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="laporanKesimpulan">Kesimpulan :</label>
                                <textarea name="laporan[kesimpulan]" class="form-control">{{ $pelatihan->laporan->kesimpulan }}</textarea>
                            </div>
                        </div>
                        <div class="tab-pane fade show" id="evaluasi" role="tabpanel" aria-labelledby="evaluasi-tab">
                            <div class="form-group">
                                <label for="evaluasiHasil">Hasil :</label>
                                <textarea name="evaluasi[hasil]" class="form-control">{{ $pelatihan->evaluasi->hasil }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="evaluasiEvaluasi">Evaluasi :</label>
                                <textarea name="evaluasi[evaluasi]" class="form-control">{{ $pelatihan->evaluasi->evaluasi }}</textarea>
                            </div>
                        </div>
                    </div>
                </form>

                <div class="m-4">
                    <button @click.prevent="submit" class="btn btn-primary float-right"><i class="fa fa-save"></i> Perbarui</button>
                </div>

            </div>
        </div>
    </div>
@stop

@push('modal')
<div class="modal fade" id="modalTambah" tabindex="-1" role="dialog" aria-labelledby="modalTambahLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTambahLabel">Tambah Karyawan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="modal-body">
                <label>Pilih Karyawan :</label>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal" @click="tambahKaryawan">Tambah</button>
            </div>
        </div>
    </div>
</div>
@endpush

@push('css-library')
    <link rel="stylesheet" href="{{ asset('assets/modules/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/themes/base/jquery-ui.css">
@endpush

@push('js-library')
<script
    src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js"
    integrity="sha256-eGE6blurk5sHj+rmkfsGYeKyZx3M4bG+ZlFyA7Kns7E="
    crossorigin="anonymous"></script>
@endpush

@push('js')
    <script src="{{ asset('assets/modules/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('assets/js/vue.min.js') }}"></script>
    <script>
        const app = new Vue({
            el: '#app',
            data: {
                materi: @JSON($pelatihan->materi),
                karyawanSelect2: @JSON($karyawans->array()),
                karyawans: @JSON($karyawans->original()),
                karyawan: @JSON($pelatihan->karyawan),
                karyawan_value: @JSON($pelatihan->karyawan->pluck('id')),
            },
            methods: {
                getAsesorSelect() {
                    let data = this.karyawan_value
                    let result = this.karyawanSelect2.filter(e => !data.includes(e.id))
                    return result
                },
                submit() {
                    $('form#form input[name=materi]').val( JSON.stringify(this.materi) );
                    $('form#form input[name=karyawan]').val( JSON.stringify(this.karyawan_value) );
                    $('form#form').submit();
                },
                modalTambah() {
                    if ($('#karyawan_id').hasClass("select2-hidden-accessible")) $('#karyawan_id').select2("destroy")
                    $('#modal-body #karyawan_id').remove()
                    $('#modal-body').append(`<select name="karyawan_id" class="select2 form-control" id="karyawan_id" style="width: 100%;"></select>`)
                    $('#karyawan_id').select2({ data: this.getAsesorSelect(), dropdownParent: $('#modalTambah') });
                    $('#modalTambah').modal('show');
                },
                tambahKaryawan() {
                    let karyawan_id = parseInt( $('#karyawan_id').val() );
                    this.karyawan_value.push(karyawan_id);
                    this.karyawan.push( this.karyawans.find(e => e.id === karyawan_id) );
                },
                hapusKaryawan(index) {
                    this.karyawan.splice(index, 1);
                    this.karyawan_value.splice(index, 1);
                },
                tambahMateri() {
                    this.materi.push('')
                },
                hapusMateri(index) {
                    this.materi.splice(index, 1);
                }
            }
        });
        $( function() { $( ".datepicker" ).datepicker(); });
    </script>
@endpush