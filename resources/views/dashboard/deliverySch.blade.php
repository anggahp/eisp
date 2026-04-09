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
                            <li class="breadcrumb-item active" aria-current="page">Delivery Schedule</li>
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
                        <div class="pull-right" style="padding: 6px 6px 0px;"><h5><strong>Period :</strong></h5></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div id="accordion" class="panel-group">
                <div class="card card-default">
                    <div class="card-header" >
                        <h4 class="card-title" style="color: #32395c;"> LIST DELIVEY SCHEDULE </a>
                        </h4>
                    </div>
                    <div class="card-body">                                
                        <div class="panel panel-default" style="border-color: #ddd;">                        
                            <div id="listItems" class="panel-body">
                                <a href="#" class="add-modal btn btn-primary btn-sm mb-2 fsDefault"><li><i class="fa fa-plus"></i> Add Data</li></a>
                                <table class="table table-hover table-responsive table-bordered mb-0 data-table">
                                    <thead>
                                        <tr>
                                            <th class="txtCenter" width="20">No</th>
                                            <th class="txtCenter" width="60">Delivery Date</th>
                                            <th class="txtCenter" width="60">EMKL</th>
                                            <th class="txtCenter" width="60">Destination</th>
                                            <th class="txtCenter" width="60">Invoice</th>
                                            <th class="txtCenter" width="60">Container</th>
                                            <th class="txtCenter" width="60">Seal</th>
                                            <th class="txtCenter" width="60">Tale</th>
                                            <th class="txtCenter" width="60">Nopol</th>
                                            <th class="txtCenter" width="60">Driver</th>
                                            <th class="txtCenter" width="60">Plant</th>
                                            <th class="txtCenter" width="60">Desc</th>
                                            <th class="txtCenter" width="140">#</th>
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
                    <form action="{{ url('/deliverysch') }}" method="POST" class="form-body" role="form" autocomplete="off" id="frmDelivery">
                        @csrf
                        <input type="hidden" id="DELIVERYID" name="DELIVERYID"> 
                        <input type="hidden" id="SUPPLIERCODE" name="SUPPLIERCODE">
                        <div class="row">                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="DELIVERYDATE">Delivery Date</label>
                                    <input type="text" class="form-control datepicker" id="DELIVERYDATE" name="DELIVERYDATE" placeholder="" readonly required style="background-color: transparent;">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="EMKL">EMKL</label>
                                    <input type="text" class="form-control" id="EMKL" name="EMKL" placeholder="" onkeyup="this.value = this.value.toUpperCase();" required>
                                </div>
                            </div>   
                        </div>
                        <div class="row"> 
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="DESTINATION">Destination</label>
                                    <input type="text" class="form-control" id="DESTINATION" name="DESTINATION" placeholder="" onkeyup="this.value = this.value.toUpperCase();" required>
                                </div>
                            </div> 
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="INVOICE">Invoice</label>
                                    <input type="text" class="form-control" id="INVOICE" name="INVOICE" placeholder="" onkeyup="this.value = this.value.toUpperCase();" required>
                                </div>
                            </div>                             
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="CONTAINER">Container</label>
                                    <input type="text" class="form-control" id="CONTAINER" name="CONTAINER" placeholder="" onkeyup="this.value = this.value.toUpperCase();" required>
                                </div>
                            </div> 
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="SEAL">Seal</label>
                                    <input type="text" class="form-control" id="SEAL" name="SEAL" placeholder="" onkeyup="this.value = this.value.toUpperCase();" required>
                                </div>
                            </div>  
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="TARE">Tare</label>
                                    <input type="text" class="form-control" id="TARE" name="TARE" placeholder="" onkeyup="this.value = this.value.toUpperCase();" required>
                                </div>
                            </div> 
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="NOPOL">No. Pol</label>
                                    <input type="text" class="form-control" id="NOPOL" name="NOPOL" placeholder="" onkeyup="this.value = this.value.toUpperCase();" required>
                                </div>
                            </div>  
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="DRIVER">Driver</label>
                                    <input type="text" class="form-control" id="DRIVER" name="DRIVER" placeholder="" onkeyup="this.value = this.value.toUpperCase();" required>
                                </div>
                            </div> 
                            <div class="col-md-6">
                                <div class="form-group">
                                    {{-- <input type="text" class="form-control" id="PLANT" name="PLANT" placeholder="Plant" onkeyup="this.value = this.value.toUpperCase();" required> --}}
                                    <label for="PLANT">Plant</label>
                                    <select  class="form-control" id="PLANT" name="PLANT" required>
                                        <option value="1">Plant 1</option>
                                        <option value="2">Plant 2</option>
                                        <option value="3">Plant 3</option>
                                    </select>
                                </div>
                            </div>  
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="DESCRIPTION">Description</label>
                                    <input type="text" class="form-control" id="DESCRIPTION" name="DESCRIPTION" placeholder="" onkeyup="this.value = this.value.toUpperCase();" required>
                                </div>
                            </div>  
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-sm download fsDefault" data-dismiss="modal">
                        <span class='glyphicon glyphicon-remove'></span> Close
                    </button> 
                    <button type="button" class="btn btn-primary btn-sm add fsDefault" data-dismiss="modal">
                        <span class='glyphicon glyphicon-check'></span> Save
                    </button>
                    <button type="button" class="btn btn-primary btn-sm edit fsDefault" data-dismiss="modal">
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
                    <h4 class="modal-title-del"></h4>
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                </div>
                <div class="modal-body">
                    <h3 class="text-center">Are you sure to delete this data?</h3>
                    <input type="hidden" id="DELIVERY_DEL"> 
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

@endsection

@section('footer')
<script src="{{ asset('assets/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>

<script>
    var table = '';
    var vUrl = '{{ route('deliverysch') }}';
    var vtampDate = '{{ Request::segment(2) }}';

    $('#TARE').keypress(function(evt){
        return (/^[0-9]*\.?[0-9]*$/).test($(this).val()+evt.key);
    });

    if (vtampDate != '') {
        vUrl = '{{ route('deliverysch') }}'+'/'+vtampDate+'/date';
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
            columnDefs: [
                // { visible: false, width: 40, targets: 1 },
                 { width: 20, targets: 0},
              ],
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                {data: 'DELIVERYDATE', name: 'DELIVERYDATE'},
                {data: 'EMKL', name: 'EMKL'},
                {data: 'DESTINATION', name: 'DESTINATION'},
                {data: 'INVOICE', name: 'INVOICE'},
                {data: 'CONTAINER', name: 'CONTAINER'},
                {data: 'SEAL', name: 'SEAL'},
                {data: 'TARE', name: 'TARE'},
                {data: 'NOPOL', name: 'NOPOL'},
                {data: 'DRIVER', name: 'DRIVER'},
                {data: 'PLANT', name: 'PLANT'},
                {data: 'DESCRIPTION', name: 'DESCRIPTION'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ],
            aLengthMenu: [[25, 50, 75, -1], [25, 50, 75, "All"]],
            iDisplayLength: 25,
            rowCallback: function( row, data, index ) {
                $('td', row).css({'padding':'4px 8px'});
                $('td:eq(0)', row).css({'text-align':'right'});
                $('td:eq(1)', row).css({'text-align':'center'});
                $('td:eq(2)', row).css({'text-align':'center'});
                $('td:eq(3)', row).css({'text-align':'center'});
                $('td:eq(4)', row).css({'text-align':'center'});
                $('td:eq(5)', row).css({'text-align':'center'});
                $('td:eq(6)', row).css({'text-align':'center'});
                $('td:eq(7)', row).css({'text-align':'center'});
                $('td:eq(8)', row).css({'text-align':'center'});
                $('td:eq(9)', row).css({'text-align':'center'});
                $('td:eq(10)', row).css({'text-align':'left'});
                $('td:eq(11)', row).css({'text-align':'center'});
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

        window.location.href="{{ route('deliverysch') }}"+"/"+strDate+"/date";
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
    $(document).on('click', '.add-modal', function() {
        $('.modal-title').text('Add Data Delivery');
        $('#DELIVERYID').val('');
        $('#SUPPLIERCODE').val('');
        $('#DELIVERYDATE').val('');
        $('#EMKL').val('');
        $('#DESTINATION').val('');
        $('#INVOICE').val('');
        $('#CONTAINER').val('');
        $('#SEAL').val('');
        $('#TARE').val('');
        $('#NOPOL').val('');
        $('#DRIVER').val('');
        $('#PLANT').val('');
        $('#DESCRIPTION').val('');
        $('#addModal').modal({backdrop: 'static', keyboard: true});
        $('.edit').hide();
        $('.add').show();
    });

    $('.datepicker').datepicker({
        format: "dd/mm/yyyy",
        autoclose: true,
        allowInputToggle: true
    });

    $('.modal-footer').on('click', '.add', function() {            
        var formData = new FormData($('#frmDelivery')[0]);
        $.ajax({
            type: 'POST',
            url: '{{ url('/deliverysch') }}',         
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
                    toastr.success('Data Successfully Saved!', {timeOut: 5000});
                    table.draw();
                }
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });

    $(document).on('click', '.edit-modal', function() {
        var id = $(this).data('id');
        $.ajax({
            type: 'GET',
            url : '{{ url('/deliverysch') }}/'+id+'/edit',
            data: '',
            success: function(data)
            {
                $('.modal-title').text('Edit Data Delivery');
                $('#DELIVERYID').val(data.DELIVERYID);
                $('#SUPPLIERCODE').val(data.SUPPLIERCODE);
                $('#DELIVERYDATE').datepicker('update',new Date(data.DELIVERYDATE));
                $('#EMKL').val(data.EMKL);
                $('#DESTINATION').val(data.DESTINATION);
                $('#INVOICE').val(data.INVOICE);
                $('#CONTAINER').val(data.CONTAINER);
                $('#SEAL').val(data.SEAL);
                $('#TARE').val(data.TARE);
                $('#NOPOL').val(data.NOPOL);
                $('#DRIVER').val(data.DRIVER);
                $('#PLANT').val(data.PLANT);
                $('#DESCRIPTION').val(data.DESCRIPTION);
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
        var formData = new FormData($('#frmDelivery')[0]);
        $.ajax({
            type: 'POST',
            url: '{{ url('/deliverysch_upd') }}',       
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
                    toastr.success('Data Successfully Updated!', {timeOut: 5000});
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
        $('#DELIVERY_DEL').val($(this).data('id'));
        $('.modal-title-del').text('Delete Kanban');
        $('#deleteModal').modal('show');
    });
    
    $('.modal-footer').on('click', '.delete', function() {
        $.ajax({
            type: 'DELETE',
            url: '{{ url('/deliverysch') }}',
            data: {
                '_token': $('input[name=_token]').val(),
                'DELIVERYID': $('#DELIVERY_DEL').val(),
            },
            success: function(data) {
                toastr.success('Data Successfully Deleted!', {timeOut: 5000});
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
