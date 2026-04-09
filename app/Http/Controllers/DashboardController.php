<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use DataTables;
use Mail;
use Validator;
use PDF;
// use QrCode;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use CodeItNow\BarcodeBundle\Utils\BarcodeGenerator;
use App\Models\TRQuotationHD;
use Excel;
use App\Exports\ExcelExportDo;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function home()
    {
        return view('dashboard/home');
    }
    // Begin User
    public function users(Request $request)
    {   
        $userid = '';
        $usergrp = '';
        if (Auth::user()->user_type != 'admin') {
            $userid = Auth::user()->name;
        }

        if (Auth::user()->user_grp != 'all') {
            $usergrp = Auth::user()->user_grp;
        }
        
        if ($request->ajax()) {
            $data = DB::select("SELECT [name], UPPER(full_name) full_name, email, 
                                    UPPER(user_type) user_type, 
                                    case when user_grp='supp' then 'SUPPLIER' 
                                        when user_grp='cust' then 'CUSTOMER'
                                        else 'ALL' end user_grp, UPPER([status]) status
                                    FROM users 
                                    WHERE [name] like ?+'%' and user_grp like ?+'%'
                                    ORDER BY user_grp, user_type, [name]",[$userid,$usergrp]);
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){   
                            $btn = ' 
                                <a href="#" class="edit-modal btn btn-outline-primary btn-sm" title="Change" data-id="'.$row->name.'">
                                    <i class="fa fa-edit"></i>
                                </a> ';

                                if (Auth::user()->user_type == 'admin') {
                                    $btn = $btn.' 
                                    <a href="#" class="delete-modal btn btn-outline-danger btn-sm" title="Delete" data-id="'.$row->name.'">
                                        <i class="fa fa-trash"></i>
                                    </a>';
                                }
    
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('dashboard.users');
    }
    
    public function userEdit($id) 
    {
        $data = collect(DB::select("SELECT [name], full_name, email, user_type, user_grp, [status] 
                                    FROM users 
                                    WHERE [name] = ?",[$id]))->first();

        return response()->json($data);
    }

    public function userStore(Request $request)
    {   
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:5|unique:users',
            'email' => 'required|string|email|max:50',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->passes()) {            
            $results = DB::table('android.dbo.MSSUPPLIER')
                ->where('SUPPLIERCODE', '=', $request->name)
                ->first();

            $full_name = $request->name; 
            $user_type = '';
            $user_grp = '';
            if(!empty($results)) {
                $full_name = $results->SUPPLIERNAME; 
                $user_type = 'user';  
                $user_grp = 'supp';     
            } else {
                $results = DB::table('android.dbo.MSCUST')
                        ->where('CUSTCODE', '=', $request->name)
                        ->first();

                if(!empty($results)) {
                    $full_name = $results->CUSTNAME; 
                    $user_type = 'user'; 
                    $user_grp = 'cust';   
                } else {
                    $full_name = $request->name; 
                    $user_type = $request->user_type; 
                    $user_grp = $request->user_grp; 
                }
            }
            
            // save into table
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'full_name' => $full_name,
                'user_type' => $user_type,
                'user_grp' => $user_grp,
                'status' => $request->status
            ]);

            return response()->json(['success' => '1']);

        }
        
        return response()->json(['errors' => $validator->errors()]);
    }

    public function userUpdate(Request $request) 
    {

        if($request->input('password')){
            $validator = Validator::make($request->all(), [
                'email' => 'required|string|email|max:50',
                'password' => 'required|string|min:8|confirmed',
            ]);

            if ($validator->passes()) {  
                if (Auth::user()->user_type == 'admin') {
                    DB::table('users')
                    ->where('name', '=', $request->name)
                    ->update(
                        [
                            'full_name' => $request->full_name, 
                            'email' => $request->email,
                            'password' => Hash::make($request->password),
                            'user_type' => $request->user_type,
                            'user_grp' => $request->user_grp,
                            'status' => $request->status,
                            'updated_at' => date("Y-m-d h:i:sa")
                        ]
                    );
                } else {
                    DB::table('users')
                    ->where('name', '=', $request->name)
                    ->update(
                        [
                            'full_name' => $request->full_name, 
                            'email' => $request->email,
                            'password' => Hash::make($request->password),
                            'updated_at' => date("Y-m-d h:i:sa")
                        ]
                    );
                }  
                return response()->json(['success' => '1']);
            }          
        } else {
            $validator = Validator::make($request->all(), [
                'email' => 'required|string|email|max:50',
            ]);

            if ($validator->passes()) {
                if (Auth::user()->user_type == 'admin') {
                    DB::table('users')
                    ->where('name', '=', $request->name)
                    ->update(
                        [
                            'full_name' => $request->full_name, 
                            'email' => $request->email,
                            'user_type' => $request->user_type,
                            'user_grp' => $request->user_grp,
                            'status' => $request->status,
                            'updated_at' => date("Y-m-d h:i:sa")
                        ]
                    );
                } else {
                    DB::table('users')
                    ->where('name', '=', $request->name)
                    ->update(
                        [
                            'full_name' => $request->full_name, 
                            'email' => $request->email,
                            'updated_at' => date("Y-m-d h:i:sa")
                        ]
                    );
                }
                return response()->json(['success' => '1']);
            }
        }
            
        return response()->json(['errors' => $validator->errors()]);
    }

    public function userDelete(Request $request) 
    {
        DB::table('users')
            ->where('name', '=', $request->name)
            ->delete();
            
        return response()->json(array('errors' => false));
    }
    // End User

    // Begin Supplier
    public function po()
    {
        $userid = '';
        if (Auth::user()->user_type != 'admin') {
            $userid = Auth::user()->name;
        }

        $listPOs = DB::select("SELECT * FROM F_POVSLPB (?,?)",['',$userid]);

        return view('dashboard/po',compact('listPOs'));
    }

    public function poDate($date)
    {
        $userid = '';
        if (Auth::user()->user_type != 'admin') {
            $userid = Auth::user()->name;
        }

        $listPOs = DB::select("SELECT * FROM F_POVSLPB (?,?)",[$date,$userid]);

        return view('dashboard/po',compact('listPOs'));
    }
	
	
	
	 public function qtawalDate(Request $request,$date)
    {
        $userid = '';
        if (Auth::user()->user_type != 'admin') {
            $userid = Auth::user()->name;
        }


        if ($request->ajax()) {
            $data = DB::select("SELECT * FROM F_QP (?,?)",[$date,$userid]);
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){   
                            $btn = 
                                '<a href="javascript:void(0)" class="edit-modal btn btn-outline-primary btn-sm" title="Enter Price" data-id="'.$row->DOCNO.'">
                                    <i class="fa fa-edit"></i>
                                </a> ';
        
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('dashboard/qtawal');
    }
	
	public function qtawalEdit($id)
    {
        $kanbans = collect(DB::select("SELECT DOCNO, SUPPB, SUPPC, KETBRG, QTY, SATUAN, HARGA, HARGA2, HARGA3, KET
                                       FROM TRQUOTATIONDT
                                       WHERE DOCNO = ?",[$id]))->first();

        return response()->json($kanbans);
    }
	
	public function qtawalUpdate(Request $request)
    {
            $str_date = substr($request->DATADATE,3,2).'/'.substr($request->DATADATE,0,2).'/'.substr($request->DATADATE,6,4);

            DB::table('TRQUOTATIONDT')
                ->where('DOCNO', '=', $request->DOCNO)
                ->and('SUPPLIERCODE', '=', $request->SUPPLIERCODE)
				->and ('SUPPB', '=', $request->SUPPB)
                ->and ('SUPPC', '=', $request->SUPPC)
				->and ('SEQNO', '=', $request->SEQNO)
                ->update(
                    [
                        'HARGA' => $request->HARGA,
						'HARGA2' => $request->HARGA2,
						'HARGA3' => $request->HARGA3,
						'KET' => $request->KET,
                        'UPDATED_AT' => date("Y-m-d h:i:sa")
                    ]
				);
		return response()->json(['errors' => false]);
     }
	
    public function poVer(Request $request)
    {
        $userid = '';
        if (Auth::user()->user_type != 'admin') {
            $userid = Auth::user()->name;
        }

        if ($request->ajax()) {
            $data = DB::select("SELECT * FROM F_POVERLIST (?,?)",['',$userid]);
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){   
                            $btn = 
                                '<a href="'.url("/assets/upload/document/po/".$row->UPLOAD).'" target="_blank" class="btn btn-outline-warning btn-sm" title="Unduh Data">
                                    <i class="fa fa-download"></i>
                                </a> 
                                <a href="javascript:void(0)" class="edit-modal btn btn-outline-primary btn-sm" title="Ubah Data" data-id="'.$row->PONO.'">
                                    <i class="fa fa-edit"></i>
                                </a> ';
                            
                            if (Auth::user()->user_type == 'admin') {
                            $btn = $btn.
                                '<a href="javascript:void(0)" class="delete-modal btn btn-outline-danger btn-sm" title="Hapus Data" data-id="'.$row->PONO.'">
                                    <i class="fa fa-trash"></i>
                                </a>';
                            }
    
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }    

        return view('dashboard/poVer');
    }

    public function poVerDate(Request $request,$date)
    {
        $userid = '';
        if (Auth::user()->user_type != 'admin') {
            $userid = Auth::user()->name;
        }

        if ($request->ajax()) {
            $data = DB::select("SELECT * FROM F_POVERLIST (?,?)",[$date,$userid]);
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){   
                            $btn = 
                                '<a href="'.url("/assets/upload/document/po/".$row->UPLOAD).'" target="_blank" class="btn btn-outline-warning btn-sm" title="Unduh Data">
                                    <i class="fa fa-download"></i>
                                </a> 
                                <a href="javascript:void(0)" class="edit-modal btn btn-outline-primary btn-sm" title="Konfirmasi PO" data-id="'.$row->PONO.'">
                                    <i class="fa fa-edit"></i>
                                </a> ';
                           
                            if (Auth::user()->user_type == 'admin') {
                                $btn = $btn.
                                '<a href="javascript:void(0)" class="delete-modal btn btn-outline-danger btn-sm" title="Hapus Data" data-id="'.$row->PONO.'">
                                    <i class="fa fa-trash"></i>
                                </a>';
                            }
        
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('dashboard/poVer');
    }

    public function poVerEdit($id) 
    {
        $kanbans = collect(DB::select("SELECT PONO, TANGGAL, UPLOAD, FGJENIS 
                                        FROM TRPURCHPOHD 
                                        WHERE PONO = ?",[$id]))->first();

        return response()->json($kanbans);
    }

    public function poVerUpdate(Request $request) 
    {
        $path = '';
        $file_name = $request->FILENAME_UPD;
        if ($request->hasFile('FILENAME')) {
            $destinationPath = public_path('/assets/upload/document/po/');

            if ($file_name != '') {
                if (file_exists($destinationPath.$file_name)) {
                    unlink($destinationPath.$file_name);
                }
            }

            $file = $request->file('FILENAME');
            $file_name = $file->getClientOriginalName();
            $file->move($destinationPath,$file_name);
            $path = $destinationPath.$file_name;
        }

        $purchEmail = '';
        if ($request->FGJENIS == '1') {
            $purchEmail = DB::table('MSEMAIL AS A')
                    ->where('A.DEPT', '=', 'PURCH_LOCAL')
                    ->first();
        }

        if (($purchEmail->EMAIL) && ($file_name != '')) {
            $pono = $request->PONO; 
            $tglpo = $request->TANGGAL;
            $to = $purchEmail->EMAIL;
            $frmAdd = 'it@indospring.co.id';
            $frmName = 'ISP Confirmation';
            $subject = "Supplier Confirmation PO ($pono - $tglpo)";
            $text = '';
            $txt_hd = '';
            $txt_hd = "Terlampir PO No. $pono dengan tanggal $tglpo, sudah dikonfirmasi oleh Supplier. "
                    . "Mohon untuk dilakukan pengecekan.\n";

            $text = $txt_hd;

            $html = str_replace("\n", '<br>', $text);
            $html = $html."<br><br>Terima Kasih.";

            Mail::send([], [], function ($msg) use ($html,$to,$frmAdd,$frmName,$subject,$path,$file_name){
            $msg->to($to)
                ->subject($subject)
                ->from($frmAdd,$frmName)
                ->attach($path)
                ->setBody($html, 'text/html');
            });	 

            DB::table('TRPURCHPOHD')
            ->where('PONO', '=', $request->PONO)
            ->update(
                [
                    'FLAGKITE' => '1', 
                    'UPLOAD' => $file_name,
                    'EMAILDT' => date("Y-m-d h:i:sa")
                ]
            );
        } 
            
        return response()->json(['errors' => false]);
    }

    public function poVerDestroy(Request $request) 
    {
        // File::delete('data_file/'.$gambar->file); 
        $poData = DB::table('TRPURCHPOHD AS A')
                    ->where('A.PONO', '=', $request->PONO)
                    ->first();

        $destinationPath = public_path('/assets/upload/document/po/');

        if($poData->UPLOAD) {
            if(file_exists($destinationPath.$poData->UPLOAD)) {
                unlink($destinationPath.$poData->UPLOAD);
            }
        }  

        DB::table('TRPURCHPOHD')
            ->where('PONO', '=', $request->PONO)
            ->update(
                [
                    'FLAGKITE' => '0', 
                    'UPLOAD' => null,
                    'EMAILDT' => null
                ]
            );
            
        return response()->json(array('errors' => false));
    }

    public function kanban()
    {
        $userid = '';
        if (Auth::user()->user_type != 'admin') {
            $userid = Auth::user()->name;
        }

        $listPlants = DB::select("select distinct a.OrderIssue, a.ShipTo 
                                from erp_work..jit_deliveryHD a 
                                where a.SupplierCode LIKE ?+'%' and CONVERT(VARCHAR(10),a.DueDateDeli,112) = CONVERT(VARCHAR(10),GETDATE(),112) 
                                order by a.ShipTo",[$userid]);

        $listCycleHds = DB::select("select a.NoDelivery, a.OrderIssue, a.ShipTo, CONVERT(VARCHAR(10),a.DueDateDO,103) DueDateDO, 
                                    a.DNNumber, CONVERT(VARCHAR(5),a.DueDateDO,108) OrderTime, a.SupplierCode, a.SupplierName, 
                                    CONVERT(VARCHAR(10),a.DueDateDeli,103) DueDateDeli, CONVERT(VARCHAR(5),a.DueDateDeli,108) DeliTime
                                from erp_work..jit_deliveryHD a
                                where a.SupplierCode LIKE ?+'%' and convert(varchar(10),a.DueDateDeli,112) = CONVERT(VARCHAR(10),GETDATE(),112)
                                order by a.ShipTo, a.DNNumber",[$userid]);

        $listCycleDts = DB::select("select  a.NoDelivery, a.OrderIssue, a.ShipTo, a.DueDateDO, a.DNNumber, a.SupplierCode, 
                                    a.SupplierName, a.DueDateDeli, b.NoUrut, b.Billet, b.L, b.T, b.P, b.Grade, b.Bendel, 
                                    b.KanbanBendel, b.XPcs, Cast(b.XKgs as decimal(18,2)) XKgs
                                from erp_work..jit_deliveryHD a inner join erp_work..jit_deliveryDT b on (a.NoDelivery=b.NoDelivery)
                                where a.SupplierCode LIKE ?+'%' and convert(varchar(10),a.DueDateDeli,112) = CONVERT(VARCHAR(10),GETDATE(),112)
                                order by a.ShipTo, a.DNNumber, b.NoUrut",[$userid]);
        
        return view('dashboard/kanban',compact('listPlants','listCycleHds','listCycleDts'));
    }

    public function kanbanDate($date) 
    {
        $userid = '';
        if (Auth::user()->user_type != 'admin') {
            $userid = Auth::user()->name;
        }

        $listPlants = DB::select("select distinct a.OrderIssue, a.ShipTo 
                                from erp_work..jit_deliveryHD a 
                                where a.SupplierCode LIKE ?+'%' and CONVERT(VARCHAR(10),a.DueDateDeli,112) = ?
                                order by a.ShipTo",[$userid,$date]);

        $listCycleHds = DB::select("select a.NoDelivery, a.OrderIssue, a.ShipTo, CONVERT(VARCHAR(10),a.DueDateDO,103) DueDateDO, 
                                    a.DNNumber, CONVERT(VARCHAR(5),a.DueDateDO,108) OrderTime, a.SupplierCode, a.SupplierName, 
                                    CONVERT(VARCHAR(10),a.DueDateDeli,103) DueDateDeli, CONVERT(VARCHAR(5),a.DueDateDeli,108) DeliTime
                                from erp_work..jit_deliveryHD a
                                where a.SupplierCode LIKE ?+'%' and CONVERT(VARCHAR(10),a.DueDateDeli,112) = ?
                                order by a.ShipTo, a.SupplierCode, a.DNNumber",[$userid,$date]);

        $listCycleDts = DB::select("select  a.NoDelivery, a.OrderIssue, a.ShipTo, a.DueDateDO, a.DNNumber, a.SupplierCode, 
                                    a.SupplierName, a.DueDateDeli, b.NoUrut, b.Billet, b.L, b.T, b.P, b.Grade, b.Bendel, 
                                    b.KanbanBendel, b.XPcs, Cast(b.XKgs as decimal(18,2)) XKgs
                                from erp_work..jit_deliveryHD a inner join erp_work..jit_deliveryDT b on (a.NoDelivery=b.NoDelivery)
                                where a.SupplierCode LIKE ?+'%' and CONVERT(VARCHAR(10),a.DueDateDeli,112) = ?
                                order by a.ShipTo, a.SupplierCode, a.DNNumber, b.NoUrut",[$userid,$date]);
        
        return view('dashboard/kanban',compact('listPlants','listCycleHds','listCycleDts'));
    }

    public function kanbanExcel(Request $request) 
    {
        $userid = '';
        if (Auth::user()->user_type != 'admin') {
            $userid = Auth::user()->name;
        }

        if ($request->ajax()) {
            $data = DB::select("SELECT KANBANID, SUPPLIERCODE, CONVERT(VARCHAR(10),DATADATE,103) DATADATE, DESCRIPTION, FILENAME, CONVERT(VARCHAR(10),UPDATED_AT,103)+' '+CONVERT(VARCHAR(5),UPDATED_AT,108) UPDATED_AT
                                    FROM TRKANBANLIST 
                                    WHERE SUPPLIERCODE LIKE ?+'%' 
                                        AND CONVERT(VARCHAR(6),DATADATE,112) = CONVERT(VARCHAR(6),GETDATE(),112)
                                    ORDER BY DATADATE DESC",[$userid]);
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){   
                            $btn = 
                                '<a href="'.url("/assets/images/upload/document/".$row->FILENAME).'" target="_blank" class="btn btn-outline-warning btn-sm" title="Unduh Data">
                                    <i class="fa fa-download"></i>
                                </a>';
                           
                            if (Auth::user()->user_type == 'admin') {
                                $btn = $btn.
                                ' <a href="#" class="edit-modal btn btn-outline-primary btn-sm" title="Ubah Data" data-id="'.$row->KANBANID.'">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="#" class="delete-modal btn btn-outline-danger btn-sm" title="Hapus Data" data-id="'.$row->KANBANID.'">
                                    <i class="fa fa-trash"></i>
                                </a>';
                            }
    
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        $supps = DB::select("SELECT SUPPLIERCODE, SUPPLIERNAME FROM MSSUPPLIER");    

        return view('dashboard/kanbanExcel',compact('supps'));
    }

    public function kanbanExcelDate(Request $request, $date) 
    {
        $userid = '';
        if (Auth::user()->user_type != 'admin') {
            $userid = Auth::user()->name;
        }

        if ($request->ajax()) {
            $data = DB::select("SELECT KANBANID, SUPPLIERCODE, CONVERT(VARCHAR(10),DATADATE,103) DATADATE, DESCRIPTION, FILENAME, CONVERT(VARCHAR(10),UPDATED_AT,103) UPDATED_AT 
                                    FROM TRKANBANLIST 
                                    WHERE SUPPLIERCODE LIKE ?+'%' 
                                        AND CONVERT(VARCHAR(6),DATADATE,112) = ?
                                    ORDER BY DATADATE DESC",[$userid,$date]);
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){   
                            $btn = 
                                '<a href="'.url("/assets/images/upload/document/".$row->FILENAME).'" target="_blank" class="btn btn-outline-warning btn-sm" title="Unduh Data">
                                    <i class="fa fa-download"></i>
                                </a>';
                           
                            if (Auth::user()->user_type == 'admin') {
                                $btn = $btn.
                                ' <a href="#" class="edit-modal btn btn-outline-primary btn-sm" title="Ubah Data" data-id="'.$row->KANBANID.'">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="#" class="delete-modal btn btn-outline-danger btn-sm" title="Hapus Data" data-id="'.$row->KANBANID.'">
                                    <i class="fa fa-trash"></i>
                                </a>';
                            }
        
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        $supps = DB::select("SELECT SUPPLIERCODE, SUPPLIERNAME FROM MSSUPPLIER");    

        return view('dashboard/kanbanExcel',compact('supps'));
    }

    public function kanbanExcelStore(Request $request) 
    {
        $str_date = substr($request->DATADATE,3,2).'/'.substr($request->DATADATE,0,2).'/'.substr($request->DATADATE,6,4);

        $file_name = '';
        if ($request->hasFile('FILENAME')) {
            $destinationPath = public_path('/assets/images/upload/document');

            $file = $request->file('FILENAME');
            $file_name = $file->getClientOriginalName();
            $file->move($destinationPath,$file_name);
        } 

        DB::table('TRKANBANLIST')->insert(
            [
                'SUPPLIERCODE' => $request->SUPPLIERCODE, 
                'DATADATE' => $str_date,
                'DESCRIPTION' => $request->DESCRIPTION,
                'FILENAME' => $file_name,
                'CREATED_AT' => date("Y-m-d h:i:sa"),
                'UPDATED_AT' => date("Y-m-d h:i:sa")
            ]
        );
            
        return response()->json(['errors' => false]);
    }

    public function kanbanExcelEdit($id) 
    {
        $kanbans = collect(DB::select("SELECT KANBANID, SUPPLIERCODE, DATADATE, DESCRIPTION, FILENAME 
                                        FROM TRKANBANLIST 
                                        WHERE KANBANID = ?",[$id]))->first();

        return response()->json($kanbans);
    }

    public function kanbanExcelUpdate(Request $request) 
    {
        $str_date = substr($request->DATADATE,3,2).'/'.substr($request->DATADATE,0,2).'/'.substr($request->DATADATE,6,4);

        $file_name = $request->FILENAME_UPD;
        if ($request->hasFile('FILENAME')) {
            $destinationPath = public_path('/assets/images/upload/document/');

            if(file_exists($destinationPath.$file_name)) {
                unlink($destinationPath.$file_name);
            }

            $file = $request->file('FILENAME');
            $file_name = $file->getClientOriginalName();
            $file->move($destinationPath,$file_name);
        }

        DB::table('TRKANBANLIST')
            ->where('KANBANID', '=', $request->KANBANID)
            ->update(
                [
                    'SUPPLIERCODE' => $request->SUPPLIERCODE, 
                    'DATADATE' => $str_date,
                    'DESCRIPTION' => $request->DESCRIPTION,
                    'FILENAME' => $file_name,
                    'UPDATED_AT' => date("Y-m-d h:i:sa")
                ]
            );
            
        return response()->json(['errors' => false]);
    }

    public function kanbanExcelDestroy(Request $request) 
    {
        // File::delete('data_file/'.$gambar->file); 
        $kanbanData = DB::table('TRKANBANLIST AS A')
                    ->where('A.KANBANID', '=', $request->kanbanid)
                    ->first();

        $destinationPath = public_path('/assets/images/upload/document/');

        if($kanbanData->FILENAME) {
            if(file_exists($destinationPath.$kanbanData->FILENAME)) {
                unlink($destinationPath.$kanbanData->FILENAME);
            }
        }  

        DB::table('TRKANBANLIST')
            ->where('KANBANID', '=', $request->kanbanid)
            ->delete();
            
        return response()->json(array('errors' => false));
    }

    public function do() 
    {
        return view('dashboard/do');
    }

    public function dono() {
        $dono = DB::select("SELECT dbo.F_KONTROLDOSUPP(?) AS donum, ? AS supplier",[Auth::user()->name, Auth::user()->full_name]);

        return response()->json($dono);
    }

    public function poList()
    {
        $datas = DB::select("select distinct a.PONO 
                            from TRPURCHDNHD a
                            inner join TRPURCHPOHD b on (a.PONO=b.PONO)
                            where a.PERIOD >= CONVERT(VARCHAR(6),DATEADD(month,-4,GETDATE()),112) and b.SUPPLIERCODE=?",[Auth::user()->name]);
        
        if(!empty($datas)){
            foreach ($datas as $data) {
                echo '<option value="'.$data->PONO.'">'.$data->PONO.'</option>';
            }
        }else{
            echo '<option value="0" disabled>Not Found</option>';
        }
    }
    
    public function doStore(Request $request) 
    {      
        $validator = Validator::make($request->all(), [
            'pono' => 'required',
        ]);

        if ($validator->passes()) {            
                        
            // save into table
            // $str_date = substr($request->DODATE,3,2).'/'.substr($request->DODATE,0,2).'/'.substr($request->DODATE,6,4);         
            DB::table('TRSUPPDOHD')->insert(
                [
                    'DONO' => $request->dono, 
                    'DODATE' => $request->dodate,
                    'SUPPLIERCODE' => Auth::user()->name,
                    'PONO' => $request->pono,
                    'LASTUPDATE' => date("Y-m-d h:i:sa")
                ]
            );

            return response()->json(['success' => '1']);

        }
        
        return response()->json(['errors' => $validator->errors()]);
    }

    public function doEdit($id) 
    {
        $datas = collect(DB::select("SELECT a.dono, a.dodate, a.pono, b.full_name supplier 
                                        FROM TRSUPPDOHD a
                                        inner join users b on (a.suppliercode=b.name)
                                        WHERE a.DONO = ?",[$id]))->first();

        return response()->json($datas);
    }

    public function doUpdate(Request $request) 
    {
        $validator = Validator::make($request->all(), [
            'pono' => 'required',
        ]);

        if ($validator->passes()) {            
                        
            // save into table        
            DB::table('TRSUPPDOHD')
            ->where('DONO', '=', $request->dono)
                ->update(
                    [
                        'PONO' => $request->pono,
                        'LASTUPDATE' => date("Y-m-d h:i:sa")
                    ]
            );

            return response()->json(['success' => '1']);
        }
        
        return response()->json(['errors' => $validator->errors()]);           
    }

    public function doDestroy(Request $request) 
    {
        DB::table('TRSUPPDOHD')
            ->where('DONO', '=', $request->dono)
            ->delete();

        DB::table('TRSUPPDODT')
            ->where('DONO', '=', $request->dono)
            ->delete();
            
        return response()->json(array('errors' => false));
    }

    public function doSearch(Request $request) 
    {
        $userid = '';
        if (Auth::user()->user_type != 'admin') {
            $userid = Auth::user()->name;
        }

        if ($request->ajax()) {
            $data = DB::select("select a.dono, convert(varchar(10),a.dodate,103) dodate, a.pono, b.full_name supplier
                                    from TRSUPPDOHD a
                                    inner join users b on (a.suppliercode=b.name)
                                    where a.suppliercode LIKE ?+'%' and CONVERT(VARCHAR(6),a.dodate,112) >= CONVERT(VARCHAR(6),DATEADD(month,-2, GETDATE()),112) 
                                    order by convert(varchar(8),a.dodate,112) DESC, a.dono",[$userid]);
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){   
                            $btn = '<button class="choose-modal btn btn-outline-primary btn-sm" title="Choose " data-id="'.$row->dono.'"><i class="fa fa-hand-point-up"></i></button>';
        
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
    }

    public function doChoose($id) 
    {
        $listDOs = collect(DB::select("SELECT a.dono, convert(varchar(10),a.dodate,103) dodate, a.pono, b.full_name supplier
                                        FROM TRSUPPDOHD a
                                        inner join users b on (a.suppliercode=b.name)
                                        WHERE a.dono = ?",[$id]))->first();

        return response()->json($listDOs);
    }

    public function itemList($pono)
    {
        $datas = DB::select("select distinct RTRIM(kodebrg) kodebrg, RTRIM(ketbrg) ketbrg 
                            from TRPURCHPODT 
                            where pono = ? 
                            order by kodebrg",[$pono]);
        
        if(!empty($datas)){
            foreach ($datas as $data) {
                echo '<option value="'.$data->kodebrg.'" data-subtext="'.$data->kodebrg.'">'.$data->ketbrg.'</option>';
            }
        }else{
            echo '<option value="0" disabled>Not Found</option>';
        }
    }

    public function unitList($pono)
    {
        $datas = DB::select("select distinct a.satuan, b.MEASURENAME
                            from TRPURCHPODT a
                            inner join MSMEASURE b on (a.SATUAN=b.MEASURECODE)
                            where a.pono = ? 
                            order by a.satuan",[$pono]);
        
        if(!empty($datas)){
            foreach ($datas as $data) {
                echo '<option value="'.$data->satuan.'" data-subtext="'.$data->MEASURENAME.'">'.$data->satuan.'</option>';
            }
        }else{
            echo '<option value="0" disabled>Not Found</option>';
        }
    }

    public function doDtStore(Request $request) 
    {
        $validator = Validator::make($request->all(), [
            'kodebrg' => 'required',
            'qty' => 'required|numeric',
            'unit' => 'required',
        ]);

        if ($validator->passes()) {            
                        
            // save into table      
            $cekItem = DB::select("select seqno
                                from TRSUPPDODT 
                                where dono = ? and kodebrg = ?",[$request->dono,$request->kodebrg]);

            $cekSeq = DB::select("SELECT isnull(MAX(SEQNO),0)+1 seqno FROM TRSUPPDODT WHERE DONO= ?",[$request->dono]);
            
            if(!empty($cekItem)){
                DB::table('TRSUPPDODT')
                ->where('SEQNO', '=', $cekItem[0]->seqno)
                ->update(
                    [
                        'QTY' => $request->qty,
                        'LASTUPDATE' => date("Y-m-d h:i:sa")
                    ]
                );            
            }else{            
                DB::table('TRSUPPDODT')->insert(
                    [
                        'DONO' => $request->dono, 
                        'SEQNO' => $cekSeq[0]->seqno, 
                        'KODEBRG' => $request->kodebrg,
                        'QTY' => $request->qty,
                        'SATUAN' => $request->unit,
                        'LASTUPDATE' => date("Y-m-d h:i:sa")
                    ]
                );
            }

            return response()->json(['success' => '1']);

        }
        
        return response()->json(['errors' => $validator->errors()]);        
    }

    public function doDtList(Request $request, $dono) 
    {
        // $userid = '';
        // if (Auth::user()->user_type != 'admin') {
        //     $userid = Auth::user()->name;
        // }
        
        if ($request->ajax()) {
            $data = DB::select("select a.dono, a.seqno, a.kodebrg, a.qty, a.satuan, c.ketbrg
                                from TRSUPPDODT a 
                                inner join TRSUPPDOHD b on (a.DONO=b.DONO)
                                left join (
                                    select distinct c1.PONO, c1.KODEBRG, c1.KETBRG
                                    from TRPURCHPODT c1
                                ) c on (b.PONO=c.PONO and a.KODEBRG=c.KODEBRG)
                                where a.dono = ? 
                                order by a.seqno",[$dono]);
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){   
                            $btn = '<a href="#" class="edt-dt-modal btn btn-outline-primary btn-sm" title="Ubah Data" data-id="'.$row->seqno.'">
                                <i class="fa fa-edit"></i>
                            </a>
                            <a href="#" class="del-dt-modal btn btn-outline-danger btn-sm" title="Hapus Data" data-id="'.$row->seqno.'">
                                <i class="fa fa-trash"></i>
                            </a>';
        
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
    }

    public function doDtEdit($id) 
    {
        $datas = collect(DB::select("SELECT dono, seqno, kodebrg, qty, satuan 
                                        FROM TRSUPPDODT 
                                        WHERE seqno = ?",[$id]))->first();

        return response()->json($datas);
    }

    public function doDtUpdate(Request $request) 
    {
        $validator = Validator::make($request->all(), [
            'kodebrg' => 'required',
            'qty' => 'required|numeric',
            'unit' => 'required',
        ]);

        if ($validator->passes()) {            
                        
            // save into table                  
            DB::table('TRSUPPDODT')
            ->where('SEQNO', '=', $request->seqno)
            ->update(
                [
                    'KODEBRG' => $request->kodebrg,
                    'QTY' => $request->qty,
                    'SATUAN' => $request->unit,
                    'LASTUPDATE' => date("Y-m-d h:i:sa")
                ]
            );

            return response()->json(['success' => '1']);
        }
        
        return response()->json(['errors' => $validator->errors()]); 
    }

    public function doDtDestroy(Request $request) 
    {
        DB::table('TRSUPPDODT')
            ->where('seqno', '=', $request->seqno)
            ->delete();
            
        return response()->json(array('errors' => false));
    }

    public function printDoPdf($id) {
        $datas = DB::select("select a.dono from TRSUPPDOHD a inner join TRSUPPDODT b on (a.DONO=b.DONO) where a.DONO = ?",[$id]);        
        if ($datas != null) {
            $barcode = new BarcodeGenerator();
            $barcode->setText($datas[0]->dono);
            $barcode->setType(BarcodeGenerator::Code128);
            $barcode->setScale(2);
            $barcode->setThickness(25);
            $barcode->setFontSize(10);
            $qrcode = $barcode->generate();
            // $qrcode = base64_encode(QrCode::format('svg')->size(100)->errorCorrection('H')->generate($datas[0]->dono));
            // $qrcode = DNS2D::getBarcodeHTML('111', 'QRCODE');
            $pdf = PDF::loadView('dashboard.slip_pdf', compact('qrcode'))->setPaper([0,0,227,100]);
            return $pdf->stream(Auth::user()->name.$id.'.pdf');            
        }
    }

    public function exportDoXls($id) {
        return Excel::download(new ExcelExportDo($id), $id.'.xlsx');
    }

    public function mdn()
    {
        $userid = '';
        if (Auth::user()->user_type != 'admin') {
            $userid = Auth::user()->name;
        }

        $datas = DB::select("exec P_MONITORINGPO ?,?,?,?",['','','',$userid]);
        
        return view('dashboard/mdn',compact('datas'));
    }

    public function mdnDate($date)
    {
        $userid = '';
        if (Auth::user()->user_type != 'admin') {
            $userid = Auth::user()->name;
        }

        $datas = DB::select("exec P_MONITORINGPO ?,?,?,?",[$date,'','',$userid]);
       
        return view('dashboard/mdn',compact('datas'));
    }

    public function deliverySch(Request $request) 
    {
        $userid = '';
        if (Auth::user()->user_type != 'admin') {
            $userid = Auth::user()->name;
        }

        if ($request->ajax()) {
            $data = DB::select("SELECT DELIVERYID, SUPPLIERCODE, CONVERT(VARCHAR(10),DELIVERYDATE,103) DELIVERYDATE, 
                                EMKL, DESTINATION, INVOICE, CONTAINER, SEAL, TARE, NOPOL, DRIVER, PLANT, DESCRIPTION, 
                                CONVERT(VARCHAR(10),isnull(UPDATEDDATE,CREATEDDATE),103)+' '+CONVERT(VARCHAR(5),isnull(UPDATEDDATE,CREATEDDATE),108) UPDATED_AT
                                FROM TRDELIVERYSCHEDULE 
                                WHERE SUPPLIERCODE LIKE ?+'%' 
                                AND CONVERT(VARCHAR(6),DELIVERYDATE,112) = CONVERT(VARCHAR(6),GETDATE(),112)
                                ORDER BY DELIVERYDATE DESC",[$userid]);
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){   
                            $btn = 
                                '<a href="#" class="edit-modal btn btn-outline-primary btn-sm" title="Edit Data" data-id="'.$row->DELIVERYID.'">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="#" class="delete-modal btn btn-outline-danger btn-sm" title="Delete Data" data-id="'.$row->DELIVERYID.'">
                                    <i class="fa fa-trash"></i>
                                </a>';
    
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }  

        return view('dashboard/deliverySch');
    }

    public function deliverySchDate(Request $request, $date) 
    {
        $userid = '';
        if (Auth::user()->user_type != 'admin') {
            $userid = Auth::user()->name;
        }

        if ($request->ajax()) {
            $data = DB::select("SELECT DELIVERYID, SUPPLIERCODE, CONVERT(VARCHAR(10),DELIVERYDATE,103) DELIVERYDATE, 
                                EMKL, DESTINATION, INVOICE, CONTAINER, SEAL, TARE, NOPOL, DRIVER, PLANT, DESCRIPTION, 
                                CONVERT(VARCHAR(10),isnull(UPDATEDDATE,CREATEDDATE),103)+' '+CONVERT(VARCHAR(5),isnull(UPDATEDDATE,CREATEDDATE),108) UPDATED_AT
                                FROM TRDELIVERYSCHEDULE 
                                WHERE SUPPLIERCODE LIKE ?+'%' 
                                AND CONVERT(VARCHAR(6),DELIVERYDATE,112) = ?
                                ORDER BY DELIVERYDATE DESC",[$userid,$date]);
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){   
                            $btn = 
                                '<a href="#" class="edit-modal btn btn-outline-primary btn-sm" title="Edit Data" data-id="'.$row->DELIVERYID.'">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="#" class="delete-modal btn btn-outline-danger btn-sm" title="Delete Data" data-id="'.$row->DELIVERYID.'">
                                    <i class="fa fa-trash"></i>
                                </a>';
        
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }   

        return view('dashboard/deliverySch');
    }

    public function deliverySchStore(Request $request) 
    {
        $str_date = substr($request->DELIVERYDATE,3,2).'/'.substr($request->DELIVERYDATE,0,2).'/'.substr($request->DELIVERYDATE,6,4); 
        $userid = Auth::user()->name;

        DB::table('TRDELIVERYSCHEDULE')->insert(
            [
                'SUPPLIERCODE' => $userid, 
                'DELIVERYDATE' => $str_date,
                'EMKL' => $request->EMKL,
                'DESTINATION' => $request->DESTINATION,
                'INVOICE' => $request->INVOICE,
                'CONTAINER' => $request->CONTAINER,
                'SEAL' => $request->SEAL,
                'TARE' => $request->TARE,
                'NOPOL' => $request->NOPOL,
                'DRIVER' => $request->DRIVER,
                'PLANT' => $request->PLANT,
                'DESCRIPTION' => $request->DESCRIPTION,
                'USERLOGON' => $userid,
                'CREATEDDATE' => date("Y-m-d h:i:sa")
            ]
        );
            
        return response()->json(['errors' => false]);
    }

    public function deliverySchEdit($id) 
    {
        $deliverys = collect(DB::select("SELECT DELIVERYID, SUPPLIERCODE, DELIVERYDATE, EMKL, DESTINATION, INVOICE, CONTAINER, 
                                        SEAL, TARE, NOPOL, DRIVER, PLANT, DESCRIPTION 
                                        FROM TRDELIVERYSCHEDULE 
                                        WHERE DELIVERYID = ?",[$id]))->first();

        return response()->json($deliverys);
    }

    public function deliverySchUpdate(Request $request) 
    {
        $str_date = substr($request->DELIVERYDATE,3,2).'/'.substr($request->DELIVERYDATE,0,2).'/'.substr($request->DELIVERYDATE,6,4);
        $userid = Auth::user()->name;
        
        DB::table('TRDELIVERYSCHEDULE')
            ->where('DELIVERYID', '=', $request->DELIVERYID)
            ->update(
                [
                    'SUPPLIERCODE' => $request->SUPPLIERCODE, 
                    'DELIVERYDATE' => $str_date,
                    'EMKL' => $request->EMKL,
                    'DESTINATION' => $request->DESTINATION,
                    'INVOICE' => $request->INVOICE,
                    'CONTAINER' => $request->CONTAINER,
                    'SEAL' => $request->SEAL,
                    'TARE' => $request->TARE,
                    'NOPOL' => $request->NOPOL,
                    'DRIVER' => $request->DRIVER,
                    'PLANT' => $request->PLANT,
                    'DESCRIPTION' => $request->DESCRIPTION,
                    'USERLOGON' => $userid,
                    'UPDATEDDATE' => date("Y-m-d h:i:sa")
                ]
            );
            
        return response()->json(['errors' => false]);
    }

    public function deliverySchDestroy(Request $request) 
    {
        DB::table('TRDELIVERYSCHEDULE')
            ->where('DELIVERYID', '=', $request->DELIVERYID)
            ->delete();
            
        return response()->json(array('errors' => false));
    }
    // End Supplier 

    // Customer
    public function salesOrder() 
    {
        $userid = '';
        if (Auth::user()->user_type != 'admin') {
            $userid = Auth::user()->name;
        }

        // $listSos = collect(DB::select("select a.PONO, CONVERT(VARCHAR(10),a.PODATE,103) PODATE, a.CUST, a.CITY, a.BRANDCODE, 
        //                             a.CUSTFOR, a.ADDRESSFOR, a.CITYFOR, a.EXPEDISI
        //                         from TRSLSSOCUSTHD a 
        //                         where a.USERLOGON LIKE ?+'%' and CONVERT(VARCHAR(6),a.PODATE,112) = CONVERT(VARCHAR(6),GETDATE(),112) 
        //                         order by a.PONO DESC",[$userid]))->first();
        
        // return view('dashboard/so',compact('listSos'));
        return view('dashboard/so');
    }

    public function salesOrderDate(Request $request, $date)  
    {
        $userid = '';
        if (Auth::user()->user_type != 'admin') {
            $userid = Auth::user()->name;
        }
        
        return view('dashboard/so',compact(''));
    }

    public function salesOrderStore(Request $request) 
    {
        $userid = '';
        if (Auth::user()->user_type != 'admin') {
            $userid = Auth::user()->name;
        }
        $str_date = substr($request->PODATE,3,2).'/'.substr($request->PODATE,0,2).'/'.substr($request->PODATE,6,4); 
        
        DB::table('TRSLSSOCUSTHD')->insert(
            [
                'PONO' => $request->PONO, 
                'PODATE' => $str_date,
                'CUST' => $request->CUST,
                'CITY' => $request->CITY,
                'BRANDCODE' => $request->BRANDCODE,
                'CUSTFOR' => $request->CUSTFOR,
                'ADDRESSFOR' => $request->ADDRESSFOR,
                'CITYFOR' => $request->CITYFOR,
                'EXPEDISI' => $request->EXPEDISI,
                'LASTUPDATE' => date("Y-m-d h:i:sa"),
                'USERLOGON' => $userid
            ]
        );
            
        return response()->json(['errors' => false]);
    }

    public function salesOrderNo() {
        $sonum = DB::select("SELECT dbo.F_KONTROLSONO() SONUM");

        return response()->json($sonum);
    }

    public function salesOrderEdit($id) 
    {
        $kanbans = collect(DB::select("SELECT PONO, PODATE, CUST, CITY, BRANDCODE, CUSTFOR, 
                                            ADDRESSFOR, CITYFOR, EXPEDISI 
                                        FROM TRSLSSOCUSTHD 
                                        WHERE PONO = ?",[$id]))->first();

        return response()->json($kanbans);
    }

    public function salesOrderDestroy(Request $request) 
    {
        DB::table('TRSLSSOCUSTHD')
            ->where('PONO', '=', $request->PONO)
            ->delete();

        DB::table('TRSLSSOCUSTDT')
            ->where('PONO', '=', $request->PONO)
            ->delete();
            
        return response()->json(array('errors' => false));
    }

    public function salesOrderUpdate(Request $request) 
    {
        $str_date = substr($request->PODATE,3,2).'/'.substr($request->PODATE,0,2).'/'.substr($request->PODATE,6,4);

        DB::table('TRSLSSOCUSTHD')
            ->where('PONO', '=', $request->PONO)
            ->update(
                [
                    'PONO' => $request->PONO, 
                    'PODATE' => $str_date,
                    'CUST' => $request->CUST,
                    'CITY' => $request->CITY,
                    'BRANDCODE' => $request->BRANDCODE,
                    'CUSTFOR' => $request->CUSTFOR,
                    'ADDRESSFOR' => $request->ADDRESSFOR,
                    'CITYFOR' => $request->CITYFOR,
                    'EXPEDISI' => $request->EXPEDISI,
                    'LASTUPDATE' => date("Y-m-d h:i:sa")
                ]
            );
            
        return response()->json(['errors' => false]);
    }

    public function salesOrderSrc(Request $request) 
    {
        $userid = '';
        if (Auth::user()->user_type != 'admin') {
            $userid = Auth::user()->name;
        }

        if ($request->ajax()) {
            $data = DB::select("select a.PONO, CONVERT(VARCHAR(10),a.PODATE,103) PODATE, a.CUST, 
                                        a.CITY, a.BRANDCODE, a.CUSTFOR, a.ADDRESSFOR, a.CITYFOR, a.EXPEDISI
                                    from TRSLSSOCUSTHD a 
                                    where a.USERLOGON LIKE ?+'%' and CONVERT(VARCHAR(6),a.PODATE,112) = CONVERT(VARCHAR(6),GETDATE(),112) 
                                    order by a.PONO DESC",[$userid]);
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){   
                            $btn = '<button class="pick-modal btn btn-outline-primary btn-sm" title="Pilih" data-id="'.$row->PONO.'"><i class="fa fa-hand-point-up"></i></button>';
        
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
    }

    public function salesOrderPick($id) 
    {
        $listSos = collect(DB::select("SELECT PONO, PODATE, CUST, CITY, BRANDCODE, CUSTFOR, 
                                            ADDRESSFOR, CITYFOR, EXPEDISI 
                                        FROM TRSLSSOCUSTHD 
                                        WHERE PONO = ?",[$id]))->first();

        return response()->json($listSos);
    }

    public function typeList($mrk)
    {
        $types = DB::select("select RTRIM(TYPENO) TYPENO, RTRIM(ITM_DSC) ITM_DSC, BRANDCODE, ITM_SLS, ITM_MSR, ITM_WGT 
                            from erp_sij..V_MSFG 
                            where BRANDCODE = ? 
                            order by TYPENO",[$mrk]);
        
        if(!empty($types)){
            foreach ($types as $type) {
                echo '<option value="'.$type->TYPENO.'">'.$type->TYPENO.'</option>';
            }
        }else{
            echo '<option value="0" disabled>TIDAK ADA DATA</option>';
        }
    }

    public function salesOrderDtStore(Request $request) 
    {
        $userid = '';
        if (Auth::user()->user_type != 'admin') {
            $userid = Auth::user()->name;
        }

        $cekType = DB::select("select PONO, TYPENO, QTY, SEQ 
                            from TRSLSSOCUSTDT 
                            where PONO = ? and TYPENO = ?",[$request->PONO,$request->TYPENO]);
        
        if(!empty($cekType)){
            DB::table('TRSLSSOCUSTDT')
            ->where('SEQ', '=', $cekType[0]->SEQ)
            ->update(
                [
                    'QTY' => $request->QTY+$cekType[0]->QTY,
                    'LASTUPDATE' => date("Y-m-d h:i:sa")
                ]
            );            
        }else{            
            DB::table('TRSLSSOCUSTDT')->insert(
                [
                    'PONO' => $request->PONO, 
                    'TYPENO' => $request->TYPENO,
                    'QTY' => $request->QTY,
                    'LASTUPDATE' => date("Y-m-d h:i:sa"),
                    'USERLOGON' => $userid
                ]
            );
        }
            
        return response()->json(['errors' => false]);
    }

    public function salesOrderDt(Request $request, $pono) 
    {
        $userid = '';
        if (Auth::user()->user_type != 'admin') {
            $userid = Auth::user()->name;
        }
        
        if ($request->ajax()) {
            $data = DB::select("select a.PONO, a.SEQ, a.TYPENO, a.QTY
                                    from TRSLSSOCUSTDT a 
                                    where a.USERLOGON LIKE ?+'%' and a.PONO = ? 
                                    order by a.PONO DESC",[$userid,$pono]);
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){   
                            $btn = '<a href="#" class="edt-dt-modal btn btn-outline-primary btn-sm" title="Ubah Data" data-id="'.$row->SEQ.'">
                                <i class="fa fa-edit"></i>
                            </a>
                            <a href="#" class="del-dt-modal btn btn-outline-danger btn-sm" title="Hapus Data" data-id="'.$row->SEQ.'">
                                <i class="fa fa-trash"></i>
                            </a>';
        
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
    }

    public function salesOrderDtEdit($id) 
    {
        $kanbans = collect(DB::select("SELECT PONO, SEQ, TYPENO, QTY 
                                        FROM TRSLSSOCUSTDT 
                                        WHERE SEQ = ?",[$id]))->first();

        return response()->json($kanbans);
    }

    public function salesOrderDtUpdate(Request $request) 
    {
        DB::table('TRSLSSOCUSTDT')
            ->where('SEQ', '=', $request->SEQ)
            ->update(
                [
                    'QTY' => $request->QTY,
                    'LASTUPDATE' => date("Y-m-d h:i:sa")
                ]
            );
            
        return response()->json(['errors' => false]);
    }

    public function salesOrderDtDestroy(Request $request) 
    {
        DB::table('TRSLSSOCUSTDT')
            ->where('SEQ', '=', $request->SEQ)
            ->delete();
            
        return response()->json(array('errors' => false));
    }

    public function soList()
    {
        $userid = '';
        if (Auth::user()->user_type != 'admin') {
            $userid = Auth::user()->name;
        }

        $listSOs = DB::select("SELECT * FROM F_SOLIST(?,?)",['',$userid]);

        return view('dashboard/soList',compact('listSOs'));
    }

    public function soListDate($date)
    {
        $userid = '';
        if (Auth::user()->user_type != 'admin') {
            $userid = Auth::user()->name;
        }

        $listSOs = DB::select("SELECT * FROM F_SOLIST(?,?)",[$date,$userid]);

        return view('dashboard/soList',compact('listSOs'));
    }
    // End Customer
}
