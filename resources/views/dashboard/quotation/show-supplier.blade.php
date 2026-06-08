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
        <div id="accordion" class="panel-group">
            <div class="card card-default">
                <div class="card-header" >
                    <h4 class="card-title" style="color: #32395c;"> Form Quotation Supplier {{ Auth::user()->full_name }} </a>
                    </h4>
                </div>
                <div class="card-body">
                    <table style="margin-bottom:10px;">
                        <tr>
                            <td style="width: 150px;">No Quotation</td>
                            <td> : {{$quotation->DOCNO}}</td>
                        </tr>
                        <tr>
                            <td>Date</td>
                            <td> : {{$quotation->TANGGAL->format('d/m/Y')}}</td>
                        </tr>
                    </table>

                    <table class="table table-hover table-responsive table-bordered mb-0 data-table2" style="width: 100%">
                        <thead>
                            <tr>
                                {{-- <th class="txtCenter">KD Supplier</th> --}}
                                <th class="text-center">NO</th>
                                {{-- <th class="txtCenter">Quotation No</th>
                                <th class="txtCenter">Tanggal Quotation</th> --}}
                                <th class="txtCenter" width="600">Item Name</th>
                                <th class="text-center" width="250">Price</th>
                                <th class="text-center" width="200" >Input Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($quotation->details as $index => $detail)
                            <tr>
                                {{-- <td>{{$detail->SUPPLIERCODE}}</td> --}}
                                <td class="text-center">{{$index + 1}}</td>
                                {{-- <td>{{$quotation->DOCNO}}</td>
                                <td>{{$quotation->TANGGAL->format('d/m/Y')}}</td> --}}
                                
                                <td>{{$detail->KETBRG}}</td>
                                <td>{{$detail->harga_supplier_format}}</td>
                                <td class="text-center">
                                    <button class="btn  btn-outline-primary btn-sm" data-toggle="modal" data-target="#modal_add_price" data-tooltip="tooltip" title="Entry Price" data-nomor="{{$detail->NOMOR}}" data-docno="{{$detail->DOCNO}}"><i class="fa fa-edit"></i></button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <table class="table table-hover table-responsive table-bordered mb-0 data-table">
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="modal_add_price" class="modal fade" role="dialog" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <form  action="{{ url('/qtawal') }}" method="POST"  id="frmUpdateHarga" class="modal-content">
            @csrf
            <div class="modal-header">
                <h4 class="modal-title"></h4>
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
            </div>
            <div class="modal-body">
                <div class="form-body" role="form" autocomplete="off" >
                  
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="DOCNO">Quotation No</label>
                                <input type="text" class="form-control" id="txtDocno" readonly  placeholder="Quotation No"  onkeyup="this.value = this.value.toUpperCase();" readonly style="background-color: transparent;">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                              <label for="KETBRG">Item Name</label>
                              <input type="text" class="form-control" id="txtBarang" readonly  placeholder="Item Name"  onkeyup="this.value = this.value.toUpperCase();" readonly style="background-color: transparent;">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                              <label for="QTY">Qty</label>
                              <input type="number" class="form-control" id="txtQty" readonly placeholder="Qty"  onkeyup="this.value = this.value.toUpperCase();" readonly style="background-color: transparent;">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                              <label for="SATUAN">Unit</label>
                              <input type="text" class="form-control" id="txtSatuan" readonly  placeholder="Unit"  onkeyup="this.value = this.value.toUpperCase();" readonly style="background-color: transparent;">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                              <label for="HARGA">Price (Exclude VAT and after discount)</label>
                              <input type="number" class="form-control" id="txtHarga" name="harga" placeholder="Price"  onkeyup="this.value = this.value.toUpperCase();" ;">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                              <label for="KET">Description</label>
                              <textarea class="form-control" id="txtKeterangan" name="ket" placeholder="Description" style="resize: none;" rows="3" maxlength="60"></textarea>
                              {{-- <input type="text" class="form-control" id="txtKeterangan" name="KET" placeholder="KET"  onkeyup="this.value = this.value.toUpperCase();" ;"> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-sm download fsDefault" data-dismiss="modal">
                    <span class='glyphicon glyphicon-remove'></span> Close
                </button>
                <button type="submit" class="btn btn-primary btn-sm add fsDefault">
                    <span class='glyphicon glyphicon-check'></span> Save
                </button>
              
            </div>
        </form>
    </div>
</div>
@endsection

@section('footer')
<script>
    $(document).ready(function(){
        $('#modal_add_price').on('show.bs.modal', function(e){
            
            var nomor = $(e.relatedTarget).data('nomor');
            var docno = $(e.relatedTarget).data('docno');

            $('#frmUpdateHarga').attr('action', "{{route('qtawal')}}/"+docno+'/item/'+nomor);

            $.ajax({
                url: "{{route('qtawal')}}/"+docno+'/item/'+nomor,
                method: 'get',
            }).done(function(data){
                console.log(data);
                if(data.success){
                    console.log('success');
                    $('#txtDocno').val('{{$quotation->DOCNO}}');
                    $('#txtBarang').val(data.data.barang);
                    $('#txtQty').val(data.data.qty);
                    $('#txtSatuan').val(data.data.satuan);
                    $('#txtHarga').val(data.data.harga);
                    $('#txtKeterangan').val(data.data.keterangan);
                } else {
                }
               
            })

          
        });

        $('#modal_add_price').on('hide.bs.modal', function(){
            $('#txtDocno').val('');
            $('#txtBarang').val('');
            $('#txtQty').val('');
            $('#txtSatuan').val('');
            $('#txtHarga').val('');
            $('#txtKeterangan').val('');
        });

        $('#frmUpdateHarga').submit(function(e){
            e.preventDefault();
            
            $.ajax({
                url : $(this).attr('action'),
                method: 'post',
                data: $(this).serialize()+'&_token={{csrf_token()}}&_method=put',
            }).done(function(data){
                if (data.status == 'success') {
                    toastr.success('Data Berhasil di Simpan!', {timeOut: 5000});
                    $('#modal_add_price').modal('hide');
                    
                    location.href = '{{route("qtawal.detail", $quotation->DOCNO)}}';
                } else {
                   
                }

            }).fail(function(response){
               
                var info =  '';//response.responseJSON.message + '<br>';
                $.each(response.responseJSON.errors, function (index, item) {
                    info += item + '<br>';
                })
                Swal.fire(
                    'Gagal !',
                    info,
                    'warning'
                );
            });
        });

      
    });
</script>
@endsection