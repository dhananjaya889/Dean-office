<?php

use App\Http\Controllers\BillController;
use App\Http\Controllers\ChechListController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\MaintenanceController;
use App\Http\Controllers\MedicalExamController;
use App\Http\Controllers\MedicalLecController;
use App\Http\Controllers\NoticeController;
use App\Http\Controllers\PaybillController;
use App\Http\Controllers\QuartazController;
use App\Http\Controllers\QuartazItemController;
use App\Http\Controllers\QuartazUserController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AtendanceController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PreviousBillController;

Route::get('/', function () {
    return view('landing');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    // Route::get('/dashboard', function () {
    //     return view('admin.index');
    // })->name('dashboard');

    Route::get('/dashboard', [UserController::class, 'getDashboard'])->name('dashboard');

    // users
    Route::get('/users', [UserController::class, 'index'])->name('users');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users/store', [UserController::class, 'store'])->name('users.store');
    Route::get('/api/users', [UserController::class, 'getUsers'])->name('users.get');
    Route::get('/api/users/{id}', [UserController::class, 'getUserById'])->name('users.getbyid');
    Route::get('user/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
    Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');

    // notices
    Route::get('/notices', [NoticeController::class, 'index'])->name('notices');
    Route::get('/notices/create', [NoticeController::class, 'create'])->name('notices.create');
    Route::post('/notices/store', [NoticeController::class, 'store'])->name('notices.store');
    Route::delete('/notices/{id}', [NoticeController::class, 'destroy'])->name('notices.destroy');
    Route::get('/nortice/{id}/{title}', [NoticeController::class, 'getNoticesById'])->name(('nortice.show'));

    //quartaz
    Route::get('/quartaz', [QuartazController::class, 'index'])->name('quartaz');
    Route::get('/quartaz/create', [QuartazController::class, 'create'])->name('quartaz.create');
    Route::delete('/quartaz/{id}', [QuartazController::class, 'destroy'])->name('quartaz.destroy');
    Route::post('/quartaz/store', [QuartazController::class, 'store'])->name('quartaz.store');
    Route::get('/quartaz/{id}', [QuartazController::class, 'getQuartazById'])->name('quartaz.show');
    Route::get('/quartaz/quartazitem/{id}', [QuartazItemController::class, 'create'])->name('quartaz.quartazitem');
    Route::get('/quartaz/quartazuser/{id}', [QuartazUserController::class, 'create'])->name('quartaz.quartazuser');
    Route::post('/quartaz/item/store', [QuartazItemController::class, 'store'])->name('quartazitem.store');
    Route::post('/quartaz/user/store', [QuartazUserController::class, 'store'])->name('quartazuser.store');
    Route::get('/quartaz/user/{id}', [QuartazController::class, 'getQuartazByUser'])->name('quartaz.user.view');
    Route::delete('/quartaz/item/delete/{id}', [QuartazItemController::class, 'destroy'])->name('quartazitem.delete');
    Route::delete('/quartaz/user/delete/{id}', [QuartazUserController::class, 'destroy'])->name('quartazuser.delete');
    Route::get('/quartaz/{id}/edit', [QuartazController::class, 'edit'])->name('quartaz.edit');
    Route::put('/quartaz/{id}', [QuartazController::class, 'update'])->name('quartaz.update');
    Route::get('/previous_quartaz', [QuartazController::class, 'previous'])->name('previous_quartaz.index');


    //items
    Route::get('/items', [ItemController::class, 'index'])->name('items');
    Route::get('/items/create', [ItemController::class, 'create'])->name('items.create');
    Route::post('items/store', [ItemController::class, 'store'])->name('items.store');
    Route::get('/items/{id}/{name}', [ItemController::class, 'getItemsById'])->name('items.show');
    Route::delete('/items/{id}', [ItemController::class, 'destroy'])->name('items.destroy');
    Route::get('/items/{id}/edit/{name}', [ItemController::class, 'edit'])->name('items.edit');
    Route::put('/items/{id}', [ItemController::class, 'update'])->name('items.update');

    Route::get('previous_items',[ItemController::class, 'previous'])->name('previous_items.index');
    Route::get('/previous_items/download', [ItemController::class, 'downloadPdf'])->name('previous_items.download');

    //bills
    Route::get('/bills', [BillController::class, 'index'])->name('bills.index');
    Route::get('/bills/create', [BillController::class, 'create'])->name('bills.create');
    Route::post('/bills/store', [BillController::class, 'store'])->name('bills.store');
    Route::get('/bills/{id}/{name}', [BillController::class, 'getBillsById'])->name('bills.show');
    Route::get('/bills/getByQua/data/{id}', [BillController::class, 'getUserAndBillNum'])->name('bils.getByQua');
    Route::delete('/bills/{id}', [BillController::class, 'destroy'])->name('bills.destroy');

    Route::get('/previous_bills', [BillController::class, 'previousBills'])->name('previous.bills');
    Route::get('/previous-bills', [PreviousBillController::class, 'index'])->name('previous.bills.index');
    Route::get('/previous-bills/{id}', [PreviousBillController::class, 'show'])->name('previous.bills.show');
    Route::post('/previous-bills/store', [PreviousBillController::class, 'store'])->name('previous.bills.store');
    Route::get('/previous-bills/download', [PreviousBillController::class, 'downloadPdf'])->name('previous.bills.download');
    

    //paybills
    Route::get('/paybills',[PaybillController::class, 'index'])->name('paybills.index');
    Route::get('/paybills/create', [PaybillController::class, 'create'])->name('paybills.create');
    Route::post('/paybills/store', [PaybillController::class, 'store'])->name('paybills.store');
    Route::get('paybills/{id}', [PaybillController::class, 'getPaybillsById'])->name('paybills.show');
    Route::delete('/paybills/{id}', [PaybillController::class, 'destroy'])->name('paybills.destroy');

    //attendance
    Route::get('/attendance', [AtendanceController::class, 'index'])->name('attendance.index');
    Route::get('/attendance/create', [AtendanceController::class, 'create'])->name('attendance.create');
    Route::post('/attendance', [AtendanceController::class, 'store'])->name('attendance.store');
    Route::get('/attendance/download', [AtendanceController::class, 'download'])->name('attendance.download');

    // maintenance
    Route::get('/maintenance', [MaintenanceController::class, 'index'])->name('maintenance');
    Route::get('/maintenance/create', [MaintenanceController::class, 'create'])->name('maintenance.create');
    Route::post('/maintenance/store', [MaintenanceController::class, 'store'])->name('maintenance.store');
    Route::get('/maintenance/edit/{m}', [MaintenanceController::class, 'edit'])->name('maintenance.edit');
    Route::put('/maintenance/update/{id}', [MaintenanceController::class, 'update'])->name('maintenance.update');
    Route::get('/maintenance/{id}', [MaintenanceController::class, 'getMaintenanceById'])->name('maintenance.show');
    Route::delete('/maintenance/{id}', [MaintenanceController::class, 'destroy'])->name('maintenance.destroy');

    //check list
    Route::post('/check_list/store-item', [ChechListController::class, 'storeItems'])->name('check_list.store-item');
    Route::get('/check_list', [ChechListController::class, 'index'])->name('check_list.index');
    Route::get('/chech_list/create/{user_id}/{qua_id}', [ChechListController::class, 'create'])->name('check_list.create');
    Route::get('/chech_list/get/single/{user_id}/{qua_id}', [ChechListController::class, 'getList'])->name('check_list.list');
    Route::post('/check_list/store', [ChechListController::class, 'storeList'])->name('check_list.store');
    Route::get('/chech_list/get-items', [ChechListController::class, 'getItems'])->name('check_list.get-items');
    Route::post('/check_list/store-note', [ChechListController::class, 'addNote'])->name('check_list.store-note');
    Route::put('/check_list/update-list/{id}', [ChechListController::class, 'updateList'])->name('check_list.update-list');
    Route::delete('/check_list/delete/{id}', [ChechListController::class, 'delete'])->name('check_list.delete-item');


});
