<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use \App\Models\TRQuotationHD;
use \App\Models\TRQuotationDT;
use DataTables;

class QuotationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(Request $request)
    {
        $userid = '';
        if (Auth::user()->user_type != 'admin') {
            $userid = Auth::user()->name;
        }
        
        if(request()->ajax()){
            $dataquotation = TRQuotationHD::select()->with('details')->withCount('details');
            
            if(request()->has('date')){
              
                $startDate = \Carbon\Carbon::createFromFormat('Y-m-d', request('date').'-01');
                $finishDate = clone ($startDate);
                $finishDate = $finishDate->modify('+1 month');
               $dataquotation = $dataquotation->whereDate('TANGGAL', '>=', $startDate)->whereDate('TANGGAL', '<', $finishDate);
            }

            if(Auth::user()->user_grp == 'supp'){
                $dataquotation->supplier(Auth::user()->name);
            }

            // if (Auth::user()->user_type != 'admin') {
            //     $userid = Auth::user()->name;
            // }
            return DataTables::of(
                $dataquotation
            )->addColumn('jumlah_barang', function(TRQuotationHD $quotation){
                return $quotation->details_count;
            })->addColumn('tanggal_format', function(TRQuotationHD $quotation){
                return $quotation->TANGGAL->format('d/m/Y');
            })->addColumn('status_badge', function(TRQuotationHD $quotation){
                $jumlah_barang = $quotation->details_count;
                $counter = 0;
                foreach($quotation->details as $detail){
                    if($detail->harga_supplier != 0 && $detail->harga_supplier != null ){
                        $counter++;
                    }
                }
                if($counter == 0){
                    return "<span class='badge badge-danger'>HARGA BELUM DIISI</span>";
                } else if($counter > 0 && $counter < $jumlah_barang) {
                    return "<span class='badge badge-warning'>SEBAGIAN HARGA BELUM DIISI</span>";
                }
                    
                    return "<span class='badge badge-success'>SELESAI</span>";
                
               

            })->rawColumns(['status_badge'])->toJson();
        }
        return view('dashboard.quotation.index');
    }

    public function show($trid){
        $quotation = TRQuotationHD::where('DOCNO', $trid)->first();
        // dd($quotation);

        if(Auth::user()->user_grp == 'supp'){

            if(request()->ajax()){
                return DataTables::of($quotation->details())
                ->toJson();
            }

            return view('dashboard.quotation.show-supplier', [
                'quotation' => $quotation
            ]);
        }
        return view('dashboard.quotation.show', [
            'quotation' => $quotation
        ]);
    }

    public function showItem($docno, $nomerItem){

        $quotation = TRQuotationHD::where('DOCNO', $docno)->first();
        $item =  $quotation->details()->where('NOMOR', $nomerItem)->first();

        $harga = 0;
        $keterangan = '';

        $kodeSup = Auth::user()->name;

        if($kodeSup == $quotation->SUPPLIERCODE){
            $harga = $item->HARGA;
            $keterangan = $item->KET;
        } else if($kodeSup == $quotation->SUPPB){
            $harga = $item->HARGA2;
            $keterangan = $item->KET2;
        } else if($kodeSup == $quotation->SUPPC){
            $harga = $item->HARGA3;
            $keterangan = $item->KET3;
        } 

        return ['success' => true, 'data' => [
            'qty' => $item->QTY, 
            'barang' => $item->KETBRG,
            'satuan' => $item->SATUAN,
            'harga' => $harga,
            'keterangan' => $keterangan
        ]];
        // return ['docno' => $docno, 'nomer' => $nomerItem];
    }

    public function updateItem($docno, $nomerItem, Request $request){

        $data = $request->validate([
            'harga' => 'required|numeric',
            'ket' => 'nullable',
        ], [
            'harga.required' => 'Kolom Harga tidak boleh kosong',
            'harga.numeric' => 'Kolom Harga hanya boleh berisi angka'
        ]);
        
        $quotation = TRQuotationHD::where('DOCNO', $docno)->first();
        
        $item =  $quotation->details()->where('NOMOR', $nomerItem)->first();

        $kodeSup = Auth::user()->name;

        if($kodeSup == $quotation->SUPPLIERCODE){
            $item->where('DOCNO', $docno)->where('NOMOR', $nomerItem)->update([
                'HARGA' => $data['harga'],
                'KET' => $data['ket']
            ]);
        } else if($kodeSup == $quotation->SUPPB){
            $item->where('DOCNO', $docno)->where('NOMOR', $nomerItem)->update([
                'HARGA2' => $data['harga'],
                'KET2' => $data['ket']
            ]);
        } else if($kodeSup == $quotation->SUPPC){
            $item->where('DOCNO', $docno)->where('NOMOR', $nomerItem)->update([
                'HARGA3' => $data['harga'],
                'KET3' => $data['ket']
            ]);
        } 

        return ['status' => 'success', 'info' => 'Harga berhasil diupdate'];

        
       
    }
}
