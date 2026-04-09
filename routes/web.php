<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\QuotationController;

// cek svn

Route::middleware('admin')->group(function () {
    Route::get('signup', [UsersController::class, 'form'])->name('signup');
});
// Route::post('signup', 'SignupController@store')->name('signup.store');

Route::get('/', [UsersController::class, 'login'])->name('login');
Route::post('signin', [UsersController::class, 'signInCek'])->name('signin.check');
Route::get('logout', [UsersController::class, 'logout'])->name('logout');

Route::get('home', [DashboardController::class, 'home'])->name('home');	
Route::get('users', [DashboardController::class, 'users'])->name('users');
Route::get('users/{id}/edit',[DashboardController::class, 'userEdit']);
Route::post('users_save',[DashboardController::class, 'userStore']);
Route::post('users_upd',[DashboardController::class, 'userUpdate']);
Route::delete('users_del',[DashboardController::class, 'userDelete']);

Route::middleware('supplier')->group(function () {	
	Route::get('qtawal',[QuotationController::class, 'index'])->name('qtawal');
	Route::get('qtawal/{id}', [QuotationController::class, 'show'])->name('qtawal.detail');
	Route::get('qtawal/{id}/item/{nomer}', [QuotationController::class, 'showItem'])->name('qtawal.detail-item');
	Route::put('qtawal/{id}/item/{nomer}', [QuotationController::class, 'updateItem']);
	Route::get('{id}/date',[DashboardController::class, 'qtawalDate']);
	Route::get('{id}/edit',[DashboardController::class, 'qtawalEdit']);

	Route::post('qtawal_upd', [DashboardController::class, 'qtawalUpdate']);
	Route::get('pocom', [DashboardController::class, 'pocom'])->name('pocom');
	Route::get('pocom/{id}/date',[DashboardController::class, 'pocomDate']);
	Route::get('pocom/{id}/edit',[DashboardController::class, 'pocomEdit']);
	Route::post('pocom_upd', [DashboardController::class, 'pocomUpdate']);
	Route::delete('pocom',[DashboardController::class, 'pocomDestroy']);
	Route::get('po', [DashboardController::class, 'po'])->name('po');
	Route::get('po/{id}/date',[DashboardController::class, 'poDate']);
	Route::get('pover', [DashboardController::class, 'poVer'])->name('pover');
	Route::get('pover/{id}/date',[DashboardController::class, 'poVerDate']);
	Route::get('pover/{id}/edit',[DashboardController::class, 'poVerEdit']);
	Route::post('pover_upd',[DashboardController::class, 'poVerUpdate']);
	Route::delete('pover',[DashboardController::class, 'poVerDestroy']);
	Route::get('kanban', [DashboardController::class, 'kanban'])->name('kanban');
	Route::get('kanban/{id}/date',[DashboardController::class, 'kanbanDate']);
	Route::get('kanbanexcel', [DashboardController::class, 'kanbanExcel'])->name('kanbanexcel');
	Route::middleware('admin')->group(function () {
		Route::post('kanbanexcel',[DashboardController::class, 'kanbanExcelStore'])->name('kanbanexcel');
	});
	Route::get('kanbanexcel/{id}/date',[DashboardController::class, 'kanbanExcelDate']);
	Route::get('kanbanexcel/{id}/edit',[DashboardController::class, 'kanbanExcelEdit']);
	Route::middleware('admin')->group(function () {
		Route::post('kanbanexcel_upd',[DashboardController::class, 'kanbanExcelUpdate']);
		Route::delete('kanbanexcel',[DashboardController::class, 'kanbanExcelDestroy']);
	});
	Route::get('do', [DashboardController::class, 'do'])->name('do');
	Route::get('dono',[DashboardController::class, 'dono']);
	Route::get('po-list', [DashboardController::class, 'poList']);
	Route::post('do',[DashboardController::class, 'doStore']);
	Route::get('do/{id}/edit',[DashboardController::class, 'doEdit']);
	Route::post('do_upd',[DashboardController::class, 'doUpdate']);
	Route::delete('do',[DashboardController::class, 'doDestroy']);
	Route::get('do_src', [DashboardController::class, 'doSearch'])->name('do_src');
	Route::get('do/{id}/choose',[DashboardController::class, 'doChoose']);
	Route::get('item-list/{id}', [DashboardController::class, 'itemList']);
	Route::get('unit-list/{id}', [DashboardController::class, 'unitList']);
	Route::post('do_dt',[DashboardController::class, 'doDtStore']);
	Route::get('do_dt/{id}', [DashboardController::class, 'doDtList']);
	Route::get('do_dt/{id}/edit',[DashboardController::class, 'doDtEdit']);
	Route::post('do_dt_upd',[DashboardController::class, 'doDtUpdate']);
	Route::delete('do_dt',[DashboardController::class, 'doDtDestroy']);
	Route::get('/printdo/{id}',[DashboardController::class, 'printDoPdf']);
	Route::get('/exportdo/{id}',[DashboardController::class, 'exportDoXls']);

	Route::get('deliverysch', [DashboardController::class, 'deliverySch'])->name('deliverysch');
	Route::post('deliverysch',[DashboardController::class, 'deliverySchStore'])->name('deliverysch');
	Route::get('deliverysch/{id}/date',[DashboardController::class, 'deliverySchDate']);
	Route::get('deliverysch/{id}/edit',[DashboardController::class, 'deliverySchEdit']);
	Route::post('deliverysch_upd',[DashboardController::class, 'deliverySchUpdate']);
	Route::delete('deliverysch',[DashboardController::class, 'deliverySchDestroy']);
});

Route::middleware('customer')->group(function () {
	Route::get('salesorder', [DashboardController::class, 'salesOrder'])->name('salesorder');
	Route::get('salesorder/{id}/date',[DashboardController::class, 'salesOrderDate']);
	Route::get('salesorder/{id}/edit',[DashboardController::class, 'salesOrderEdit']);
	Route::get('salesorder/{id}/pick',[DashboardController::class, 'salesOrderPick']);
	Route::get('salesorderno',[DashboardController::class, 'salesOrderNo']);
	Route::get('salesorder_src', [DashboardController::class, 'salesOrderSrc'])->name('salesorder_src');
	Route::get('type-list/{id}', [DashboardController::class, 'typeList']);
	Route::get('salesorder_dt/{id}', [DashboardController::class, 'salesOrderDt']);
	Route::get('salesorder_dt/{id}/edit',[DashboardController::class, 'salesOrderDtEdit']);
	// Route::middleware('customer')->group(function () {
	Route::post('salesorder_upd',[DashboardController::class, 'salesOrderUpdate']);
	Route::post('salesorder',[DashboardController::class, 'salesOrderStore']);
	Route::post('salesorderdt',[DashboardController::class, 'salesOrderDtStore']);
	Route::post('salesorderdt_upd',[DashboardController::class, 'salesOrderDtUpdate']);
	Route::delete('salesorder',[DashboardController::class, 'salesOrderDestroy']);
	Route::delete('salesorderdt',[DashboardController::class, 'salesOrderDtDestroy']);
	// });
	Route::get('solist', [DashboardController::class, 'soList'])->name('solist');
	Route::get('solist/{id}/date',[DashboardController::class, 'soListDate']);
});