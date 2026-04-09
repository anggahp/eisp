@extends('layouts.app_home')

@section('content')
<div class="main-container">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <nav aria-label="breadcrumb" role="navigation" class="pull-left">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="icon-home fa"></i></a></li>
                        <li class="breadcrumb-item"><a href="{{ route('qtawal') }}">List Quotation</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{$quotation->DOCNO}}</li>
                    </ol>
                </nav>
                <div class="pull-right ">
                    <a href="{{ route('qtawal') }}" class="btn btn-danger btn-sm fsDefault" style="margin-left: 12px;">
                        <i class="fas fa-angle-double-left"></i> Back
                    </a>
                </div>
                
            </div>
        </div>
    </div>
    <div class="container">

        @if($quotation->supplier1)
        <div id="accordion" class="panel-group">
            <div class="card card-default">
                <div class="card-header" >
                    <h4 class="card-title" style="color: #32395c;"> Detail Quotation {{$quotation->DOCNO}} </a>
                    </h4>
                </div>
                <div class="card-body">
                    <table class="table table-hover table-responsive table-bordered mb-0 data-table2" style="width: 100%">
                        <thead>
                            <tr>
                                {{-- <th class="txtCenter">KD Supplier</th> --}}
                                <th  rowspan="2" class="txtCenter">Quotation No</th>
                                <th rowspan="2" class="txtCenter">Date</th>
                                <th rowspan="2" class="txtCenter" width="350">Item Name</th>
                                <th colspan="2"> Supplier 1 ({{$quotation->SUPPLIERCODE}})</th>
                                <th colspan="2"> Supplier 2 ({{$quotation->SUPPB}})</th>
                                <th colspan="2"> Supplier 3 ({{$quotation->SUPPC}})</th>
                                {{-- <th rowspan="2" class="txtCenter" width="350" >Harga</th> --}}

                            </tr>
                            <tr>
                                <th>Price</th>
                                <th>Description</th>
                                <th>Price</th>
                                <th>Description</th>
                                <th>Price</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($quotation->details as $detail)
                            <tr>
                                {{-- <td>{{$detail->SUPPLIERCODE}}</td> --}}
                                <td>{{$quotation->DOCNO}}</td>
                                <td>{{$quotation->TANGGAL->format('d/m/Y')}}</td>
                                <td>{{$detail->KETBRG}}</td>
                                <td>{{number_format($detail->HARGA, 2 ,',', '.')}}</td>
                                <td>{{$detail->KET}}</td>
                                <td>{{number_format($detail->HARGA2, 2 ,',', '.')}}</td>
                                <td>{{$detail->KET2}}</td>
                                <td>{{number_format($detail->HARGA3, 2 ,',', '.')}}</td>
                                <td>{{$detail->KET3}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @endif
      
    </div>
</div>
@endsection