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
                            <li class="breadcrumb-item active" aria-current="page">Kanban</li>
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
                        <div class="pull-right" style="padding: 6px 6px 0px;"><h5><strong>DN Date :</strong></h5></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            @unless(!$listPlants)
            <div id="accordion" class="panel-group">
                @foreach($listPlants as $listPlant)
                    <div class="card card-default">
                        <div class="card-header" >
                            <h4 class="card-title"><a href="#items{{ $loop->index+1 }}" aria-expanded="true" data-toggle="collapse" class=""> {{ 'DELIVERY CARD - '. $listPlant->ShipTo }} </a>
                            </h4>
                        </div>
                        <div class="panel-collapse collapse show" id="items{{ $loop->index+1 }}">
                            <div class="card-body">                                
                            @foreach($listCycleHds as $listCycleHd)
                                @if($listPlant->ShipTo === $listCycleHd->ShipTo)
                                <div class="page-content">
                                    <div class="inner-box category-content">
                                        <h2 class="title-2 uppercase">
                                            <strong> <i class="icon-briefcase"></i> {{ $listCycleHd->DNNumber }} </strong>
                                        </h2>
                                        <div class="panel panel-default" style="border-color: #ddd;">                        
                                            <div class="panel-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group row" style="margin-bottom: 8px;">
                                                            <label for="OrderIssue" class="col-sm-4 col-form-label col-form-label-sm">Order Issue</label>
                                                            <div class="col-md-8">
                                                                <input type="text" class="form-control form-control-sm noBg" style="height: 30px;" id="OrderIssue" value="{{ $listCycleHd->OrderIssue }}" readonly>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group row" style="margin-bottom: 8px;">
                                                            <label for="ShipTo" class="col-sm-4 col-form-label col-form-label-sm">Supplier Code</label>
                                                            <div class="col-md-8">
                                                                <input type="text" class="form-control form-control-sm noBg" style="height: 30px;" id="ShipTo" value="{{ $listCycleHd->SupplierCode }}" readonly>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group row" style="margin-bottom: 8px;">
                                                            <label for="OrderIssue" class="col-sm-4 col-form-label col-form-label-sm">Ship to</label>
                                                            <div class="col-md-8">
                                                                <input type="text" class="form-control form-control-sm noBg" style="height: 30px;" id="OrderIssue" value="{{ $listCycleHd->ShipTo }}" readonly>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group row" style="margin-bottom: 8px;">
                                                            <label for="ShipTo" class="col-sm-4 col-form-label col-form-label-sm">Supplier Name</label>
                                                            <div class="col-md-8">
                                                                <input type="text" class="form-control form-control-sm noBg" style="height: 30px;" id="ShipTo" value="{{ $listCycleHd->SupplierName }}" readonly>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group row" style="margin-bottom: 8px;">
                                                            <label for="OrderIssue" class="col-sm-4 col-form-label col-form-label-sm">Due Date</label>
                                                            <div class="col-md-8">
                                                                <input type="text" class="form-control form-control-sm noBg" style="height: 30px;" id="OrderIssue" value="{{ $listCycleHd->DueDateDO }}" readonly>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group row" style="margin-bottom: 8px;">
                                                            <label for="ShipTo" class="col-sm-4 col-form-label col-form-label-sm">Due Date Delivery</label>
                                                            <div class="col-md-8">
                                                                <input type="text" class="form-control form-control-sm noBg" style="height: 30px;" id="ShipTo" value="{{ $listCycleHd->DueDateDeli }}" readonly>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group row" style="margin-bottom: 0px;">
                                                            <label for="OrderIssue" class="col-sm-4 col-form-label col-form-label-sm">Delivery Order</label>
                                                            <div class="col-md-8">
                                                                <input type="text" class="form-control form-control-sm noBg" style="height: 30px;" id="OrderIssue" value="{{ $listCycleHd->OrderTime }}" readonly>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group row" style="margin-bottom: 0px;">
                                                            <label for="ShipTo" class="col-sm-4 col-form-label col-form-label-sm">Delivery Time</label>
                                                            <div class="col-md-8">
                                                                <input type="text" class="form-control form-control-sm noBg" style="height: 30px;" id="ShipTo" value="{{ $listCycleHd->DeliTime }}" readonly>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>  
                                            </div>
                                        </div>
                                        <div class="panel panel-default" style="border-color: #ddd;">                        
                                            <div class="panel-body">
                                                <table class="table table-bordered table-hover table-responsive mb-0" id="postTable">
                                                    <thead>
                                                        <tr>
                                                            <th class="txtCenter noPadding" rowspan="2" width="45">No</th>
                                                            <th class="txtCenter noPadding" rowspan="2" width="100">Type</th>
                                                            <th class="txtCenter noPadding" colspan="3">Dimensi Material</th>
                                                            <th class="txtCenter noPadding" rowspan="2" width="274">Grade Material</th>
                                                            <th class="txtCenter noPadding" colspan="1">Avg Pcs</th>
                                                            <th class="txtCenter noPadding" colspan="3">Quantity KANBAN</th>
                                                        </tr>
                                                        <tr>
                                                            <th class="txtCenter noPadding" width="80">L</th>
                                                            <th class="txtCenter noPadding" width="80">T</th>
                                                            <th class="txtCenter noPadding" width="80">P</th>
                                                            <th class="txtCenter noPadding" width="80">Bendel</th>
                                                            <th class="txtCenter noPadding" width="80">Bendel</th> 
                                                            <th class="txtCenter noPadding" width="80">Pcs</th>
                                                            <th class="txtCenter noPadding" width="90">Kg</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($listCycleDts as $listCycleDt)
                                                        @if($listCycleDt->NoDelivery === $listCycleHd->NoDelivery )
                                                        <tr class="item{{ $listCycleDt->NoDelivery }}">
                                                            <td style="padding:2px 8px;">{{ $listCycleDt->NoUrut }}</td>
                                                            <td style="padding:2px 8px;">{{ $listCycleDt->Billet }}</td>
                                                            <td style="padding:2px 8px; text-align: right;">{{ $listCycleDt->L }}</td>
                                                            <td style="padding:2px 8px; text-align: right;">{{ $listCycleDt->T }}</td>
                                                            <td style="padding:2px 8px; text-align: right;">{{ $listCycleDt->P }}</td>
                                                            <td style="padding:2px 8px;">{{ $listCycleDt->Grade }}</td>
                                                            <td style="padding:2px 8px; text-align: right;">{{ $listCycleDt->Bendel }}</td>
                                                            <td style="padding:2px 8px; text-align: right;">{{ $listCycleDt->KanbanBendel }}</td>
                                                            <td style="padding:2px 8px; text-align: right;">{{ $listCycleDt->XPcs }}</td>
                                                            <td style="padding:2px 8px; text-align: right;">{{ number_format($listCycleDt->XKgs, 2) }}</td>
                                                        </tr>
                                                        @endif
                                                    @endforeach    
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>                                
                                @endif
                            @endforeach 
                            </div>
                        </div>
                    </div>                  
                @endforeach
            </div>
            @else
            <div id="accordion" class="panel-group">
                <div class="card card-default">
                    <div class="card-header" >
                        <h4 class="card-title"><a href="#items" aria-expanded="true" data-toggle="collapse" class=""> DELIVERY CARD </a>
                        </h4>
                    </div>
                    <div class="panel-collapse collapse show" id="items" style="">
                        <div class="card-body">                             
                            <div class="page-content">
                                <div class="inner-box category-content">
                                    <h2 class="title-2 uppercase">
                                        <strong> <i class="icon-briefcase"></i> Cycle </strong>
                                    </h2>
                                    <div class="panel panel-default" style="border-color: #ddd;">                        
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group row" style="margin-bottom: 8px;">
                                                        <label for="OrderIssue" class="col-sm-4 col-form-label col-form-label-sm">Order Issue</label>
                                                        <div class="col-md-8">
                                                            <input type="text" class="form-control form-control-sm noBg" style="height: 30px;" id="OrderIssue" value="-" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group row" style="margin-bottom: 8px;">
                                                        <label for="ShipTo" class="col-sm-4 col-form-label col-form-label-sm">Supplier Code</label>
                                                        <div class="col-md-8">
                                                            <input type="text" class="form-control form-control-sm noBg" style="height: 30px;" id="ShipTo" value="-" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group row" style="margin-bottom: 8px;">
                                                        <label for="OrderIssue" class="col-sm-4 col-form-label col-form-label-sm">Ship to</label>
                                                        <div class="col-md-8">
                                                            <input type="text" class="form-control form-control-sm noBg" style="height: 30px;" id="OrderIssue" value="-" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group row" style="margin-bottom: 8px;">
                                                        <label for="ShipTo" class="col-sm-4 col-form-label col-form-label-sm">Supplier Name</label>
                                                        <div class="col-md-8">
                                                            <input type="text" class="form-control form-control-sm noBg" style="height: 30px;" id="ShipTo" value="-" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group row" style="margin-bottom: 8px;">
                                                        <label for="OrderIssue" class="col-sm-4 col-form-label col-form-label-sm">Due Date</label>
                                                        <div class="col-md-8">
                                                            <input type="text" class="form-control form-control-sm noBg" style="height: 30px;" id="OrderIssue" value="-" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group row" style="margin-bottom: 8px;">
                                                        <label for="ShipTo" class="col-sm-4 col-form-label col-form-label-sm">Due Date Delivery</label>
                                                        <div class="col-md-8">
                                                            <input type="text" class="form-control form-control-sm noBg" style="height: 30px;" id="ShipTo" value="-" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group row" style="margin-bottom: 0px;">
                                                        <label for="OrderIssue" class="col-sm-4 col-form-label col-form-label-sm">Delivery Order</label>
                                                        <div class="col-md-8">
                                                            <input type="text" class="form-control form-control-sm noBg" style="height: 30px;" id="OrderIssue" value="-" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group row" style="margin-bottom: 0px;">
                                                        <label for="ShipTo" class="col-sm-4 col-form-label col-form-label-sm">Delivery Time</label>
                                                        <div class="col-md-8">
                                                            <input type="text" class="form-control form-control-sm noBg" style="height: 30px;" id="ShipTo" value="-" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>  
                                        </div>
                                    </div>
                                    <div class="panel panel-default" style="border-color: #ddd;">                        
                                        <div class="panel-body">
                                            <table class="table table-bordered table-hover table-responsive mb-0" id="postTable">
                                                <thead>
                                                    <tr>
                                                        <th class="txtCenter noPadding" rowspan="2" width="45">No</th>
                                                        <th class="txtCenter noPadding" rowspan="2" width="100">Type</th>
                                                        <th class="txtCenter noPadding" colspan="3">Dimensi Material</th>
                                                        <th class="txtCenter noPadding" rowspan="2" width="275">Grade Material</th>
                                                        <th class="txtCenter noPadding" colspan="1">Avg Pcs</th>
                                                        <th class="txtCenter noPadding" colspan="3">Quantity KANBAN</th>
                                                    </tr>
                                                    <tr>
                                                        <th class="txtCenter noPadding" width="80">L</th>
                                                        <th class="txtCenter noPadding" width="80">T</th>
                                                        <th class="txtCenter noPadding" width="80">P</th>
                                                        <th class="txtCenter noPadding" width="80">Bendel</th>
                                                        <th class="txtCenter noPadding" width="80">Bendel</th> 
                                                        <th class="txtCenter noPadding" width="80">Pcs</th>
                                                        <th class="txtCenter noPadding" width="90">Kg</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr class="item">
                                                        <td style="padding:2px 8px;">-</td>
                                                        <td style="padding:2px 8px;">-</td>
                                                        <td style="padding:2px 8px; text-align: right;">0</td>
                                                        <td style="padding:2px 8px; text-align: right;">0</td>
                                                        <td style="padding:2px 8px; text-align: right;">0</td>
                                                        <td style="padding:2px 8px;">-</td>
                                                        <td style="padding:2px 8px; text-align: right;">0</td>
                                                        <td style="padding:2px 8px; text-align: right;">0</td>
                                                        <td style="padding:2px 8px; text-align: right;">0</td>
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
        var strDate = sDate.substring(6, 10)+''+sDate.substring(3, 5)+''+sDate.substring(0, 2); 

        window.location.href="{{ route('kanban') }}"+"/"+strDate+"/date";
    });

    $('.input-daterange input').each(function() {
        $(this).datepicker({
            format: 'dd/mm/yyyy',
            autoclose: true,
            allowInputToggle: true 
        });
    });
</script>

<script>
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
</script>
@endsection
