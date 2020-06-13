@extends('layouts.admin')

@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Tambah Periode Pelatihan</h4>
            </div>
            <div class="card-body">
                <form action="{{ url()->route('admin.periode.store') }}" method="post">
                    @csrf
                    
                    <div class="form-group">
                        <label for="startDate">Mulai :</label>
                        <input readonly placeholder="Click to select date..." name="mulai" id="startDate" class="form-control date-picker" />
                    </div>

                    <div class="form-group">
                        <label for="finishDate">Sampai :</label>
                        <input readonly placeholder="Click to select date..." name="selesai" id="finishDate" class="form-control date-picker" />
                    </div>

                    <button class="btn btn-primary float-right"><i class="fa fa-save"></i> Tambah</button>
                </form>
            </div>
        </div>
    </div>
@stop

@push('css')
    <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/themes/base/jquery-ui.css">
    <style>
    .ui-datepicker-calendar {
        display: none;
    }
    </style>
@endpush

@push('js-library')
<script
    src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js"
    integrity="sha256-eGE6blurk5sHj+rmkfsGYeKyZx3M4bG+ZlFyA7Kns7E="
    crossorigin="anonymous"></script>
@endpush

@push('js') 
    <script>
        $(function() {
            $('.date-picker').datepicker({
                dateFormat: "mm/yy",
                changeMonth: true,
                changeYear: true,
                showButtonPanel: true,
                onClose: function(dateText, inst) {
                    function isDonePressed(){
                        return ($('#ui-datepicker-div').html().indexOf('ui-datepicker-close ui-state-default ui-priority-primary ui-corner-all ui-state-hover') > -1);
                    }
                    if (isDonePressed()){
                        var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
                        var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
                        $(this).datepicker('setDate', new Date(year, month, 1)).trigger('change');
                        $('.date-picker').focusout();
                    }
                },
                beforeShow : function(input, inst) {
                    inst.dpDiv.addClass('month_year_datepicker')
                    if ((datestr = $(this).val()).length > 0) {
                        year = datestr.substring(datestr.length-4, datestr.length);
                        month = datestr.substring(0, 2);
                        $(this).datepicker('option', 'defaultDate', new Date(year, month-1, 1));
                        $(this).datepicker('setDate', new Date(year, month-1, 1));
                        $(".ui-datepicker-calendar").hide();
                    }
                }
            })
        });
    </script>
@endpush