<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use DB;

class ExcelExportDo implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    private $dono;

    public function __construct($dono)
    {
        $this->dono = $dono;
    }

    public function collection()
    {
        return collect(DB::select("select a.SUPPLIERCODE, a.DONO, CONVERT(VARCHAR(10),a.DODATE,103) DODATE, a.PONO, b.SEQNO, b.KODEBRG, c.KETBRG, b.QTY, b.SATUAN 
                                    from TRSUPPDOHD a 
                                    inner join TRSUPPDODT b on (a.DONO=b.DONO)
                                    left join (
                                        select distinct c1.PONO, c1.KODEBRG, c1.KETBRG
                                        from TRPURCHPODT c1
                                    ) c on (a.PONO=c.PONO and b.KODEBRG=c.KODEBRG)
                                    where a.dono=?",[$this->dono]));
    }

    public function headings() :array
    {
        return ["SUPPLIERCODE", "DONO", "DODATE", "PONO","NO", "ITEM", "ITEM NAME","QTY", "SATUAN"];
    }
}
