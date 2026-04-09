@extends('layouts.app_print')

@section('content')
    
    <div class="mgb3">
        <div class="pd5">
            <img alt="img" src="assets/images/logo/isp.png" height=22 width=22 align="left">
        </div>
        <div style="margin-left: 10px;">
            <div class="bold fo14 pdt6">
                PT. INDOSPRING, Tbk.
            </div> 
            <div class="bold fo8">
                Member of Indoprima Group
            </div>
        </div>
    </div> 
    <hr>
    <div>
        {{-- <img src="data:image/png;base64, {{ base64_encode(QrCode::size(100)->generate('some random value')) }} "> --}}
        <img src="data:image/png;base64, {!! $qrcode !!}">
    </div>

    <script type="text/javascript">
        try {
            this.print();
            // this.close();
        } catch (e) { 
            window.onload = window.print; 
        } 
    </script>

@endsection