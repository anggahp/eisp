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
                            <li class="breadcrumb-item active" aria-current="page">Purchase Order</li>
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
            @unless(!$listPOs)
            <div id="accordion" class="panel-group">
                <div class="card card-default">
                    <div class="card-header" >
                        <h4 class="card-title"><a href="#items" aria-expanded="true" data-toggle="collapse" class=""> PURCHASE ORDER </a>
                        </h4>
                    </div>
                    <div class="panel-collapse collapse show" id="items">
                        <div class="card-body">                                
                            <div class="panel panel-default" style="border-color: #ddd;">                        
                                <div class="panel-body">
                                    <table id="DataId" class="table table-hover table-responsive mb-0" id="postTable">
                                        <thead>
                                            <tr>
                                                @if (Auth::user()->user_type == 'admin')
                                                <th class="txtCenter">Supp</th>
                                                @endif
                                                <th class="txtCenter">PO</th>
                                                <th class="txtCenter">Tanggal</th>
                                                <th class="txtCenter">No</th>
                                                <th class="txtCenter">Kode Barang</th>
                                                <th class="txtCenter">Ket. Barang</th>
                                                <th class="txtCenter">Tgl. Datang</th>
                                                <th class="txtCenter">Satuan</th>
                                                <th class="txtCenter">Qty PO</th>
                                                <th class="txtCenter">Qty LPB</th>
                                                <th class="txtCenter">BO</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($listPOs as $listPO)
                                            <tr class="item{{ $loop->index+1 }}">
                                                @if (Auth::user()->user_type == 'admin')
                                                <td style="padding:2px 8px;">{{ $listPO->SUPPLIERCODE }}</td>
                                                @endif
                                                <td style="padding:2px 8px;">{{ $listPO->PONO }}</td>
                                                <td style="padding:2px 8px;">{{ $listPO->TANGGAL }}</td>
                                                <td style="padding:2px 8px; text-align: right;">{{ $listPO->SEQNO }}</td>
                                                <td style="padding:2px 8px;">{{ $listPO->KODEBRG }}</td>
                                                <td style="padding:2px 8px;">{{ $listPO->KETBRG }}</td>
                                                <td style="padding:2px 8px;">{{ $listPO->TGLDATANG }}</td>
                                                <td style="padding:2px 8px;">{{ $listPO->SATUAN }}</td>
                                                <td style="padding:2px 8px; text-align: right;">{{ number_format($listPO->QTYPO, 2) }}</td>
                                                <td style="padding:2px 8px; text-align: right;">{{ number_format($listPO->QTYLPB, 2) }}</td>
                                                <td style="padding:2px 8px; text-align: right;">{{ number_format($listPO->BO, 2) }}</td>
                                            </tr>
                                        @endforeach    
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>   
            </div>
            @else
            <div id="accordion" class="panel-group">
                <div class="card card-default">
                    <div class="card-header" >
                        <h4 class="card-title"><a href="#items" aria-expanded="true" data-toggle="collapse" class=""> PURCHASE ORDER </a>
                        </h4>
                    </div>
                    <div class="panel-collapse collapse show" id="items" style="">
                        <div class="card-body">                             
                            <div class="page-content">
                                <div class="inner-box category-content">
                                    <div class="panel panel-default" style="border-color: #ddd;">                        
                                        <div class="panel-body">
                                            <table id="example" class="table table-hover table-responsive mb-0" id="postTable">
                                                <thead>
                                                    <tr>
                                                        @if (Auth::user()->user_type == 'admin')
                                                        <th class="txtCenter">Supp</th>
                                                        @endif
                                                        <th class="txtCenter">PO</th>
                                                        <th class="txtCenter">Tanggal</th>
                                                        <th class="txtCenter">No</th>
                                                        <th class="txtCenter">Kode Barang</th>
                                                        <th class="txtCenter">Ket. Barang</th>
                                                        <th class="txtCenter">Tgl. Datang</th>
                                                        <th class="txtCenter">Satuan</th>
                                                        <th class="txtCenter">Qty PO</th>
                                                        <th class="txtCenter">Qty LPB</th>
                                                        <th class="txtCenter">BO</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr class="item">
                                                        @if (Auth::user()->user_type == 'admin')
                                                        <td style="padding:2px 8px;">-</td>
                                                        @endif
                                                        <td style="padding:2px 8px;">-</td>
                                                        <td style="padding:2px 8px;">-</td>
                                                        <td style="padding:2px 8px; text-align: right;">0</td>
                                                        <td style="padding:2px 8px;">-</td>
                                                        <td style="padding:2px 8px;">-</td>
                                                        <td style="padding:2px 8px;">-</td>
                                                        <td style="padding:2px 8px;">-</td>
                                                        <td style="padding:2px 8px; text-align: right;">0</td>
                                                        <td style="padding:2px 8px;">-</td>
                                                        <td style="padding:2px 8px; text-align: right;">0</td>
                                                    </tr>  
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>  
                        </div>
                    </div>
                </div>  
            </div>
            @endunless

            <div style="clear: both"></div>            
        </div>
    </div>

@endsection

@section('footer')
<script src="{{ asset('assets/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>

<script>
    var currentDate = new Date()
    var vTgl = '';
    
    $('#btnCari').on('click', function() {
        var sDate = $('#strDate').val();
        if (sDate == '') { sDate = currentDate.getFullYear();}
        var strDate = sDate.substring(3, 7)+''+sDate.substring(0, 2); 

        window.location.href="{{ route('po') }}"+"/"+strDate+"/date";
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
    var vtampDate = '{{ Request::segment(2) }}';
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
    $(document).ready(function() {
        $('#DataId').dataTable({
            "aLengthMenu": [[25, 50, 75, -1], [25, 50, 75, "All"]],
            "iDisplayLength": 25,
            "scrollY": "350px",
            "scrollX": true
        });
    });
</script>
@endsection
