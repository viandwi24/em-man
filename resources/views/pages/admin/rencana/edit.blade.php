@extends('layouts.admin')

@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Edit Rencana</h4>
            </div>
            <div class="card-body">
                <form id="form" action="{{ url()->route('admin.rencana.update', [$rencana->id]) }}" method="post">
                    @csrf
                    @method('put')
                    
                    <div class="form-group">
                        <label>Judul</label>
                        <input value="{{ $rencana->judul }}" type="text" name="judul" class="form-control">
                    </div>
                    <input type="hidden" name="jadwal">

                    <button type="button" @click="addNewRow" class="btn btn-sm btn-success"> <i class="fa fa-plus"></i> Tambah </button>
                    <table class="table table-hover table-bordered mt-2">
                        <thead>
                            <th>#</th>
                            <th>Waktu</th>
                            <th>Kegiatan</th>
                            <th>...</th>
                        </thead>
                        <tbody>
                            <tr v-for="(item, i) in jadwal">
                                <td>@{{ i+1 }}</td>
                                <td>
                                    <input v-model="jadwal[i].waktu" type="text" class="form-control form-control-sm">
                                </td>
                                <td>
                                    <input v-model="jadwal[i].kegiatan" type="text" class="form-control form-control-sm">
                                </td>
                                <td>
                                    <button type="button" @click="remove(i)" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <button type="button" @click="submit" class="btn btn-primary float-right"><i class="fa fa-save"></i> Tambah</button>
                </form>
            </div>
        </div>
    </div>
@stop

@push('js')
    <script src="{{ asset('assets/js/vue.min.js') }}"></script>
    <script>
        var vm = new Vue({
            el: '#app',
            data: {
                jadwal: @json($rencana->jadwal)
            },
            methods: {
                addNewRow() {
                    this.jadwal.push({ waktu: '', kegiatan: '' })
                },
                remove(index) {
                    if (this.jadwal.length == 1) return
                    this.jadwal.splice(index, 1)
                },
                submit() {
                    $('input[name=jadwal]').val(JSON.stringify(this.jadwal))
                    $('form#form').submit()
                }
            }
        })
    </script>
@endpush