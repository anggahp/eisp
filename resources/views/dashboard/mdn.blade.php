@extends('layouts.app_home')

@section('header')
<link href="{{ asset('assets/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/dataTables/css/buttons.dataTables.min.css') }}" rel="stylesheet">
@endsection

@section('content')
     
    <div class="main-container">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <nav aria-label="breadcrumb" role="navigation" class="pull-left">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="icon-home fa"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">Monitoring DN</li>
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
                        <div class="pull-right" style="padding: 6px 6px 0px;"><h5><strong>DN PERIOD :</strong></h5></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            @unless(!$datas)
            <div id="accordion" class="panel-group">
                <div class="card card-default">
                    <div class="card-header" >
                        <h4 class="card-title"><a href="#items" aria-expanded="true" data-toggle="collapse" class=""> MONITORING DN </a>
                        </h4>
                    </div>
                    <div class="panel-collapse collapse show" id="items">
                        <div class="card-body">                                
                            <div class="panel panel-default" style="border-color: #ddd;">                        
                                <div class="panel-body">
                                    <table id="DataId" class="table table-hover table-responsive mb-0">
                                        <thead>
                                            <tr>
                                                @if (Auth::user()->user_type == 'admin')
                                                <th rowspan="2" class="txtCenter">Supp</th>
                                                @endif
                                                <th rowspan="2" class="txtCenter">PO</th>
                                                <th rowspan="2" class="txtCenter">PO Date</th>
                                                <th rowspan="2" class="txtCenter">Item</th>
                                                <th rowspan="2" class="txtCenter">Item Name</th>
                                                <th rowspan="2" class="txtCenter">BO</th>
                                                <th colspan="62" class="txtCenter">Day</th>
                                                <th rowspan="2"  class="txtCenter">DN Total</th>
                                                <th rowspan="2"  class="txtCenter">LPB Total</th>                                                
                                                <th rowspan="2"  class="txtCenter">Deviation</th>
                                            </tr>
                                            <tr>
                                                <th>DN 01</th>
                                                <th>LPB 01</th>
                                                <th>DN 02</th>
                                                <th>LPB 02</th>
                                                <th>DN 03</th>
                                                <th>LPB 03</th>
                                                <th>DN 04</th>
                                                <th>LPB 04</th>
                                                <th>DN 05</th>
                                                <th>LPB 05</th>
                                                <th>DN 06</th>
                                                <th>LPB 06</th>
                                                <th>DN 07</th>
                                                <th>LPB 07</th>
                                                <th>DN 08</th>
                                                <th>LPB 08</th>
                                                <th>DN 09</th>
                                                <th>LPB 09</th>
                                                <th>DN 10</th>
                                                <th>LPB 10</th>
                                                <th>DN 11</th>
                                                <th>LPB 11</th>
                                                <th>DN 12</th>
                                                <th>LPB 12</th>
                                                <th>DN 13</th>
                                                <th>LPB 13</th>
                                                <th>DN 14</th>
                                                <th>LPB 14</th>
                                                <th>DN 15</th>
                                                <th>LPB 15</th>
                                                <th>DN 16</th>
                                                <th>LPB 16</th>
                                                <th>DN 17</th>
                                                <th>LPB 17</th>
                                                <th>DN 18</th>
                                                <th>LPB 18</th>
                                                <th>DN 19</th>
                                                <th>LPB 19</th>
                                                <th>DN 20</th>
                                                <th>LPB 20</th>
                                                <th>DN 21</th>
                                                <th>LPB 21</th>
                                                <th>DN 22</th>
                                                <th>LPB 22</th>
                                                <th>DN 23</th>
                                                <th>LPB 23</th>
                                                <th>DN 24</th>
                                                <th>LPB 24</th>
                                                <th>DN 25</th>
                                                <th>LPB 25</th>
                                                <th>DN 26</th>
                                                <th>LPB 26</th>
                                                <th>DN 27</th>
                                                <th>LPB 27</th>
                                                <th>DN 28</th>
                                                <th>LPB 28</th>
                                                <th>DN 29</th>
                                                <th>LPB 29</th>
                                                <th>DN 30</th>
                                                <th>LPB 30</th>
                                                <th>DN 31</th>
                                                <th>LPB 31</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($datas as $listPO)
                                            <tr>
                                                @if (Auth::user()->user_type == 'admin')
                                                <td style="padding:2px 8px;">{{ $listPO->SUPPLIERCODE }}</td>
                                                @endif
                                                <td style="padding:2px 8px;">{{ $listPO->PONO }}</td>
                                                <td style="padding:2px 8px;">{{ $listPO->TANGGAL }}</td>
                                                <td style="padding:2px 8px;">{{ $listPO->KODEBRG }}</td>
                                                <td style="padding:2px 8px;">{{ $listPO->KETBRG }}</td>
                                                <td style="padding:2px 8px; text-align: right;">{{ number_format($listPO->BO, 2) }}</td>
                                                <td style="padding:2px 8px; text-align: right;">{{ number_format($listPO->DN01, 2) }}</td>
                                                <td style="padding:2px 8px; text-align: right;">{{ number_format($listPO->LP01, 2) }}</td>
                                                <td style="padding:2px 8px; text-align: right;">{{ number_format($listPO->DN02, 2) }}</td>
                                                <td style="padding:2px 8px; text-align: right;">{{ number_format($listPO->LP02, 2) }}</td>
                                                <td style="padding:2px 8px; text-align: right;">{{ number_format($listPO->DN03, 2) }}</td>
                                                <td style="padding:2px 8px; text-align: right;">{{ number_format($listPO->LP03, 2) }}</td>
                                                <td style="padding:2px 8px; text-align: right;">{{ number_format($listPO->DN04, 2) }}</td>
                                                <td style="padding:2px 8px; text-align: right;">{{ number_format($listPO->LP04, 2) }}</td>
                                                <td style="padding:2px 8px; text-align: right;">{{ number_format($listPO->DN05, 2) }}</td>
                                                <td style="padding:2px 8px; text-align: right;">{{ number_format($listPO->LP05, 2) }}</td>
                                                <td style="padding:2px 8px; text-align: right;">{{ number_format($listPO->DN06, 2) }}</td>
                                                <td style="padding:2px 8px; text-align: right;">{{ number_format($listPO->LP06, 2) }}</td>
                                                <td style="padding:2px 8px; text-align: right;">{{ number_format($listPO->DN07, 2) }}</td>
                                                <td style="padding:2px 8px; text-align: right;">{{ number_format($listPO->LP07, 2) }}</td>
                                                <td style="padding:2px 8px; text-align: right;">{{ number_format($listPO->DN08, 2) }}</td>
                                                <td style="padding:2px 8px; text-align: right;">{{ number_format($listPO->LP08, 2) }}</td>
                                                <td style="padding:2px 8px; text-align: right;">{{ number_format($listPO->DN09, 2) }}</td>
                                                <td style="padding:2px 8px; text-align: right;">{{ number_format($listPO->LP09, 2) }}</td>
                                                <td style="padding:2px 8px; text-align: right;">{{ number_format($listPO->DN10, 2) }}</td>
                                                <td style="padding:2px 8px; text-align: right;">{{ number_format($listPO->LP10, 2) }}</td>
                                                <td style="padding:2px 8px; text-align: right;">{{ number_format($listPO->DN11, 2) }}</td>
                                                <td style="padding:2px 8px; text-align: right;">{{ number_format($listPO->LP11, 2) }}</td>
                                                <td style="padding:2px 8px; text-align: right;">{{ number_format($listPO->DN12, 2) }}</td>
                                                <td style="padding:2px 8px; text-align: right;">{{ number_format($listPO->LP12, 2) }}</td>
                                                <td style="padding:2px 8px; text-align: right;">{{ number_format($listPO->DN13, 2) }}</td>
                                                <td style="padding:2px 8px; text-align: right;">{{ number_format($listPO->LP13, 2) }}</td>
                                                <td style="padding:2px 8px; text-align: right;">{{ number_format($listPO->DN14, 2) }}</td>
                                                <td style="padding:2px 8px; text-align: right;">{{ number_format($listPO->LP14, 2) }}</td>
                                                <td style="padding:2px 8px; text-align: right;">{{ number_format($listPO->DN15, 2) }}</td>
                                                <td style="padding:2px 8px; text-align: right;">{{ number_format($listPO->LP15, 2) }}</td>
                                                <td style="padding:2px 8px; text-align: right;">{{ number_format($listPO->DN16, 2) }}</td>
                                                <td style="padding:2px 8px; text-align: right;">{{ number_format($listPO->LP16, 2) }}</td>
                                                <td style="padding:2px 8px; text-align: right;">{{ number_format($listPO->DN17, 2) }}</td>
                                                <td style="padding:2px 8px; text-align: right;">{{ number_format($listPO->LP17, 2) }}</td>
                                                <td style="padding:2px 8px; text-align: right;">{{ number_format($listPO->DN18, 2) }}</td>
                                                <td style="padding:2px 8px; text-align: right;">{{ number_format($listPO->LP18, 2) }}</td>
                                                <td style="padding:2px 8px; text-align: right;">{{ number_format($listPO->DN19, 2) }}</td>
                                                <td style="padding:2px 8px; text-align: right;">{{ number_format($listPO->LP19, 2) }}</td>
                                                <td style="padding:2px 8px; text-align: right;">{{ number_format($listPO->DN20, 2) }}</td>
                                                <td style="padding:2px 8px; text-align: right;">{{ number_format($listPO->LP20, 2) }}</td>
                                                <td style="padding:2px 8px; text-align: right;">{{ number_format($listPO->DN21, 2) }}</td>
                                                <td style="padding:2px 8px; text-align: right;">{{ number_format($listPO->LP21, 2) }}</td>
                                                <td style="padding:2px 8px; text-align: right;">{{ number_format($listPO->DN22, 2) }}</td>
                                                <td style="padding:2px 8px; text-align: right;">{{ number_format($listPO->LP22, 2) }}</td>
                                                <td style="padding:2px 8px; text-align: right;">{{ number_format($listPO->DN23, 2) }}</td>
                                                <td style="padding:2px 8px; text-align: right;">{{ number_format($listPO->LP23, 2) }}</td>
                                                <td style="padding:2px 8px; text-align: right;">{{ number_format($listPO->DN24, 2) }}</td>
                                                <td style="padding:2px 8px; text-align: right;">{{ number_format($listPO->LP24, 2) }}</td>
                                                <td style="padding:2px 8px; text-align: right;">{{ number_format($listPO->DN25, 2) }}</td>
                                                <td style="padding:2px 8px; text-align: right;">{{ number_format($listPO->LP25, 2) }}</td>
                                                <td style="padding:2px 8px; text-align: right;">{{ number_format($listPO->DN26, 2) }}</td>
                                                <td style="padding:2px 8px; text-align: right;">{{ number_format($listPO->LP26, 2) }}</td>
                                                <td style="padding:2px 8px; text-align: right;">{{ number_format($listPO->DN27, 2) }}</td>
                                                <td style="padding:2px 8px; text-align: right;">{{ number_format($listPO->LP27, 2) }}</td>
                                                <td style="padding:2px 8px; text-align: right;">{{ number_format($listPO->DN28, 2) }}</td>
                                                <td style="padding:2px 8px; text-align: right;">{{ number_format($listPO->LP28, 2) }}</td>
                                                <td style="padding:2px 8px; text-align: right;">{{ number_format($listPO->DN29, 2) }}</td>
                                                <td style="padding:2px 8px; text-align: right;">{{ number_format($listPO->LP29, 2) }}</td>
                                                <td style="padding:2px 8px; text-align: right;">{{ number_format($listPO->DN30, 2) }}</td>
                                                <td style="padding:2px 8px; text-align: right;">{{ number_format($listPO->LP30, 2) }}</td>
                                                <td style="padding:2px 8px; text-align: right;">{{ number_format($listPO->DN31, 2) }}</td>
                                                <td style="padding:2px 8px; text-align: right;">{{ number_format($listPO->LP31, 2) }}</td>
                                                <td style="padding:2px 8px; text-align: right;">{{ number_format($listPO->TDN, 2) }}</td>
                                                <td style="padding:2px 8px; text-align: right;">{{ number_format($listPO->TLP, 2) }}</td>
                                                <td style="padding:2px 8px; text-align: right;">{{ number_format($listPO->DEVIASI, 2) }}</td>
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
                        <h4 class="card-title"><a href="#items" aria-expanded="true" data-toggle="collapse" class=""> MONITORING DN </a>
                        </h4>
                    </div>
                    <div class="panel-collapse collapse show" id="items" style="">
                        <div class="card-body">                             
                            <div class="page-content">
                                <div class="inner-box category-content">
                                    <div class="panel panel-default" style="border-color: #ddd;">                        
                                        <div class="panel-body">
                                            <table id="DataId" class="table table-hover table-responsive mb-0">
                                                <thead>
                                                    <tr>
                                                        @if (Auth::user()->user_type == 'admin')
                                                        <th rowspan="2" class="txtCenter">Supp</th>
                                                        @endif
                                                        <th rowspan="2" class="txtCenter">PO</th>
                                                        <th rowspan="2" class="txtCenter">PO Date</th>
                                                        <th rowspan="2" class="txtCenter">Item</th>
                                                        <th rowspan="2" class="txtCenter">Item Name</th>
                                                        <th rowspan="2" class="txtCenter">BO</th>
                                                        <th colspan="62" class="txtCenter">Day</th>
                                                        <th rowspan="2"  class="txtCenter">DN Total</th>
                                                        <th rowspan="2"  class="txtCenter">LPB Total</th>                                                
                                                        <th rowspan="2"  class="txtCenter">Deviation</th>
                                                    </tr>
                                                    <tr>
                                                        <th>DN</th>
                                                        <th>LPB</th>
                                                        <th>DN</th>
                                                        <th>LPB</th>
                                                        <th>DN</th>
                                                        <th>LPB</th>
                                                        <th>DN</th>
                                                        <th>LPB</th>
                                                        <th>DN</th>
                                                        <th>LPB</th>
                                                        <th>DN</th>
                                                        <th>LPB</th>
                                                        <th>DN</th>
                                                        <th>LPB</th>
                                                        <th>DN</th>
                                                        <th>LPB</th>
                                                        <th>DN</th>
                                                        <th>LPB</th>
                                                        <th>DN</th>
                                                        <th>LPB</th>
                                                        <th>DN</th>
                                                        <th>LPB</th>
                                                        <th>DN</th>
                                                        <th>LPB</th>
                                                        <th>DN</th>
                                                        <th>LPB</th>
                                                        <th>DN</th>
                                                        <th>LPB</th>
                                                        <th>DN</th>
                                                        <th>LPB</th>
                                                        <th>DN</th>
                                                        <th>LPB</th>
                                                        <th>DN</th>
                                                        <th>LPB</th>
                                                        <th>DN</th>
                                                        <th>LPB</th>
                                                        <th>DN</th>
                                                        <th>LPB</th>
                                                        <th>DN</th>
                                                        <th>LPB</th>
                                                        <th>DN</th>
                                                        <th>LPB</th>
                                                        <th>DN</th>
                                                        <th>LPB</th>
                                                        <th>DN</th>
                                                        <th>LPB</th>
                                                        <th>DN</th>
                                                        <th>LPB</th>
                                                        <th>DN</th>
                                                        <th>LPB</th>
                                                        <th>DN</th>
                                                        <th>LPB</th>
                                                        <th>DN</th>
                                                        <th>LPB</th>
                                                        <th>DN</th>
                                                        <th>LPB</th>
                                                        <th>DN</th>
                                                        <th>LPB</th>
                                                        <th>DN</th>
                                                        <th>LPB</th>
                                                        <th>DN</th>
                                                        <th>LPB</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr class="item">
                                                        @if (Auth::user()->user_type == 'admin')
                                                        <td style="padding:2px 8px;">-</td>
                                                        @endif
                                                        <td style="padding:2px 8px;">-</td>
                                                        <td style="padding:2px 8px;">-</td>
                                                        <td style="padding:2px 8px;">-</td>
                                                        <td style="padding:2px 8px;">-</td>
                                                        <td style="padding:2px 8px; text-align: right;">0</td>
                                                        <td style="padding:2px 8px; text-align: right;">0</td>
                                                        <td style="padding:2px 8px; text-align: right;">0</td>
                                                        <td style="padding:2px 8px; text-align: right;">0</td>
                                                        <td style="padding:2px 8px; text-align: right;">0</td>
                                                        <td style="padding:2px 8px; text-align: right;">0</td>
                                                        <td style="padding:2px 8px; text-align: right;">0</td>
                                                        <td style="padding:2px 8px; text-align: right;">0</td>
                                                        <td style="padding:2px 8px; text-align: right;">0</td>
                                                        <td style="padding:2px 8px; text-align: right;">0</td>
                                                        <td style="padding:2px 8px; text-align: right;">0</td>
                                                        <td style="padding:2px 8px; text-align: right;">0</td>
                                                        <td style="padding:2px 8px; text-align: right;">0</td>
                                                        <td style="padding:2px 8px; text-align: right;">0</td>
                                                        <td style="padding:2px 8px; text-align: right;">0</td>
                                                        <td style="padding:2px 8px; text-align: right;">0</td>
                                                        <td style="padding:2px 8px; text-align: right;">0</td>
                                                        <td style="padding:2px 8px; text-align: right;">0</td>
                                                        <td style="padding:2px 8px; text-align: right;">0</td>
                                                        <td style="padding:2px 8px; text-align: right;">0</td>
                                                        <td style="padding:2px 8px; text-align: right;">0</td>
                                                        <td style="padding:2px 8px; text-align: right;">0</td>
                                                        <td style="padding:2px 8px; text-align: right;">0</td>
                                                        <td style="padding:2px 8px; text-align: right;">0</td>
                                                        <td style="padding:2px 8px; text-align: right;">0</td>
                                                        <td style="padding:2px 8px; text-align: right;">0</td>
                                                        <td style="padding:2px 8px; text-align: right;">0</td>
                                                        <td style="padding:2px 8px; text-align: right;">0</td>
                                                        <td style="padding:2px 8px; text-align: right;">0</td>
                                                        <td style="padding:2px 8px; text-align: right;">0</td>
                                                        <td style="padding:2px 8px; text-align: right;">0</td>
                                                        <td style="padding:2px 8px; text-align: right;">0</td>
                                                        <td style="padding:2px 8px; text-align: right;">0</td>
                                                        <td style="padding:2px 8px; text-align: right;">0</td>
                                                        <td style="padding:2px 8px; text-align: right;">0</td>
                                                        <td style="padding:2px 8px; text-align: right;">0</td>
                                                        <td style="padding:2px 8px; text-align: right;">0</td>
                                                        <td style="padding:2px 8px; text-align: right;">0</td>
                                                        <td style="padding:2px 8px; text-align: right;">0</td>
                                                        <td style="padding:2px 8px; text-align: right;">0</td>
                                                        <td style="padding:2px 8px; text-align: right;">0</td>
                                                        <td style="padding:2px 8px; text-align: right;">0</td>
                                                        <td style="padding:2px 8px; text-align: right;">0</td>
                                                        <td style="padding:2px 8px; text-align: right;">0</td>
                                                        <td style="padding:2px 8px; text-align: right;">0</td>
                                                        <td style="padding:2px 8px; text-align: right;">0</td>
                                                        <td style="padding:2px 8px; text-align: right;">0</td>
                                                        <td style="padding:2px 8px; text-align: right;">0</td>
                                                        <td style="padding:2px 8px; text-align: right;">0</td>
                                                        <td style="padding:2px 8px; text-align: right;">0</td>
                                                        <td style="padding:2px 8px; text-align: right;">0</td>
                                                        <td style="padding:2px 8px; text-align: right;">0</td>
                                                        <td style="padding:2px 8px; text-align: right;">0</td>
                                                        <td style="padding:2px 8px; text-align: right;">0</td>
                                                        <td style="padding:2px 8px; text-align: right;">0</td>
                                                        <td style="padding:2px 8px; text-align: right;">0</td>
                                                        <td style="padding:2px 8px; text-align: right;">0</td>
                                                        <td style="padding:2px 8px; text-align: right;">0</td>
                                                        <td style="padding:2px 8px; text-align: right;">0</td>
                                                        <td style="padding:2px 8px; text-align: right;">0</td>
                                                        <td style="padding:2px 8px; text-align: right;">0</td>
                                                        <td style="padding:2px 8px; text-align: right;">0</td>
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
<script src="{{ asset('assets/dataTables/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('assets/dataTables/js/jszip.min.js') }}"></script>
{{-- <script src="{{ asset('assets/dataTables/js/pdfmake.min.js') }}"></script> --}}
<script src="{{ asset('assets/dataTables/js/vfs_fonts.js') }}"></script>
<script src="{{ asset('assets/dataTables/js/buttons.html5.min.js') }}"></script>

<script>
    var currentDate = new Date()
    var vTgl = '';
    
    $('#btnCari').on('click', function() {
        var sDate = $('#strDate').val();
        if (sDate == '') { sDate = currentDate.getFullYear();}
        var strDate = sDate.substring(3, 7)+''+sDate.substring(0, 2); 

        window.location.href="{{ route('mdn') }}"+"/"+strDate+"/date";
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
            "aLengthMenu": [[10, 25, 50, 75, -1], [10, 25, 50, 75, "All"]],
            "iDisplayLength": 10,
            "scrollY": "350px",
            "scrollX": true,
            dom: 'Bfrtip',
            buttons: [
                'excelHtml5'
            ]
        });
    });
</script>
@endsection
