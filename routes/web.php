<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{


    AttachmentController,
    Auth\LoginController,
    ContraintController,
    DashboardController,
    NotificationController,
    PrerequisController,
    ProjectController,
    RoleController,
    TacheController,
    TaskCategoryController,
    TaskTagController,
    UserController
};

// Default redirection
Route::get('/', function () {
    if (Auth::check()) {
        return auth()->user()->is_admin 
            ? redirect(route('taches.index')) 
            : redirect(route('taches.user', auth()->user()->id));
    }
    return redirect(route('auth.login'));
});

// Auth Routes
Route::prefix('auth')->name('auth.')->controller(LoginController::class)->group(function () {
    Route::get('/login', 'login')->name('login');
    Route::post('/login', 'store')->name('session');
    Route::get('/logout', 'logout')->name('logout');
});

// Grouped under auth middleware
Route::middleware('auth')->group(function () {

    // Dashboard & Users
    Route::get('/admin/dashboard', [DashboardController::class, 'adminDashboard'])->name('admin.dashboard');
    Route::resource('users', UserController::class);

    // Notifications
    Route::prefix('notifications')->name('notifications.')->controller(NotificationController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/{id}/mark-read', 'markRead')->name('markRead');
        Route::post('/mark-all-read', 'markAllRead')->name('markAllAsRead');
    });

    // Attachments
    Route::prefix('attachments')->name('attachments.')->controller(AttachmentController::class)->group(function () {
        Route::post('/taches/{tache}', 'store')->name('store');
        Route::get('/{id}/download', 'download')->name('download');
        Route::delete('/{id}', 'destroy')->name('destroy');
    });

    Route::get('/calendar', [TacheController::class, 'calendarView'])->name('taches.calendar');
    Route::get('/calendar/events', [TacheController::class, 'calendarEvents'])->name('calendar.events');


    // Taches (Tasks)
    Route::prefix('taches')->name('taches.')->controller(TacheController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/show/{id}', 'show')->name('show');
        Route::get('/user/{id}/taches', 'userTaches')->name('user');

        Route::post('/{id}/update-progress', 'updateProgress')->name('updateProgress');
        Route::put('/{id}/mark-complete', 'markComplete')->name('markComplete');
        Route::post('/{id}/comment', 'comment')->name('comment');
        Route::post('/{id}/feedback', 'feedback')->name('feedback');
        Route::post('/{tache}/assign', 'assign')->name('assign');
        Route::get('/overdue', 'overdue')->name('overdue');
        Route::get('/overdue/{id}/user', 'overdueUser')->name('user.overdue');

        Route::middleware('admin')->group(function () {
            Route::get('/create', 'create')->name('create');
            Route::get('/edit/{id}', 'edit')->name('edit');
            Route::post('/store', 'store')->name('store');
            Route::put('/update/{id}', 'update')->name('update');
            Route::get('/delete/{id}', 'delete')->name('delete');
            Route::get('/complete/{id}', 'complete')->name('complete');
            Route::post('/affecter/{id}', 'affecter')->name('affecter');
        });
    });
    Route::get('/projects/{id}/tasks', [ProjectController::class, 'getTasks'])->name('projects.tasks');


    // Admin-Only Controllers
    Route::middleware('admin')->group(function () {

        // Contraints
        Route::prefix('contraints')->name('contraints.')->controller(ContraintController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::get('/edit/{id}', 'edit')->name('edit');
            Route::post('/store', 'store')->name('store');
            Route::put('/update/{id}', 'update')->name('update');
            Route::get('/delete/{id}', 'delete')->name('delete');
        });

        // Prerequis
        Route::prefix('prerequis')->name('prerequis.')->controller(PrerequisController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::get('/edit/{id}', 'edit')->name('edit');
            Route::post('/store', 'store')->name('store');
            Route::put('/update/{id}', 'update')->name('update');
            Route::get('/delete/{id}', 'delete')->name('delete');
        });

        // Task Categories
        Route::prefix('category')->name('category.')->controller(TaskCategoryController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::get('/edit/{id}', 'edit')->name('edit');
            Route::post('/store', 'store')->name('store');
            Route::put('/update/{id}', 'update')->name('update');
            Route::get('/delete/{id}', 'destroy')->name('delete');
        });

        // Task Tags
        Route::prefix('tag')->name('tag.')->controller(TaskTagController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::get('/edit/{id}', 'edit')->name('edit');
            Route::post('/store', 'store')->name('store');
            Route::put('/update/{id}', 'update')->name('update');
            Route::get('/delete/{id}', 'destroy')->name('delete');
        });

        // Roles
        Route::prefix('roles')->name('roles.')->controller(RoleController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::get('/edit/{id}', 'edit')->name('edit');
            Route::post('/store', 'store')->name('store');
            Route::put('/update/{id}', 'update')->name('update');
            Route::get('/delete/{id}', 'destroy')->name('delete');
        });

        // Projects
        Route::prefix('projects')->name('projects.')->controller(ProjectController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::get('/edit/{id}', 'edit')->name('edit');
            Route::post('/store', 'store')->name('store');
            Route::put('/update/{id}', 'update')->name('update');
            Route::get('/delete/{id}', 'destroy')->name('delete');
        });
    });

});


// Test route
Route::get('test', fn() => view('components.test'));
