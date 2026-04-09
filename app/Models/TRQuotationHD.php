<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TRQuotationHD extends Model
{
    use HasFactory;

    public $autoincrement = false;

    public $table = 'TRQUOTATIONHD';


    public $dates = ['TANGGAL'];

    public function scopeSupplier($q, $supplierId){
        return $q->where('SUPPLIERCODE', $supplierId)->orWhere('SUPPB', $supplierId)->orWhere('SUPPC', $supplierId);
    }

    public function details(){
        return $this->hasMany('\App\Models\TRQuotationDT', 'DOCNO', 'DOCNO');
    }

    public function supplier1(){
        return $this->belongsTo('\App\Models\Supplier', 'SUPPLIERCODE', 'SUPPLIERCODE');
    }

    public function supplier2(){
        return $this->belongsTo('\App\Models\Supplier', 'SUPPB', 'SUPPLIERCODE');
    }

    public function supplier3(){
        return $this->belongsTo('\App\Models\Supplier', 'SUPPC', 'SUPPLIERCODE');
    }
}
