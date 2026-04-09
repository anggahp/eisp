@extends('layouts.app_home')

@section('header')
<link rel="stylesheet" href="{{ asset('assets/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/bootstrap-select/bootstrap-select.min.css') }}">
@endsection

@section('content')
     
    <div class="main-container">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <nav aria-label="breadcrumb" role="navigation" class="pull-left">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="icon-home fa"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">Delivery Order</li>
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
                        <h4 class="card-title" style="color: #32395c;">DELIVERY ORDER ENTRY
                        </h4>
                    </div>
                    <div class="panel-collapse collapse show" id="items" style="">
                        <div class="card-body">                             
                            <div class="page-content">
                                <button type="button" class="add-modal btn btn-primary btn-sm mb-2 float-left fs-12" style="width: 70px"><i class="fa fa-plus"></i> Add</button>
                                <button type="button" class="edt-modal btn btn-warning btn-sm mb-2 ml-1 float-left fs-12" style="width: 70px" disabled><i class="fa fa-edit"></i> Edit</button>
                                <button type="button" class="del-modal btn btn-danger btn-sm mb-2 ml-1 float-left fs-12" style="width: 70px" disabled><i class="fa fa-trash"></i> Delete</button>
                                <button type="button" class="exportxls btn btn-outline-primary btn-sm mb-2 ml-1 float-left fs-12" style="width: 70px"><i class="fas fa-file-excel"></i> Export</button>
                                <button type="button" class="print btn btn-outline-danger btn-sm mb-2 ml-1 float-left fs-12" style="width: 70px" disabled><i class="fas fa-print"></i> Print</button>
                                <div class="float-right">
                                    <button class="src-modal btn btn-dark btn-sm mb-2 fs-12">
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
                                                        <label for="idono" class="col-3 col-sm-2 col-md-3 col-form-label col-form-label-sm ">DO No.</label>
                                                        <div class="col-9 col-sm-10 col-md-9">
                                                            <input type="text" class="form-control form-control-sm noBg" style="height: 30px;" name="idono" id="idono" readonly>
                                                        </div>                                                        
                                                    </div> 
                                                </div>
                                                <div class="col-md-6">                                                    
                                                    <div class="form-group row" style="margin-bottom: 8px;">
                                                        <label for="isupplier" class="col-3 col-sm-2 col-md-3 col-form-label col-form-label-sm ">Supplier</label>
                                                        <div class="col-9 col-sm-10 col-md-9">
                                                            <input type="text" class="form-control form-control-sm noBg" style="height: 30px;" name="isupplier" id="isupplier" readonly>
                                                        </div>                                                        
                                                    </div> 
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group row" style="margin-bottom: 8px;">
                                                        <label for="idodate" class="col-3 col-sm-2 col-md-3 col-form-label col-form-label-sm">DO Date</label>
                                                        <div class="col-9 col-sm-10 col-md-9">
                                                            <input type="text" class="form-control form-control-sm noBg" style="height: 30px;" name="idodate" id="idodate" readonly>
                                                        </div>
                                                    </div>                                                                                            
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group row" style="margin-bottom: 8px;">
                                                        <label for="ipono" class="col-3 col-sm-2 col-md-3 col-form-label col-form-label-sm ">PO No.</label>
                                                        <div class="col-9 col-sm-10 col-md-9">
                                                            <input type="text" class="form-control form-control-sm noBg" style="height: 30px;" name="ipono" id="ipono" readonly>
                                                        </div>
                                                    </div>         
                                                </div>
                                            </div>
                                        </form>  
                                    </div>
                                </div>
                                
                                <button class="add-dt-modal btn btn-primary btn-sm mb-2 float-left fs-12" disabled>
                                    <i class="fa fa-plus"></i> Add Detail
                                </button>
                                <div class="clearfix"></div>
                                <div class="panel panel-default" style="border-color: #ddd;">                        
                                    <div class="panel-body">
                                        <table class="table table-hover table-responsive table-bordered mb-0 data-table-dt">
                                            <thead>
                                                <tr>
                                                    <th class="txtCenter" width="30">No</th>
                                                    <th class="txtCenter" width="300">Item</th>
                                                    <th class="txtCenter" width="450">Item Name</th>
                                                    <th class="txtCenter" width="110">Qty</th>
                                                    <th class="txtCenter" width="50">Unit</th>
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
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"></h4>
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                </div>
                <div class="modal-body" style="padding-bottom: 0px;">
                    <form method="POST" id="frmDoHd" autocomplete="off">
                        @csrf
                        
                        <input type="hidden" id="supplier">
                        <div class="row"> 
                            <div class="col-md-12">
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="dono">DO No.</label>
                                        <input type="text" class="form-control" id="dono" name="dono" onkeyup="this.value = this.value.toUpperCase();" required readonly>
                                    </div>                          
                                    <div class="form-group col-md-12">
                                        <label for="dodate">DO Date</label>
                                        <input type="text" class="form-control" id="dodate" name="dodate" placeholder="dd/mm/yyyy" required readonly>
                                    </div> 
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="pono">PO No.</label>
                                        {{-- <input type="text" class="form-control" id="pono" name="pono" placeholder="" onkeyup="this.value = this.value.toUpperCase();" required> --}}
                                        <select  class="form-control form-control-sm selectpicker" data-show-subtext="true" data-live-search="true" data-size="10" id="pono" name="pono"></select>

                                        <span class="text-danger">
                                            <strong id="pono-error"></strong>
                                        </span>
                                    </div> 
                                </div>   
                            </div>                            
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-sm download fsDefault" data-dismiss="modal">
                        <span class='glyphicon glyphicon-remove'></span> Close
                    </button> 
                    <button type="button" class="btn btn-primary btn-sm add fsDefault">
                        <span class='glyphicon glyphicon-check'></span> Save
                    </button>
                    <button type="button" class="btn btn-primary btn-sm edit fsDefault">
                        <span class='glyphicon glyphicon-check'></span> Update
                    </button> 
                </div>
            </div>
        </div>
    </div>

    <div id="deleteModal" class="modal fade" tabindex="-1" role="dialog" style="display: none;" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title-del pb-0"></h4>
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                </div>
                <div class="modal-body">
                    <h3 class="text-center">Are you sure delete this data?</h3>
                    <input type="hidden" id="dono_del"> 
                    {{-- <br /> --}}
                    <div class="modal-footer">
                        <button type="button" class="btn btn-warning btn-sm fsDefault" data-dismiss="modal">
                            <span class='glyphicon glyphicon-remove'></span> Close
                        </button>
                        <button type="button" class="btn btn-danger btn-sm delete fsDefault" data-dismiss="modal">
                            <span id="" class='glyphicon glyphicon-trash'></span> Delete
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
                                <th class="txtCenter" width="80">DO No.</th>
                                <th class="txtCenter" width="80">DO Date</th>
                                <th class="txtCenter" width="405">PO No.</th>
                                <th class="txtCenter" width="405">Supplier Name</th>
                                <th class="txtCenter" width="30">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>  
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-sm download fsDefault" data-dismiss="modal">
                        <span class='glyphicon glyphicon-remove'></span> Close
                    </button> 
                </div>
            </div>
        </div>
    </div>

    <div id="addDtModal" class="modal fade" tabindex="-1" role="dialog" style="display: none;" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title-dt pb-0"></h4>
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                </div>
                <div class="modal-body" style="padding-bottom: 0px;">
                    <form method="POST" id="frmDoDt" autocomplete="off">
                        @csrf

                        <input type="hidden" id="vdono" name="dono"> 
                        <input type="hidden" id="vseqno" name="seqno"> 
                        <div class="row"> 
                            <div class="col-md-12">
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="vkodebrg">Item</label>
                                        <select  class="form-control form-control-sm selectpicker" data-show-subtext="true" data-live-search="true" data-size="10" id="vkodebrg" name="kodebrg"></select>
                                    
                                        <span class="text-danger">
                                            <strong id="vkodebrg-error"></strong>
                                        </span>
                                    </div>    
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="vqty">Qty</label>
                                        <input type="text" class="form-control" id="vqty" name="qty" onkeyup="this.value = this.value.toUpperCase();">
                                
                                        <span class="text-danger">
                                            <strong id="vqty-error"></strong>
                                        </span>
                                    </div> 
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="vunit">Unit</label>
                                        <select  class="form-control form-control-sm selectpicker" data-show-subtext="true" data-live-search="true" data-size="5" id="vunit" name="unit"></select>
                                    
                                        <span class="text-danger">
                                            <strong id="vunit-error"></strong>
                                        </span>
                                    </div>    
                                </div>                                    
                            </div>                            
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-sm fsDefault" data-dismiss="modal">
                        <span class='glyphicon glyphicon-remove'></span> Close
                    </button> 
                    <button type="button" class="btn btn-primary btn-sm addDt fsDefault">
                        <span class='glyphicon glyphicon-check'></span> Save
                    </button> 
                    <button type="button" class="btn btn-primary btn-sm editDt fsDefault">
                        <span class='glyphicon glyphicon-check'></span> Update
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
                    <h3 class="text-center">Are you sure delete this data?</h3>
                    <input type="hidden" id="SEQ_DEL"> 
                    {{-- <br /> --}}
                    <div class="modal-footer">
                        <button type="button" class="btn btn-warning btn-sm fsDefault" data-dismiss="modal">
                            <span class='glyphicon glyphicon-remove'></span> Close
                        </button>
                        <button type="button" class="btn btn-danger btn-sm deleteDt fsDefault" data-dismiss="modal">
                            <span id="" class='glyphicon glyphicon-trash'></span> Delete
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('footer')
<script src="{{ asset('assets/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('assets/bootstrap-select/bootstrap-select.min.js') }}"></script>

<script>
    // var vtampDate = '{{ Request::segment(2) }}';
    // var vDate = new Date();
    // var dd = String(vDate.getDate()).padStart(2, '0');
    // var mm = String(vDate.getMonth() + 1).padStart(2, '0'); //January is 0!
    // var yyyy = vDate.getFullYear();

    // vDate = dd + '/' + mm + '/' + yyyy;

    // if (vtampDate != '') {
    //     vDate = vtampDate.substring(6, 8)+'/'+vtampDate.substring(4, 6)+'/'+vtampDate.substring(0, 4);
    // } 

    // $("#strDate").datepicker("update", vDate);

    // $('#btnCari').on('click', function() {
    //     var sDate = $('#strDate').val();
    //     if (sDate == '') { sDate = currentDate.getFullYear();}
    //     var strDate = sDate.substring(6, 10)+''+sDate.substring(3, 5)+''+sDate.substring(0, 2); 

    //     window.location.href="{{ route('salesorder') }}"+"/"+strDate+"/date";
    // });

    // $('.input-daterange input').each(function() {
    //     $(this).datepicker({
    //         format: 'dd/mm/yyyy',
    //         autoclose: true,
    //         allowInputToggle: true 
    //     });
    // });

    var currentDate = new Date()
    var vTgl = '';
    var table = '';
    var tableDt = '';
    var pono = '';
    var myWindow='';

    $(".card .card-header").css({"background-color": "rgb(0 43 255 / 19%)", "border": "1px solid #002bff17"});

    $('.datepicker').datepicker({
        format: "dd/mm/yyyy",
        autoclose: true,
        allowInputToggle: true
    });

    function rselectpicker(vPono) { 
        if (pono!=vPono) {        
            $.ajax({
                type:'GET',
                url: '{{url('/item-list')}}/'+vPono,
                data:'',
                success:function(html){
                    $('#vkodebrg').html(html).selectpicker('refresh');
                    console.log(pono);
                }
            });

            $.ajax({
                type:'GET',
                url: '{{url('/unit-list')}}/'+vPono,
                data:'',
                success:function(html){
                    $('#vunit').html(html).selectpicker('refresh');
                    console.log(pono);
                }
            });
            pono=vPono;
        }
    }

    function rselectpickerhd() {               
        $.ajax({
            type:'GET',
            url: '{{url('/po-list')}}',
            data:'',
            success:function(html){
                $('#pono').html(html).selectpicker('refresh');
            }
        });
    }

    $('#vqty').keypress(function(evt){
        return (/^[0-9]*\.?[0-9]*$/).test($(this).val()+evt.key);
    });

    function DetailData() {          
        tableDt = $('.data-table-dt').DataTable({
            processing: true,
            serverSide: true,
            autoWidth: false,
            destroy: true,
            ajax: "{{ url('do_dt') }}"+"/"+$('#idono').val(),
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                {data: 'kodebrg', name: 'kodebrg'},
                {data: 'ketbrg', name: 'ketbrg'},
                {data: 'qty', name: 'qty', render: $.fn.dataTable.render.number(',', '.', 2, '') },
                {data: 'satuan', name: 'satuan'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ],
            aLengthMenu: [[25, 50, 75, -1], [25, 50, 75, "All"]],
            iDisplayLength: 25,
            rowCallback: function( row, data, index ) {
                $('td', row).css({'padding':'4px 8px'});
                $('td:eq(-1)', row).css({'text-align':'center'});
                $('td:eq(0)', row).css({'text-align':'right'});
                $('td:eq(1)', row).css({'text-align':'left'});
                $('td:eq(2)', row).css({'text-align':'left'});
                $('td:eq(3)', row).css({'text-align':'right'});
                $('td:eq(4)', row).css({'text-align':'center'});
            },
        });
    }

    function srcData() {          
        table = $('.data-table-src').DataTable({
            processing: true,
            serverSide: true,
            autoWidth: false,
            destroy: true,
            ajax: "{{ route('do_src') }}",
            columns: [
                {data: 'dono', name: 'dono'},
                {data: 'dodate', name: 'dodate'},
                {data: 'pono', name: 'pono'},
                {data: 'supplier', name: 'supplier'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ],
            aLengthMenu: [[25, 50, 75, -1], [25, 50, 75, "All"]],
            iDisplayLength: 25,
            rowCallback: function( row, data, index ) {
                $('td', row).css({'padding':'4px 8px'});
                $('td:eq(-1)', row).css({'text-align':'center'});
            },
        });
    }

    function clearData() {
        DetailData();
        $('#idono').val('');
        $('#isupplier').val('');
        $('#idodate').val('');
        $('#ipono').val('');
    }

    $(document).on('click', '.print', function() {
        vdono = $('#idono').val();
        uri = '{{url('/printdo')}}/'+vdono;
        if (vdono != '') {
            try {
                myWindow = window.open(uri, "_blank", "width=500, height=500");
                myWindow.opener.focus();
            } catch (e) { 
                //  
            } finally {
                // myWindow.onfocus=function () { setTimeout(function () { myWindow.close(); }, 4500); }            
            }
        }
    });

    $(document).on('click', '.exportxls', function() {
        vdono = $('#idono').val();
        uri = '{{url('/exportdo')}}/'+vdono;
        if (vdono != '') {
            try {
                myWindow = window.open(uri);
                myWindow.opener.focus();
            } catch (e) { 
                //  
            } finally {
                myWindow.onfocus=function () { setTimeout(function () { myWindow.close(); }, 4500); }            
            }
        }
    });

    $(document).on('click', '.add-modal', function() {
        $('#pono-error').html("");

        $('.modal-title').text('Add Delivery Order');
        $('#dodate').datepicker('update',new Date());
        $('#addModal').modal({backdrop: 'static', keyboard: true});
        $.ajax({
            type: 'GET',
            url: '{{ url('/dono') }}',         
            data: '',
            success: function(data) {
                $('#dono').val(data[0].donum);
                $('#supplier').val(data[0].supplier);
                rselectpickerhd();
                $('#pono').val('').selectpicker('refresh');  
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
        $('#pono-error').html("");
        var registerForm = $("#frmDoHd");
        var formData = registerForm.serialize();        
        $.ajax({
           url: '{{ url('/do') }}',         
            type: 'POST',
            data: formData,
            success: function(data) {
                if(data.errors) {
                    if(data.errors.pono){
                        $( '#pono-error' ).html( data.errors.pono[0] );
                    }
                } 
                if(data.success) {
                    $('#addModal').modal('hide');
                    toastr.success('Data saved successfully!', {timeOut: 3000});
                    $('#idono').val($('#dono').val());
                    $('#isupplier').val($('#supplier').val());
                    $('#idodate').val($('#dodate').val());
                    $('#ipono').val($('#pono').val());
                    rselectpicker($('#ipono').val());
                    $('.edt-modal').attr('disabled',false);
                    $('.del-modal').attr('disabled',false);
                    $('.add-dt-modal').attr('disabled',false);
                    $('.print').attr('disabled',false);
                    DetailData();
                }
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });

    $(document).on('click', '.edt-modal', function() {
        var id = $('#idono').val();
        rselectpickerhd();
        $.ajax({
            type: 'GET',
            url : '{{ url('/do') }}/'+id+'/edit',
            data: '',
            success: function(data)
            {
                $('.modal-title').text('Change Data');
                $('#dono').val(data.dono);
                $('#dodate').datepicker('update',new Date(data.dodate));                
                $('#pono').val(data.pono).selectpicker('refresh');
                $('#supplier').val(data.supplier);
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
        $('#pono-error').html("");
        var registerForm = $("#frmDoHd");
        var formData = registerForm.serialize();    
        $.ajax({
            url: '{{ url('/do_upd') }}',         
            type: 'POST',
            data: formData,
            success: function(data) {                
                // console.log(data);
                if(data.errors) {
                    if(data.errors.pono){
                        $( '#pono-error' ).html( data.errors.pono[0] );
                    }                 
                }
                if(data.success) { 
                    $('#addModal').modal('hide');
                    toastr.success('Data updated successfully!', {timeOut: 3000});
                    $('#idono').val($('#dono').val());
                    $('#idodate').val($('#dodate').val());
                    $('#ipono').val($('#pono').val());
                    $('#isupplier').val($('#supplier').val());
                    rselectpicker($('#ipono').val());
                    $('.edt-modal').attr('disabled',false);
                    $('.del-modal').attr('disabled',false);
                    $('.add-dt-modal').attr('disabled',false);
                    $('.print').attr('disabled',false);
                }
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });

    $(document).on('click', '.del-modal', function() {
        $('#dono_del').val($('#idono').val());
        $('.modal-title-del').text('Delete Data');
        $('#deleteModal').modal('show');
    });
    
    $('.modal-footer').on('click', '.delete', function() {
        $.ajax({
            type: 'DELETE',
            url: '{{ url('/do') }}',
            data: {
                '_token': $('input[name=_token]').val(),
                'dono': $('#dono_del').val(),
            },
            success: function(data) {
                toastr.success('Data deleted successfully!', {timeOut: 3000});
                clearData();
                $('.edt-modal').attr('disabled',true);
                $('.del-modal').attr('disabled',true);
                $('.add-dt-modal').attr('disabled',false);
                $('.print').attr('disabled',false);
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });

    $(document).on('click', '.src-modal', function() {
        $('.modal-title-src').text('Delivery Order List');
        $('#srcModal').modal({backdrop: 'static', keyboard: true});
        srcData();
    });

    $(document).on('click', '.choose-modal', function() {
        var id = $(this).data('id');
        $.ajax({
            type: 'GET',
            url : '{{ url('/do') }}/'+id+'/choose',
            data: '',
            success: function(data)
            {
                // $('#idodate').datepicker('update',new Date(data.dodate));
                $('#idono').val(data.dono);
                $('#idodate').val(data.dodate);
                $('#ipono').val(data.pono);
                $('#isupplier').val(data.supplier);
                rselectpicker($('#ipono').val());
                $('#srcModal').modal('hide');
                $('.edt-modal').attr('disabled',false);
                $('.del-modal').attr('disabled',false);
                $('.add-dt-modal').attr('disabled',false);
                $('.print').attr('disabled',false);
                DetailData();
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });

    $(document).on('click', '.add-dt-modal', function() {
        $('.modal-title-dt').text('Add Item');
        $('#vdono').val($('#idono').val());
        $('#vkodebrg').val('').selectpicker('refresh');
        $('#vunit').val('').selectpicker('refresh');
        $('#vqty').val('');
        $('#addDtModal').modal({backdrop: 'static', keyboard: true});
        $('.addDt').show();
        $('.editDt').hide();
    });

    $('.modal-footer').on('click', '.addDt', function() {            
        $('#vkodebrg-error').html("");
        $('#vqty-error').html("");
        $('#vunit-error').html("");
        var registerForm = $("#frmDoDt");
        var formData = registerForm.serialize(); 
        $.ajax({
            url: '{{ url('/do_dt') }}',         
            type: 'POST',
            data: formData,
            success: function(data) {
                if(data.errors) {
                    if(data.errors.kodebrg){
                        $( '#vkodebrg-error' ).html( data.errors.kodebrg[0] );
                    }       
                    if(data.errors.qty){
                        $( '#vqty-error' ).html( data.errors.qty[0] );
                    } 
                    if(data.errors.unit){
                        $( '#vunit-error' ).html( data.errors.unit[0] );
                    } 
                }
                if(data.success) { 
                    $('#addDtModal').modal('hide');
                    toastr.success('Data saved successfully!!', {timeOut: 3000});
                    DetailData();
                }
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });

    $(document).on('click', '.edt-dt-modal', function() {
        $('#vkodebrg-error').html("");
        $('#vqty-error').html("");
        $('#vunit-error').html("");
        var id = $(this).data('id');
        $.ajax({
            type: 'GET',
            url : '{{ url('/do_dt') }}/'+id+'/edit',
            data: '',
            success: function(data)
            {
                $('.modal-title-dt').text('Change Item');
                $('#vdono').val(data.dono);
                $('#vseqno').val(data.seqno);
                $('#vkodebrg').val(data.kodebrg).selectpicker('refresh');
                $('#vunit').val(data.satuan).selectpicker('refresh');
                $('#vqty').val(parseFloat(data.qty));
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
        $('#vkodebrg-error').html("");
        $('#vqty-error').html("");
        $('#vunit-error').html("");         
        var registerForm = $("#frmDoDt");
        var formData = registerForm.serialize();
        $.ajax({
            type: 'POST',
            url: '{{ url('/do_dt_upd') }}',         
            data: formData,
            success: function(data) {
                if(data.errors) {
                    if(data.errors.kodebrg){
                        $( '#vkodebrg-error' ).html( data.errors.kodebrg[0] );
                    }       
                    if(data.errors.qty){
                        $( '#vqty-error' ).html( data.errors.qty[0] );
                    } 
                    if(data.errors.unit){
                        $( '#vunit-error' ).html( data.errors.unit[0] );
                    } 
                }
                if(data.success) { 
                    $('#addDtModal').modal('hide');
                    toastr.success('Data updated successfully!!', {timeOut: 3000});
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
        $('.modal-title-del').text('Delete Item');
        $('#deleteDtModal').modal('show');
    });

    $('.modal-footer').on('click', '.deleteDt', function() {
        $.ajax({
            type: 'DELETE',
            url: '{{ url('/do_dt') }}',
            data: {
                '_token': $('input[name=_token]').val(),
                'seqno': $('#SEQ_DEL').val(),
            },
            success: function(data) {
                toastr.success('Data deleted successfully!', {timeOut: 3000});
                DetailData();
                $('.edt-modal').attr('disabled',true);
                $('.del-modal').attr('disabled',true);
                $('.add-dt-modal').attr('disabled',false);
                $('.print').attr('disabled',false);
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });
</script>
@endsection
