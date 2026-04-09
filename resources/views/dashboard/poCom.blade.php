@extends('layouts.app_home')

@section('header')
<link rel="stylesheet" href="{{ asset('assets/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}">
@endsection

@section('content')

    <div class="main-container">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <nav aria-label="breadcrumb" role="navigation" class="pull-left">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="icon-home fa"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">PO Confimation</li>
                        </ol>
                    </nav>
                    <div class="pull-right ">
                        <a href="{{ route('home') }}" class="btn btn-danger btn-sm fsDefault" style="margin-left: 12px;">
                            <i class="fas fa-angle-double-left"></i> Back
                        </a>
                    </div>
                    <div class="pull-right ">
                        <div class="input-group input-group-sm input-daterange pull-right" style="width: 150px;">
                            <input type="text" id="strDate" name="strDate" class="form-control input-sm">
                            <div class="input-group-append">
                              <button class="btn btn-success" id="btnCari" type="submit"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                        <div class="pull-right" style="padding: 6px 6px 0px;"><h5><strong>PO Date :</strong></h5></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div id="accordion" class="panel-group">
                <div class="card card-default">
                    <div class="card-header" >
                        <h4 class="card-title" style="color: #32395c;"> LIST KONFIRMASI PO </a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="panel panel-default" style="border-color: #ddd;">
                            <div id="listItems" class="panel-body">
                                {{-- @if (Auth::user()->user_type == 'admin')
                                <a href="#" class="add-modal btn btn-primary btn-sm mb-2 fsDefault"><li><i class="fa fa-plus"></i> Tambah Data</li></a>
                                @endif --}}
                                <table class="table table-hover table-responsive table-bordered mb-0 data-table">
                                    <thead>
                                        <tr>
                                            <th class="txtCenter" width="20">No</th>
                                            <th class="txtCenter" width="80">Supplier</th>
                                            <th class="" width="100">Nomor PO</th>
                                            <th class="txtCenter" width="100">Tanggal PO</th>
                                            <th class="txtCenter" width="250">Status Konfirmasi PO</th>
                                            <th class="txtCenter" width="150">Tanggal Konfirmasi PO</th>
                                            <th class="txtCenter" width="100">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div style="clear: both"></div>
        </div>
    </div>

    <div id="addModal" class="modal fade" tabindex="-1" role="dialog" style="display: none;" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"></h4>
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('/pocom') }}" method="POST" class="form-body" role="form" autocomplete="off" id="frmUploadKanban">
                        @csrf
                        <input type="hidden" id="FILENAME_UPD" name="FILENAME_UPD">
                        <input type="hidden" id="FGJENIS" name="FGJENIS">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="PONO">Nomor PO</label>
                                    <input type="text" class="form-control" id="PONO" name="PONO" placeholder="PONO"  onkeyup="this.value = this.value.toUpperCase();" readonly style="background-color: transparent;">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="TANGGAL">Tanggal PO</label>
                                    <input type="text" class="form-control datepicker" id="TANGGAL" name="TANGGAL" placeholder="dd/mm/yyyy" readonly style="background-color: transparent;">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <span class="control-fileupload">
                                    <label for="file" class="text-left" id="vFileName">Pilih File di Komputer Anda.</label>
                                    <input type="file" name="FILENAME" id="FILENAME">
                                </span>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-sm download fsDefault" data-dismiss="modal">
                        <span class='glyphicon glyphicon-remove'></span> Tutup
                    </button>
                    <button type="button" class="btn btn-primary btn-sm add fsDefault" data-dismiss="modal">
                        <span class='glyphicon glyphicon-check'></span> Simpan
                    </button>
                    <button type="button" class="btn btn-primary btn-sm edit fsDefault" data-dismiss="modal">
                        <span class='glyphicon glyphicon-check'></span> Simpan
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal form to delete a form Keluarga-->
    <div id="deleteModal" class="modal fade" tabindex="-1" role="dialog" style="display: none;" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title-del"></h4>
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                </div>
                <div class="modal-body">
                    <h3 class="text-center">Anda yakin untuk menghapus data ini?</h3>
                    <input type="hidden" id="PONO_DEL">
                    {{-- <br /> --}}
                    <div class="modal-footer">
                        <button type="button" class="btn btn-warning btn-sm fsDefault" data-dismiss="modal">
                            <span class='glyphicon glyphicon-remove'></span> Tutup
                        </button>
                        <button type="button" class="btn btn-danger btn-sm delete fsDefault" data-dismiss="modal">
                            <span id="" class='glyphicon glyphicon-trash'></span> Hapus
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('footer')
<script src="{{ asset('assets/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>

<script>
    var table = '';
    var vUrl = '{{ route('pocom') }}';
    var vtampDate = '{{ Request::segment(2) }}';

    if (vtampDate != '') {
        vUrl = '{{ route('pocom') }}'+'/'+vtampDate+'/date';
    }
    $(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            autoWidth: false,
            ajax: vUrl,
            @if (Auth::user()->user_type != 'admin')
            columnDefs: [
                { visible: false, width: 40, targets: 1 },
                { width: 100, targets: 2},
                { width: 120, targets: 3},
                { width: 330, targets: 4},
                { width: 200, targets: 5},
                { width: 70, targets: 6}
              ],
            @endif
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                {data: 'SUPPLIERCODE', name: 'SUPPLIERCODE'},
                {data: 'PONO', name: 'PONO'},
                {data: 'TANGGAL', name: 'TANGGAL'},
                {data: 'VER', name: 'VER'},
                {data: 'VERDATE', name: 'VERDATE'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ],
            aLengthMenu: [[25, 50, 75, -1], [25, 50, 75, "All"]],
            iDisplayLength: 25,
            rowCallback: function( row, data, index ) {
                $('td', row).css({'padding':'4px 8px'});
                $('td:eq(-1)', row).css({'text-align':'center'});
                $('td:eq(0)', row).css({'text-align':'right'});
                @if (Auth::user()->user_type == 'admin')
                $('td:eq(1)', row).css({'text-align':'left'});
                $('td:eq(2)', row).css({'text-align':'left'});
                $('td:eq(3)', row).css({'text-align':'center'});
                $('td:eq(4)', row).css({'text-align':'center'});
                $('td:eq(5)', row).css({'text-align':'center'});
                @else
                $('td:eq(1)', row).css({'text-align':'left'});
                $('td:eq(2)', row).css({'text-align':'center'});
                $('td:eq(3)', row).css({'text-align':'center'});
                $('td:eq(4)', row).css({'text-align':'center'});
                @endif
            },
        });
    });
</script>

<script>
    var currentDate = new Date()
    var vTgl = '';

    $('#btnCari').on('click', function() {
        var sDate = $('#strDate').val();
        if (sDate == '') { sDate = currentDate.getFullYear();}
        var strDate = sDate.substring(3, 7)+''+sDate.substring(0, 2);

        window.location.href="{{ route('pocom') }}"+"/"+strDate+"/date";
    });

    $('.input-daterange input').each(function() {
        $(this).datepicker({
            format: 'mm/yyyy',
            autoclose: true,
            allowInputToggle: true,
            viewMode: "months",
            minViewMode: "months"
        });
    });
</script>

<script>
    var vDate = new Date();
    var dd = String(vDate.getDate()).padStart(2, '0');
    var mm = String(vDate.getMonth() + 1).padStart(2, '0');
    var yyyy = vDate.getFullYear();

    vDate = dd + '/' + mm + '/' + yyyy;

    if (vtampDate != '') {
        vDate = vtampDate.substring(4, 6)+'/'+vtampDate.substring(0, 4);
    }

    $(".card .card-header").css({"background-color": "rgb(0 43 255 / 19%)", "border": "1px solid #002bff17"});
    $("#strDate").datepicker("update", vDate);
</script>

<script>
    // add a new post
    // $(document).on('click', '.add-modal', function() {
    //     $('.modal-title').text('Tambah Data Kanban');
    //     $('#DATADATE').val('');
    //     $('#SUPPLIERCODE').val('');
    //     $('#DESCRIPTION').val('');
    //     $('#vFileName').text('Pilih File di Komputer Anda.');
    //     $('#addModal').modal({backdrop: 'static', keyboard: true});
    //     $('.edit').hide();
    //     $('.add').show();
    // });

    $('.datepicker').datepicker({
        format: "dd/mm/yyyy",
        autoclose: true,
        allowInputToggle: true
    });

    $(function() {
        $('input[type=file]').change(function(){
            var t = $(this).val();
            var labelText = 'File : ' + t.substr(12, t.length);
            $(this).prev('label').text(labelText);
        })
    });

    // $('.modal-footer').on('click', '.add', function() {
    //     var formData = new FormData($('#frmUploadKanban')[0]);
    //     // var img = formData.get('FILENAME');
    //     $.ajax({
    //         type: 'POST',
    //         url: '{{ url('/kanbanexcel') }}',
    //         data: formData,
    //         contentType: false,
    //         processData: false,
    //         success: function(data) {

    //             if ((data.errors)) {
    //                 setTimeout(function () {
    //                     $('#addModal').modal('show');
    //                     toastr.error('Validation error!', 'Error Alert', {timeOut: 5000});
    //                 }, 500);
    //             } else {
    //                 toastr.success('Data Berhasil di Simpan!', {timeOut: 5000});
    //                 // $('#itemBody').load(location.href +' #itemBody>*','');
    //                 table.draw();
    //             }
    //         },
    //         error: function (data) {
    //             console.log('Error:', data);
    //         }
    //     });
    // });

    $(document).on('click', '.edit-modal', function() {
        var id = $(this).data('id');
        $.ajax({
            type: 'GET',
            url : '{{ url('/pocom') }}/'+id+'/edit',
            data: '',
            success: function(data)
            {
                $('.title-pend').text('Ubah Data Kanban');
                $('#PONO').val(data.PONO);
                $('#FGJENIS').val(data.FGJENIS);
                $('#FILENAME_UPD').val(data.UPLOAD);
                $('#TANGGAL').datepicker('update',new Date(data.TANGGAL));
                $('#vFileName').text('Pilih File di Komputer Anda.');
                $('#addModal').modal({backdrop: 'static', keyboard: true});
                $('.add').hide();
                $('.edit').show();
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });

    $('.modal-footer').on('click', '.edit', function() {
        var formData = new FormData($('#frmUploadKanban')[0]);
        // var img = formData.get('FILENAME_UPD');
        $.ajax({
            type: 'POST',
            url: '{{ url('/pocom_upd') }}',
            data: formData,
            contentType: false,
            processData: false,
            success: function(data) {
                if ((data.errors)) {
                    setTimeout(function () {
                        $('#addModal').modal('show');
                        toastr.error('Validation error!', 'Error Alert', {timeOut: 5000});
                    }, 500);
                } else {
                    toastr.success('Data Berhasil di Simpan!', {timeOut: 5000});
                    // $('#itemBody').load(location.href +' #itemBody>*','');
                    table.draw();
                }
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });

    $(document).on('click', '.delete-modal', function() {
        $('#PONO_DEL').val($(this).data('id'));
        $('.modal-title-del').text('Delete Kanban');
        $('#deleteModal').modal('show');
    });

    $('.modal-footer').on('click', '.delete', function() {
        $.ajax({
            type: 'DELETE',
            url: '{{ url('/pocom') }}',
            data: {
                '_token': $('input[name=_token]').val(),
                'PONO': $('#PONO_DEL').val(),
            },
            success: function(data) {
                toastr.success('Data Berhasil di Hapus!', {timeOut: 5000});
                // $('#itemBody').load(location.href +' #itemBody>*','');
                table.draw();
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });
</script>
@endsection
