<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;
use Illuminate\Support\Facades\DB;

class TRQuotationDT extends Model
{
    use HasFactory;

    public $autoincrement = false;

    public $table = 'TRQUOTATIONDT';

    public $fillable = ['HARGA', 'HARGA2', 'HARGA3', 'KET', 'KET2', 'KET3'];

    public $timestamps = false;

    public function quotationheader()
    {
        return $this->belongsTo('\App\Models\TRQuotationHD', 'DOCNO', 'DOCNO');
    }


    public function getHargaSupplierAttribute()
    {
        $kodeSup = Auth::user()->name;
        $harga = null;
        if ($kodeSup == $this->quotationheader->SUPPLIERCODE) {
            $harga = $this->HARGA;
        } else if ($kodeSup == $this->quotationheader->SUPPB) {
            $harga = $this->HARGA2;
        } else if ($kodeSup == $this->quotationheader->SUPPC) {
            $harga = $this->HARGA3;
        }
        return $harga;
    }

    public function getHargaSupplierFormatAttribute()
    {
        $kodeSup = Auth::user()->name;

        $currSymbol = DB::table('MSSUPPLIER as a')
            ->join('MSCURRENCY as b', 'a.CURRENCY', '=', 'b.CURRCODE')
            ->where('a.SUPPLIERCODE', $kodeSup)
            ->value('b.CURRSYMBOL');

        $symbol = $currSymbol ?? 'Rp.';

        return $symbol . ' ' . number_format($this->harga_supplier, 2, ',', '.');
    }
}
