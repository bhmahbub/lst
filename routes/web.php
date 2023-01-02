<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\CasesController;
use App\Http\Controllers\Admin\causelistController;
use App\Http\Controllers\frontendController;
use App\Http\Controllers\User\casesByUserController;

use App\Models\cases;
use App\Models\data;
use App\Models\cl_date;

Route::get('/', [frontendController::class, 'index'])->name('homepage');
Route::get('/causelist', [frontendController::class, 'causelist'])->name('causelist');
Route::post('/causelist', [frontendController::class, 'search_causelist']);
Route::post('/details', [frontendController::class, 'details'])->name('details');
Route::get('/detailOrder', [frontendController::class, 'detail_Order'])->name('detailOrder');
Route::post('/detailOrder', [frontendController::class, 'detailOrder']);
// Route::get('/caseno', [frontendController::class, 'caseno'])->name('caseno');

Route::get('/download/{pdf}',[causelistController::class,'download']);

Route::get('/viewpdf/{id}',[causelistController::class,'viewpdf']);


// Route::post('/details', function () {
//     return view('details');
// })->name('details');



// Route::get('/', function () {
//     $users = DB::table('users')->select('id','name','email')->get();
//     return view('VIEW-NAME-HERE', compact('users'));
// });


Route::group(['middleware' => 'auth'], function() {

    Route::get('/dashboard', [casesByUserController::class, 'index'])->name('dashboard');
    Route::post('/dashboard', [casesByUserController::class, 'store'])->name('dashboard.store');

});


require __DIR__.'/auth.php';


Route::get('/admin/login', [AuthenticatedSessionController::class, 'create'])->name('admin.login')->middleware('guest:admin');

Route::post('/admin/login/store', [AuthenticatedSessionController::class, 'store'])->name('admin.login.store');

Route::group(['middleware' => 'admin'], function() {

    Route::get('/admin', [HomeController::class, 'index'])->name('admin.dashboard');

    Route::post('/admin/logout', [AuthenticatedSessionController::class, 'destroy'])->name('admin.logout');
// cases routes
    Route::resource('/admin/cases', CasesController::class);
    Route::get('/admin/allcases', [CasesController::class, 'allcases'])->name('admin.allcases');



    Route::get('/admin/all', [CasesController::class, 'all'])->name('admin.all');
    Route::get('/admin/alldis', [CasesController::class, 'alldis'])->name('admin.alldis');


    Route::get('/admin/all-cases', [CasesController::class, 'all_cases'])->name('admin.all-cases');
    Route::get('/admin/alldisposed', [CasesController::class, 'alldisposed'])->name('admin.alldisposed');


// causelist routes
    // causelist add
    Route::get('/admin/causelist', [causelistController::class, 'index'])->name('admin.causelist');
    Route::post('/admin/causelist', [causelistController::class, 'store'])->name('causelist.store');


    // date-wise causelist
    Route::get('/admin/causelistOf', [causelistController::class, 'view'])->name('causelistOf');
    Route::post('/admin/causelistOf', [causelistController::class, 'view_search']);


    // causelist update-page view (search wise)
    Route::get('/admin/causelist-update', [causelistController::class, 'update_view_search'])->name('causelist-update');


    // causelist update-page (update record)
    Route::post('admin/causelist-update', [causelistController::class, 'updateAction'])->name('causelistUpdate.action');


    // causelist update-pending
    Route::get('/admin/causelist-pending', [causelistController::class, 'pending'])->name('causelist-pending');


    // manage-disposed
    Route::get('/admin/manage-disposed', [causelistController::class, 'disposedList'])->name('manage-disposed');
    // updare-disposed
    Route::put('admin/manage-disposed', [causelistController::class, 'disposalupdateAction'])->name('disposalUpdate.action');


});



