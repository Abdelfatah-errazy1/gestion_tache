<?php

use App\Http\Controllers\AttachmentController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ContraintController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PrerequisController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TacheController;
use App\Http\Controllers\TaskCategoryController;
use App\Http\Controllers\TaskTagController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;





/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function(){
    if(Auth::check()){

        if(auth()->user()->is_admin){
            return redirect(route('taches.index'));
        }else{
            return redirect(route('taches.user',auth()->user()->id));
        }
    }else{
        return redirect(route('auth.login'));
    }
});

Route::name('auth.')->prefix('auth')->controller(LoginController::class)->group(function(){
    Route::get('/login','login')->name('login');
    Route::post('/login','store')->name('session');
    Route::get('/logout','logout')->name('logout');
});
Route::post('/taches/{tache}/assign', [TacheController::class, 'assign'])->name('taches.assign');
Route::get('/taches/overdue', [TacheController::class, 'overdue'])->name('taches.overdue');

Route::post('/taches/{id}/update-progress', [TacheController::class, 'updateProgress'])->name('taches.updateProgress');
Route::PUT('/taches/{id}/mark-complete', [TacheController::class, 'markComplete'])->name('taches.markComplete');

Route::post('/taches/{id}/comment', [TacheController::class, 'comment'])->name('taches.comment');
Route::post('/taches/{id}/feedback', [TacheController::class, 'feedback'])->name('taches.feedback');
Route::middleware('auth')->name('taches.')->prefix('taches')->controller(TacheController::class)->group(function(){
    Route::get('/','index')->name('index');
    Route::get('/show/{id}','show')->name('show');
    Route::get('/user/{id}/taches','userTaches')->name('user');

    Route::middleware('admin')->group(function(){
        Route::get('/create','create')->name('create');
        Route::get('/edit/{id}','edit')->name('edit');
        Route::post('/store','store')->name('store');
        Route::put('/update/{id}','update')->name('update');
        Route::get('/delete/{id}','delete')->name('delete');
        Route::get('/complete/{id}','complete')->name('complete');
        Route::post('/affecter/{id}','affecter')->name('affecter');
    });
    
});
Route::middleware(['auth','admin'] )->name('contraints.')->prefix('contraints')->controller(ContraintController::class)->group(function(){
    Route::get('/','index')->name('index');
    Route::get('/create','create')->name('create');
    Route::get('/edit/{id}','edit')->name('edit');
    Route::post('/store','store')->name('store');
    Route::put('/update/{id}','update')->name('update');
    Route::get('/delete/{id}','delete')->name('delete');
});
Route::middleware(['auth','admin'] )->name('prerequis.')->prefix('prerequis')->controller(PrerequisController::class)->group(function(){
    Route::get('/','index')->name('index');
    Route::get('/create','create')->name('create');
    Route::get('/edit/{id}','edit')->name('edit');
    Route::post('/store','store')->name('store');
    Route::put('/update/{id}','update')->name('update');
    Route::get('/delete/{id}','delete')->name('delete');
});
Route::middleware(['auth','admin'] )->name('category.')->prefix('category')->controller(TaskCategoryController::class)->group(function(){
    Route::get('/','index')->name('index');
    Route::get('/create','create')->name('create');
    Route::get('/edit/{id}','edit')->name('edit');
    Route::post('/store','store')->name('store');
    Route::put('/update/{id}','update')->name('update');
    Route::get('/delete/{id}','destroy')->name('delete');
});
Route::middleware(['auth','admin'] )->name('tag.')->prefix('tag')->controller(TaskTagController::class)->group(function(){
    Route::get('/','index')->name('index');
    Route::get('/create','create')->name('create');
    Route::get('/edit/{id}','edit')->name('edit');
    Route::post('/store','store')->name('store');
    Route::put('/update/{id}','update')->name('update');
    Route::get('/delete/{id}','destroy')->name('delete');
});
Route::middleware(['auth','admin'] )->name('roles.')->prefix('roles')->controller(RoleController::class)->group(function(){
    Route::get('/','index')->name('index');
    Route::get('/create','create')->name('create');
    Route::get('/edit/{id}','edit')->name('edit');
    Route::post('/store','store')->name('store');
    Route::put('/update/{id}','update')->name('update');
    Route::get('/delete/{id}','destroy')->name('delete');
});
Route::middleware(['auth','admin'] )->name('projects.')->prefix('projects')->controller(ProjectController::class)->group(function(){
    Route::get('/','index')->name('index');
    Route::get('/create','create')->name('create');
    Route::get('/edit/{id}','edit')->name('edit');
    Route::post('/store','store')->name('store');
    Route::put('/update/{id}','update')->name('update');
    Route::get('/delete/{id}','destroy')->name('delete');
});
Route::middleware(['auth' ])->group(function () {
    Route::resource('users', UserController::class);
    Route::get('/admin/dashboard', [DashboardController::class, 'adminDashboard'])->name('admin.dashboard');

});


Route::middleware(['auth'])->group(function () {
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::post('/notifications/{id}/mark-read', [NotificationController::class, 'markRead'])->name('notifications.markRead');
    Route::post('/notifications/mark-all-read', [NotificationController::class, 'markAllRead'])->name('notifications.markAllAsRead');
});

Route::post('/taches/{tache}/attachments', [AttachmentController::class, 'store'])->name('attachments.store');
Route::get('/attachments/{id}/download', [AttachmentController::class, 'download'])->name('attachments.download');
Route::delete('/attachments/{id}', [AttachmentController::class, 'destroy'])->name('attachments.destroy');
Route::get('test', function () {
    return view('components.test');
});