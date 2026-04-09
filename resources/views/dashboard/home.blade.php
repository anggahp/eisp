@extends('layouts.app_home')

@section('header')
@endsection

@section('content')
     
    <div class="main-container">
        <div class="container">
            <div class="row">
                <div class="col-md-12">

                    <nav aria-label="breadcrumb" role="navigation" class="pull-left">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="icon-home fa"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">Home</li>
                        </ol>
                    </nav>

                </div>
            </div>
        </div>

        <div class="container">

            <div class="col-lg-12 content-box ">
                <div class="row row-featured row-featured-category row-featured-company">
                    <div class="col-lg-12  box-title ">
                        <div class="inner">
                            <h2 style="color: #006bca; font-weight: bold;">
                                E-KANBAN <span>ONLINE SYSTEM</span> 
                            </h2>
                        </div>
                    </div>
                    @if (Auth::user()->user_grp != 'cust')
					<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 f-category">
                        <a href=" {{ route('qtawal') }} "><img alt="img" class="img-fluid" src="assets/images/menu/PriceQuotation.png">
                            <h6>PRICE QUOTATION</h6>
                        </a>
                    </div>
					
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 f-category">
                        <a href="{{ route('po') }}"><img alt="img" class="img-fluid" src="assets/images/menu/PO.png">
                            <h6>PURCHASE ORDER (PO)</h6>
                        </a>
                    </div>
					
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 f-category">
                        <a href="{{ route('pover') }}"><img alt="img" class="img-fluid" src="assets/images/menu/POVerifikasi.png">
                            <h6>PO CONFIRMATION</h6>
                        </a>
                    </div>
                    {{-- <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 f-category">
                        <a href="{{ route('kanban') }}"><img alt="img" class="img-fluid" src="assets/images/menu/Kanban.png">
                            <h6>KANBAN</h6>
                        </a>
                    </div> --}}
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 f-category">
                        <a href="{{ route('kanbanexcel') }}"><img alt="img" class="img-fluid" src="assets/images/menu/KanbanExcel.png">
                            <h6>KANBAN EXCEL</h6>
                        </a>
                    </div>
                    {{-- <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 f-category">
                        <a href="{{ route('mdn') }}"><img alt="img" class="img-fluid" src="assets/images/menu/Kanban.png">
                            <h6>MONITORING DN</h6>
                        </a>
                    </div> --}}
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 f-category">
                        <a href="{{ route('deliverysch') }}"><img alt="img" class="img-fluid" src="assets/images/menu/MDN.png">
                            <h6>DELIVERY SCHEDULE</h6>
                        </a>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 f-category">
                        <a href="{{ route('do') }}"><img alt="img" class="img-fluid" src="assets/images/menu/SJL.png">
                            <h6>DELIVERY ORDER</h6>
                        </a>
                    </div>
                    @endif
                    @if (Auth::user()->user_grp != 'supp')
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 f-category">
                        <a href="{{ route('salesorder') }}"><img alt="img" class="img-fluid" src="assets/images/menu/CheckList.png">
                            <h6>SALES ORDER</h6>
                        </a>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 f-category">
                        <a href="{{ route('solist') }}"><img alt="img" class="img-fluid" src="assets/images/menu/SO.png">
                            <h6>SO LIST</h6>
                        </a>
                    </div>
                    @endif
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 f-category">
                        <a href="{{ route('users') }}"><img alt="img" class="img-fluid" src="assets/images/menu/UserMng.png"> <h6>USER MANAGEMENT</h6>
                        </a>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 f-category">
                        <a href="{{ route('logout') }}"><img alt="img" class="img-fluid" src="assets/images/menu/Logout.png"> <h6>LOGOUT</h6>
                        </a>
                    </div>

                </div>
            </div>

            <div style="clear: both"></div>
            
        </div>
    </div>

@endsection

@section('footer')
@endsection
