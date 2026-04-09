@extends('layouts.app_home')

@section('header')
<link rel="stylesheet" href="{{ asset('assets/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/bootstrap-select/css/bootstrap-select.min.css') }}">
@endsection

@section('content')
     
    <div class="main-container">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <nav aria-label="breadcrumb" role="navigation" class="pull-left">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="icon-home fa"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">Sales Order</li>
                        </ol>
                    </nav>
                    <div class="pull-right ">
                        <a href="{{ route('home') }}" class="btn btn-danger btn-sm fsDefault" style="margin-left: 12px;">
                            <i class="fas fa-angle-double-left"></i> Back
                        </a>
                    </div>
                    {{-- <div class="pull-right ">  
                        <div class="input-group input-group-sm input-daterange pull-right" style="width: 150px;">
                            <input type="text" id="strDate" name="strDate" class="form-control input-sm">
                            <div class="input-group-append">
                              <button class="btn btn-success" id="btnCari" type="submit"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                        <div class="pull-right" style="padding: 6px 6px 0px;"><h5><strong>SO Date :</strong></h5></div>
                    </div> --}}
                </div>
            </div>
        </div>

        <div class="container">
            <div id="accordion" class="panel-group">
                <div class="card card-default">
                    <div class="card-header" >
                        <h4 class="card-title"><a href="#items" aria-expanded="true" data-toggle="collapse" class=""> SALES ORDER LIST </a>
                        </h4>
                    </div>
                    <div class="panel-collapse collapse show" id="items" style="">
                        <div class="card-body">                             
                            <div class="page-content">
                                <button type="button" class="add-modal btn btn-primary btn-sm mb-2 float-left"><i class="fa fa-plus-square"></i> Add</button>
                                <button type="button" class="edt-modal btn btn-primary btn-sm mb-2 ml-1 float-left" disabled><i class="fa fa-edit"></i> Edit</button>
                                <button type="button" class="del-modal btn btn-danger btn-sm mb-2 ml-1 float-left" disabled><i class="fa fa-trash"></i> Delete</button>
                                <div class="float-right">
                                    <button class="src-modal btn btn-success btn-sm mb-2">
                                        <i class="fa fa-search"></i> Search
                                    </button>
                                </div>
                                <div class="clearfix"></div>
                                <div class="panel panel-default" style="border-color: #ddd;">                        
                                    <div class="panel-body">
                                        <form class="form-horizontal" id="frmSoHd" autocomplete="off">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group row" style="margin-bottom: 8px;">
                                                        <label for="iPONO" class="col-3 col-sm-2 col-md-3 col-form-label col-form-label-sm ">No.</label>
                                                        <div class="col-9 col-sm-10 col-md-9">
                                                            <input type="text" class="form-control form-control-sm noBg" style="height: 30px;" name="iPONO" id="iPONO" {{-- value="EE0178362" --}} readonly>
                                                        </div>                                                        
                                                    </div>
                                                    <div class="form-group row" style="margin-bottom: 8px;">
                                                        <label for="iPODATE" class="col-3 col-sm-2 col-md-3 col-form-label col-form-label-sm">Tgl.</label>
                                                        <div class="col-9 col-sm-10 col-md-9">
                                                            <input type="text" class="form-control form-control-sm noBg" style="height: 30px;" name="iPODATE" id="iPODATE" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row" style="margin-bottom: 8px;">
                                                        <label for="iCUST" class="col-3 col-sm-2 col-md-3 col-form-label col-form-label-sm ">Nama</label>
                                                        <div class="col-9 col-sm-10 col-md-9">
                                                            <input type="text" class="form-control form-control-sm noBg" style="height: 30px;" name="iCUST" id="iCUST" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row" style="margin-bottom: 8px;">
                                                        <label for="iCITY" class="col-3 col-sm-2 col-md-3 col-form-label col-form-label-sm ">Alamat</label>
                                                        <div class="col-9 col-sm-10 col-md-9">
                                                            <input type="text" class="form-control form-control-sm noBg" style="height: 30px;" name="iCITY" id="iCITY" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row" style="margin-bottom: 8px;">
                                                        <label for="iBRANDCODE" class="col-3 col-sm-2 col-md-3 col-form-label col-form-label-sm ">Merk</label>
                                                        <div class="col-9 col-sm-10 col-md-9">
                                                            <input type="text" class="form-control form-control-sm noBg" style="height: 30px;" name="iBRANDCODE" id="iBRANDCODE" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group row" style="margin-bottom: 8px;">
                                                        <label for="iCUSTFOR" class="col-3 col-sm-2 col-md-3 col-form-label col-form-label-sm ">Untuk</label>
                                                        <div class="col-9 col-sm-10 col-md-9">
                                                            <input type="text" class="form-control form-control-sm noBg" style="height: 30px;" name="iCUSTFOR" id="iCUSTFOR" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row" style="margin-bottom: 8px;">
                                                        <label for="iADDRESSFOR" class="col-3 col-sm-2 col-md-3 col-form-label col-form-label-sm ">Jalan</label>
                                                        <div class="col-9 col-sm-10 col-md-9">
                                                            <input type="text" class="form-control form-control-sm noBg" style="height: 30px;" name="iADDRESSFOR" id="iADDRESSFOR" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row" style="margin-bottom: 8px;">
                                                        <label for="iCITYFOR" class="col-3 col-sm-2 col-md-3 col-form-label col-form-label-sm ">Kota</label>
                                                        <div class="col-9 col-sm-10 col-md-9">
                                                            <input type="text" class="form-control form-control-sm noBg" style="height: 30px;" name="iCITYFOR" id="iCITYFOR" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row" style="margin-bottom: 8px;">
                                                        <label for="iEXPEDISI" class="col-3 col-sm-2 col-md-3 col-form-label col-form-label-sm ">Exp.</label>
                                                        <div class="col-9 col-sm-10 col-md-9">
                                                            <input type="text" class="form-control form-control-sm noBg" style="height: 30px;" name="iEXPEDISI" id="iEXPEDISI" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>  
                                    </div>
                                    {{-- <div class="col-md-12">
                                        <div class="float-right">
                                            <a href="#" class="add-modal btn btn-danger btn-sm mb-2"><li><i class="fa fa-trash"></i> Hapus </li></a> 
                                            <a href="#" class="add-modal btn btn-primary btn-sm mb-2"><li><i class="fa fa-save"></i> Simpan </li></a>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div> --}}
                                </div>
                                
                                <button class="add-dt-modal btn btn-primary btn-sm mb-2 float-left" disabled>
                                    <i class="fa fa-plus-square"></i> Add Detail
                                </button>
                                <div class="clearfix"></div>
                                <div class="panel panel-default" style="border-color: #ddd;">                        
                                    <div class="panel-body">
                                        <table class="table table-hover table-responsive table-bordered mb-0 data-table-dt">
                                            <thead>
                                                <tr>
                                                    <th class="txtCenter" width="30">No</th>
                                                    <th class="txtCenter" width="750">Item</th>
                                                    <th class="txtCenter" width="70">Qty</th>
                                                    <th class="txtCenter" width="65">Action</th>
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
                </div>  
            </div>

            <div style="clear: both"></div>            
        </div>
    </div>

    <div id="addModal" class="modal fade" tabindex="-1" role="dialog" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"></h4>
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                </div>
                <div class="modal-body" style="padding-bottom: 0px;">
                    <form action="" method="POST" class="form-body" role="form" autocomplete="off" id="frmHDSO">
                        @csrf
                        <div class="row"> 
                            <div class="col-md-6">
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                            <label for="PONO">Nomor</label>
                                            <input type="text" class="form-control" id="PONO" name="PONO" placeholder="EE0000000"  onkeyup="this.value = this.value.toUpperCase();" required>
                                    </div>                          
                                    <div class="form-group col-md-6">
                                            <label for="PODATE">Tanggal</label>
                                            <input type="text" class="form-control datepicker" id="PODATE" name="PODATE" placeholder="dd/mm/yyyy" readonly required style="background-color: transparent;">
                                    </div> 
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                            <label for="CUST">Customer</label>
                                            <input type="text" class="form-control" id="CUST" name="CUST" placeholder="Customer" onkeyup="this.value = this.value.toUpperCase();" required>
                                    </div> 
                                </div>   
                                <div class="form-row">    
                                    <div class="form-group col-md-7">
                                            <label for="CITY">Alamat</label>
                                            <input type="text" class="form-control" id="CITY" name="CITY" placeholder="Alamat" onkeyup="this.value = this.value.toUpperCase();" required>
                                    </div>
                                    <div class="form-group col-md-5">
                                            <label for="BRANDCODE">Merk</label>
                                            <select  class="form-control" id="BRANDCODE" name="BRANDCODE">
                                                <option value="MT">MITSUBISHI</option>
                                                <option value="MF">MARUFUKU</option>
                                            </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">  
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                            <label for="CUSTFOR">Untuk</label>
                                            <input type="text" class="form-control" id="CUSTFOR" name="CUSTFOR" placeholder="Untuk"  onkeyup="this.value = this.value.toUpperCase();" required>
                                    </div>   
                                </div> 
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                            <label for="ADDRESSFOR">Jalan</label>
                                            <input type="text" class="form-control" id="ADDRESSFOR" name="ADDRESSFOR" placeholder="Jalan"  onkeyup="this.value = this.value.toUpperCase();" required>
                                    </div>   
                                </div> 
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                            <label for="CITYFOR">Kota</label>
                                            <input type="text" class="form-control" id="CITYFOR" name="CITYFOR" placeholder="Kota"  onkeyup="this.value = this.value.toUpperCase();" required>
                                    </div>  
                                    <div class="form-group col-md-6">
                                            <label for="EXPEDISI">Exp</label>
                                            <input type="text" class="form-control" id="EXPEDISI" name="EXPEDISI" placeholder="Expedisi"  onkeyup="this.value = this.value.toUpperCase();" required>
                                    </div>  
                                </div>          
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
                    <h4 class="modal-title-del pb-0"></h4>
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

    <div id="srcModal" class="modal fade" tabindex="-1" role="dialog" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title-src pb-0"></h4>
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                </div>
                <div class="modal-body">
                    <table class="table table-hover table-responsive table-bordered mb-0 data-table-src">
                        <thead>
                            <tr>
                                <th class="txtCenter" width="30">Aksi</th>
                                <th class="txtCenter" width="60">Nomor</th>
                                <th class="txtCenter" width="60">Tanggal</th>
                                <th class="txtCenter" width="80">Nama</th>
                                <th class="txtCenter" width="120">Alamat</th>
                                <th class="txtCenter" width="100">Untuk</th>
                                <th class="txtCenter" width="100">Exp</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>  
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-sm download fsDefault" data-dismiss="modal">
                        <span class='glyphicon glyphicon-remove'></span> Tutup
                    </button> 
                </div>
            </div>
        </div>
    </div>

    <div id="addDtModal" class="modal fade" tabindex="-1" role="dialog" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title-dt pb-0"></h4>
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                </div>
                <div class="modal-body" style="padding-bottom: 0px;">
                    <form action="" method="POST" class="form-body" role="form" autocomplete="off" id="frmDtSO">
                        @csrf
                        <input type="hidden" id="vPONO" name="PONO"> 
                        <input type="hidden" id="vSEQ" name="SEQ"> 
                        <div class="form-group">
                                <label for="vTYPENO">Type No</label>
                                <select  class="form-control form-control-sm selectpicker" data-live-search="true" id="vTYPENO" name="TYPENO">
                                </select>
                        </div>                          
                        <div class="form-group">
                                <label for="vQTY">Qty</label>
                                <input type="text" class="form-control" id="vQTY" name="QTY" onkeyup="this.value = this.value.toUpperCase();">
                        </div> 
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-sm fsDefault" data-dismiss="modal">
                        <span class='glyphicon glyphicon-remove'></span> Tutup
                    </button> 
                    <button type="button" class="btn btn-primary btn-sm addDt fsDefault" data-dismiss="modal">
                        <span class='glyphicon glyphicon-check'></span> Simpan
                    </button> 
                    <button type="button" class="btn btn-primary btn-sm editDt fsDefault" data-dismiss="modal">
                        <span class='glyphicon glyphicon-check'></span> Simpan
                    </button> 
                </div>
            </div>
        </div>
    </div>

    <div id="deleteDtModal" class="modal fade" tabindex="-1" role="dialog" style="display: none;" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title-del pb-0"></h4>
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                </div>
                <div class="modal-body">
                    <h3 class="text-center">Anda yakin untuk menghapus data ini?</h3>
                    <input type="hidden" id="SEQ_DEL"> 
                    {{-- <br /> --}}
                    <div class="modal-footer">
                        <button type="button" class="btn btn-warning btn-sm fsDefault" data-dismiss="modal">
                            <span class='glyphicon glyphicon-remove'></span> Tutup
                        </button>
                        <button type="button" class="btn btn-danger btn-sm deleteDt fsDefault" data-dismiss="modal">
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
<script src="{{ asset('assets/bootstrap-select/js/bootstrap-select.min.js') }}"></script>

<script>
    var currentDate = new Date()
    var vTgl = '';
    var table = '';
    var tableDt = '';
    var mrk = '';
    
    $('#btnCari').on('click', function() {
        var sDate = $('#strDate').val();
        if (sDate == '') { sDate = currentDate.getFullYear();}
        var strDate = sDate.substring(6, 10)+''+sDate.substring(3, 5)+''+sDate.substring(0, 2); 

        window.location.href="{{ route('salesorder') }}"+"/"+strDate+"/date";
    });

    $('.input-daterange input').each(function() {
        $(this).datepicker({
            format: 'dd/mm/yyyy',
            autoclose: true,
            allowInputToggle: true 
        });
    });

    // $(function() {
    function DetailData() {          
        tableDt = $('.data-table-dt').DataTable({
            processing: true,
            serverSide: true,
            autoWidth: false,
            destroy: true,
            ajax: "{{ url('salesorder_dt') }}"+"/"+$('#iPONO').val(),
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                {data: 'TYPENO', name: 'TYPENO'},
                {data: 'QTY', name: 'QTY'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ],
            aLengthMenu: [[25, 50, 75, -1], [25, 50, 75, "All"]],
            iDisplayLength: 25,
            rowCallback: function( row, data, index ) {
                $('td', row).css({'padding':'4px 8px'});
                $('td:eq(0)', row).css({'text-align':'center'});
                $('td:eq(2)', row).css({'text-align':'right'});
                $('td:eq(3)', row).css({'text-align':'center'});
            },
        });
    }
    // });

    function srcData() {          
        table = $('.data-table-src').DataTable({
            processing: true,
            serverSide: true,
            autoWidth: false,
            destroy: true,
            ajax: "{{ route('salesorder_src') }}",
            columns: [
                {data: 'action', name: 'action', orderable: false, searchable: false},
                {data: 'PONO', name: 'PONO'},
                {data: 'PODATE', name: 'PODATE'},
                {data: 'CUST', name: 'CUST'},
                {data: 'CITY', name: 'CITY'},
                {data: 'CUSTFOR', name: 'CUSTFOR'},
                {data: 'EXPEDISI', name: 'EXPEDISI'},
            ],
            aLengthMenu: [[25, 50, 75, -1], [25, 50, 75, "All"]],
            iDisplayLength: 25,
            rowCallback: function( row, data, index ) {
                $('td', row).css({'padding':'4px 8px'});
                $('td:eq(0)', row).css({'text-align':'center'});
            },
        });
    }

    var vtampDate = '{{ Request::segment(2) }}';
    var vDate = new Date();
    var dd = String(vDate.getDate()).padStart(2, '0');
    var mm = String(vDate.getMonth() + 1).padStart(2, '0'); //January is 0!
    var yyyy = vDate.getFullYear();

    vDate = dd + '/' + mm + '/' + yyyy;

    if (vtampDate != '') {
        vDate = vtampDate.substring(6, 8)+'/'+vtampDate.substring(4, 6)+'/'+vtampDate.substring(0, 4);
    } 

    $(".card .card-header").css({"background-color": "rgb(0 43 255 / 19%)", "border": "1px solid #002bff17"});
    $("#strDate").datepicker("update", vDate);

    $('.datepicker').datepicker({
        format: "dd/mm/yyyy",
        autoclose: true,
        allowInputToggle: true
    });

    $(document).on('click', '.add-modal', function() {
        $('.modal-title').text('Tambah Data Sales Order');
        $('#PODATE').datepicker('update',new Date());
        $('#CUST').val('');
        $('#CITY').val('');
        $('#BRANDCODE').val('MT');
        $('#CUSTFOR').val('');
        $('#ADDRESSFOR').val('');
        $('#CITYFOR').val('');
        $('#EXPEDISI').val('');
        $('#addModal').modal({backdrop: 'static', keyboard: true});
        $.ajax({
            type: 'GET',
            url: '{{ url('/salesorderno') }}',         
            data: '',
            success: function(data) {
                $('#PONO').val(data[0].SONUM);
                console.log();
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
        $('.edit').hide();
        $('.add').show();
    });

    $('.modal-footer').on('click', '.add', function() {            
        var formData = new FormData($('#frmHDSO')[0]);
        // var img = formData.get('FILENAME');
        $.ajax({
            type: 'POST',
            url: '{{ url('/salesorder') }}',         
            data: formData,
            contentType: false,
            processData: false,
            success: function(data) {

                if ((data.errors)) {
                    setTimeout(function () {
                        $('#addModal').modal('show');
                        toastr.error('Validation error!', 'Error Alert', {timeOut: 5000});
                        $('#addModal').modal({backdrop: 'static', keyboard: true});
                    }, 500);
                } else {
                    toastr.success('Data Berhasil di Simpan!', {timeOut: 5000});
                    $('#iPONO').val($('#PONO').val());
                    $('#iPODATE').val($('#PODATE').val());
                    $('#iCUST').val($('#CUST').val());
                    $('#iCITY').val($('#CITY').val());
                    $('#iBRANDCODE').val($('#BRANDCODE').val());
                    $('#iCUSTFOR').val($('#CUSTFOR').val());
                    $('#iADDRESSFOR').val($('#ADDRESSFOR').val());
                    $('#iCITYFOR').val($('#CITYFOR').val());
                    $('#iEXPEDISI').val($('#EXPEDISI').val());
                    fSelectPicker($('#iBRANDCODE').val());
                    $('.edt-modal').attr('disabled',false);
                    $('.del-modal').attr('disabled',false);
                    $('.add-dt-modal').attr('disabled',false);
                    DetailData();
                }
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });

    $(document).on('click', '.edt-modal', function() {
        var id = $('#iPONO').val();
        $.ajax({
            type: 'GET',
            url : '{{ url('/salesorder') }}/'+id+'/edit',
            data: '',
            success: function(data)
            {
                $('.modal-title').text('Ubah Data Sales Order');
                $('#PONO').val(data.PONO);
                $('#PODATE').datepicker('update',new Date(data.PODATE));
                $('#CUST').val(data.CUST);
                $('#CITY').val(data.CITY);
                $('#BRANDCODE').val(data.BRANDCODE);
                $('#CUSTFOR').val(data.CUSTFOR);
                $('#ADDRESSFOR').val(data.ADDRESSFOR);
                $('#CITYFOR').val(data.CITYFOR);
                $('#EXPEDISI').val(data.EXPEDISI);
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
        var formData = new FormData($('#frmHDSO')[0]);  
        $.ajax({
            type: 'POST',
            url: '{{ url('/salesorder_upd') }}',       
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
                    $('#iPONO').val($('#PONO').val());
                    $('#iPODATE').val($('#PODATE').val());
                    $('#iCUST').val($('#CUST').val());
                    $('#iCITY').val($('#CITY').val());
                    $('#iBRANDCODE').val($('#BRANDCODE').val());
                    $('#iCUSTFOR').val($('#CUSTFOR').val());
                    $('#iADDRESSFOR').val($('#ADDRESSFOR').val());
                    $('#iCITYFOR').val($('#CITYFOR').val());
                    $('#iEXPEDISI').val($('#EXPEDISI').val());
                    fSelectPicker($('#iBRANDCODE').val());
                    $('.edt-modal').attr('disabled',false);
                    $('.del-modal').attr('disabled',false);
                    $('.add-dt-modal').attr('disabled',false);
                    DetailData();
                }
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });

    $(document).on('click', '.del-modal', function() {
        $('#PONO_DEL').val($('#iPONO').val());
        $('.modal-title-del').text('Delete Sales Order');
        $('#deleteModal').modal('show');
    });
    
    $('.modal-footer').on('click', '.delete', function() {
        $.ajax({
            type: 'DELETE',
            url: '{{ url('/salesorder') }}',
            data: {
                '_token': $('input[name=_token]').val(),
                'PONO': $('#PONO_DEL').val(),
            },
            success: function(data) {
                toastr.success('Data Berhasil di Hapus!', {timeOut: 5000});
                clearData();
                $('.edt-modal').attr('disabled',true);
                $('.del-modal').attr('disabled',true);
                $('.add-dt-modal').attr('disabled',false);
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });

    function clearData() {
        DetailData();
        $('#iPONO').val('');
        $('#iPODATE').val('');
        $('#iCUST').val('');
        $('#iCITY').val('');
        $('#iBRANDCODE').val('');
        $('#iCUSTFOR').val('');
        $('#iADDRESSFOR').val('');
        $('#iCITYFOR').val('');
        $('#iEXPEDISI').val('');
    }

    $(document).on('click', '.src-modal', function() {
        $('.modal-title-src').text('List Data Sales Order');
        $('#srcModal').modal({backdrop: 'static', keyboard: true});
        srcData();
    });

    $(document).on('click', '.pick-modal', function() {
        var id = $(this).data('id');
        $.ajax({
            type: 'GET',
            url : '{{ url('/salesorder') }}/'+id+'/pick',
            data: '',
            success: function(data)
            {
                $('#iPONO').val(data.PONO);
                $('#iPODATE').datepicker('update',new Date(data.PODATE));
                $('#iCUST').val(data.CUST);
                $('#iCITY').val(data.CITY);
                $('#iBRANDCODE').val(data.BRANDCODE);
                $('#iCUSTFOR').val(data.CUSTFOR);
                $('#iADDRESSFOR').val(data.ADDRESSFOR);
                $('#iCITYFOR').val(data.CITYFOR);
                $('#iEXPEDISI').val(data.EXPEDISI);
                fSelectPicker($('#iBRANDCODE').val());
                $('#srcModal').modal('hide');
                $('.edt-modal').attr('disabled',false);
                $('.del-modal').attr('disabled',false);
                $('.add-dt-modal').attr('disabled',false);
                DetailData();
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });

    $(document).on('click', '.add-dt-modal', function() {
        $('.modal-title-dt').text('Tambah Detail');
        $('#vPONO').val($('#iPONO').val());
        $('#vTYPENO').val('').selectpicker('refresh');
        $('#vQTY').val('');
        $('#addDtModal').modal({backdrop: 'static', keyboard: true});
        $('.addDt').show();
        $('.editDt').hide();
    });

    function fSelectPicker(vMrk) { 
        if (mrk!=vMrk) {        
            $.ajax({
                type:'GET',
                url: '{{url('/type-list')}}/'+vMrk,
                data:'',
                success:function(html){
                    $('#vTYPENO').html(html).selectpicker('refresh');
                    console.log(mrk);
                }
            });
            mrk=vMrk;
        }
    }

    $('#vQTY').keypress(function(event){

       if(event.which != 8 && isNaN(String.fromCharCode(event.which))){
           event.preventDefault(); //stop character from entering input
       }

    });

    $('.modal-footer').on('click', '.addDt', function() {            
        var formData = new FormData($('#frmDtSO')[0]);
        $.ajax({
            type: 'POST',
            url: '{{ url('/salesorderdt') }}',         
            data: formData,
            contentType: false,
            processData: false,
            success: function(data) {

                if ((data.errors)) {
                    setTimeout(function () {
                        $('#addDtModal').modal('show');
                        toastr.error('Validation error!', 'Error Alert', {timeOut: 5000});
                        $('#addDtModal').modal({backdrop: 'static', keyboard: true});
                    }, 500);
                } else {
                    toastr.success('Data Berhasil di Simpan!', {timeOut: 5000});
                    DetailData();
                }
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });

    $(document).on('click', '.edt-dt-modal', function() {
        var id = $(this).data('id');
        $.ajax({
            type: 'GET',
            url : '{{ url('/salesorder_dt') }}/'+id+'/edit',
            data: '',
            success: function(data)
            {
                $('.modal-title-dt').text('Ubah Detail');
                $('#vPONO').val(data.PONO);
                $('#vSEQ').val(data.SEQ);
                $('#vTYPENO').val(data.TYPENO).selectpicker('refresh');
                $('#vQTY').val(data.QTY);
                $('#addDtModal').modal({backdrop: 'static', keyboard: true});
                $('.addDt').hide();
                $('.editDt').show();
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });

    $('.modal-footer').on('click', '.editDt', function() {            
        var formData = new FormData($('#frmDtSO')[0]);
        $.ajax({
            type: 'POST',
            url: '{{ url('/salesorderdt_upd') }}',         
            data: formData,
            contentType: false,
            processData: false,
            success: function(data) {

                if ((data.errors)) {
                    setTimeout(function () {
                        $('#addDtModal').modal('show');
                        toastr.error('Validation error!', 'Error Alert', {timeOut: 5000});
                        $('#addDtModal').modal({backdrop: 'static', keyboard: true});
                    }, 500);
                } else {
                    toastr.success('Data Berhasil di Simpan!', {timeOut: 5000});
                    DetailData();
                }
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });

    $(document).on('click', '.del-dt-modal', function() {
        $('#SEQ_DEL').val($(this).data('id'));
        $('.modal-title-del').text('Delete Detail');
        $('#deleteDtModal').modal('show');
    });

    $('.modal-footer').on('click', '.deleteDt', function() {
        $.ajax({
            type: 'DELETE',
            url: '{{ url('/salesorderdt') }}',
            data: {
                '_token': $('input[name=_token]').val(),
                'SEQ': $('#SEQ_DEL').val(),
            },
            success: function(data) {
                toastr.success('Data Berhasil di Hapus!', {timeOut: 5000});
                DetailData();
                $('.edt-modal').attr('disabled',true);
                $('.del-modal').attr('disabled',true);
                $('.add-dt-modal').attr('disabled',false);
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });
</script>
@endsection
