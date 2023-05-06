<?php

use App\Http\Controllers\backend\QuestionController;
use App\Http\Controllers\backend\BackendmenuController;
use App\Http\Controllers\backend\AdminController;
use App\Http\Controllers\backend\AdminusersController;
use App\Http\Controllers\backend\RolesController;
use App\Http\Controllers\backend\FeedbacksController;

use App\Http\Controllers\backend\BackendsubmenuController;
use App\Http\Controllers\backend\ReportController;
use App\Http\Controllers\frontend\StepformController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('backend.admin.dashboard');
// })->name('admin.dashboard');




Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    // return what you want
});
//Clear configurations:
			Route::get('/config-clear', function() {
				$status = Artisan::call('config:clear');
				return '<h1>Configurations cleared</h1>';
			});

//Clear cache:
			Route::get('/cache-clear', function() {
				$status = Artisan::call('cache:clear');
				return '<h1>Cache cleared</h1>';
			});

//Clear configuration cache:
			Route::get('/config-cache', function() {
				$status = Artisan::call('config:cache');
				return '<h1>Configurations cache cleared</h1>';
			});

			//Clear route cache:
			Route::get('/route-cache', function() {
				$status = Artisan::call('route:cache');
				return '<h1>Route cache cleared</h1>';
			});

//Clear view cache:
			Route::get('/view-clear', function() {
				$status = Artisan::call('view:clear');
				return '<h1>View cache cleared</h1>';
			});

//dump autoload:
			Route::get('/dump-autoload', function() {
				$status = Artisan::call('dump-autoload');
				return '<h1>Dumped Autoload</h1>';
			});











Route::group(['prefix' => 'admin'], function () {
    Route::group(['middleware' => 'admin.guest'], function () {
        Route::get('/login', [AdminController::class,'showLoginForm'])->name('admin.login');
        Route::post('/login', [AdminController::class,'login'])->name('admin.login.submit');
	});
	
	Route::group(['middleware' => 'admin.auth'], function(){
      Route::get('/', [AdminController::class,'index'])->name('admin.dashboard');
	  route::get('/logout',[AdminController::class,'logout'])->name('admin.logout');


      //admin user
      Route::get('/adminusers', [AdminusersController::class,'index'])->name('admin.adminusers');
      Route::get('/adminusers/create', [AdminusersController::class,'create'])->name('admin.adminusers.create');
      Route::post('/adminusers/store', [AdminusersController::class,'store'])->name('admin.adminusers.store');
      Route::get('/adminusers/edit/{id}', [AdminusersController::class,'edit'])->name('admin.adminusers.edit');
      Route::post('/adminusers/update', [AdminusersController::class,'update'])->name('admin.adminusers.update');
      Route::get('/adminusers/delete/{id}', [AdminusersController::class,'destroy'])->name('admin.adminusers.delete');
      Route::get('/adminusers/view/{id}', [AdminusersController::class,'show'])->name('admin.adminusers.view');
      Route::get('/adminusers/editstatus/{id}', [AdminusersController::class,'editstatus'])->name('admin.adminusers.editstatus');
      Route::post('/adminusers/updatestatus', [AdminusersController::class,'updatestatus'])->name('admin.adminusers.updatestatus');
      Route::resource('admin/adminusers', 'AdminusersController');
      
      //backend menubar
      Route::get('/backendmenu', [BackendmenuController::class,'index'])->name('admin.backendmenu');
      Route::get('/backendmenu/create', [BackendmenuController::class,'create'])->name('admin.backendmenu.create');
      Route::post('/backendmenu/store', [BackendmenuController::class,'store'])->name('admin.backendmenu.store');
      Route::get('/backendmenu/edit/{id}', [BackendmenuController::class,'edit'])->name('admin.backendmenu.edit');
      Route::post('/backendmenu/update', [BackendmenuController::class,'update'])->name('admin.backendmenu.update');
      Route::get('/backendmenu/delete/{id}', [BackendmenuController::class,'destroy'])->name('admin.backendmenu.delete');
      Route::get('/backendmenu/view/{id}', [BackendmenuController::class,'show'])->name('admin.backendmenu.view');
      Route::resource('admin/backendmenu', 'BackendmenuController');
    
      //backend submenubar
      Route::get('/backendsubmenu', [BackendsubmenuController::class,'index'])->name('admin.backendsubmenu');
      Route::get('/backendsubmenu/menu/{menu_id}', [BackendsubmenuController::class,'menu'])->name('admin.backendsubmenu.menu');
      Route::get('/backendsubmenu/create/{menu_id?}', [BackendsubmenuController::class,'create'])->name('admin.backendsubmenu.create');
      Route::post('/backendsubmenu/store', [BackendsubmenuController::class,'store'])->name('admin.backendsubmenu.store');
      Route::get('/backendsubmenu/edit/{id}', [BackendsubmenuController::class,'edit'])->name('admin.backendsubmenu.edit');
      Route::post('/backendsubmenu/update', [BackendsubmenuController::class,'update'])->name('admin.backendsubmenu.update');
      Route::get('/backendsubmenu/delete/{id}', [BackendsubmenuController::class,'destroy'])->name('admin.backendsubmenu.delete');
      Route::get('/backendsubmenu/view/{id}', [BackendsubmenuController::class,'show'])->name('admin.backendsubmenu.view');
      Route::resource('admin/backendsubmenu', 'BackendsubmenuController');

      //roles
      Route::get('/roles', [RolesController::class,'index'])->name('admin.roles');
      Route::get('/roles/create', [RolesController::class,'create'])->name('admin.roles.create');
      Route::post('/roles/store', [RolesController::class,'store'])->name('admin.roles.store');
      Route::get('/roles/edit/{id}', [RolesController::class,'edit'])->name('admin.roles.edit');
      Route::post('/roles/update', [RolesController::class,'update'])->name('admin.roles.update');
      Route::get('/roles/delete/{id}', [RolesController::class,'destroy'])->name('admin.roles.delete');
      Route::get('/roles/view/{id}', [RolesController::class,'show'])->name('admin.roles.view');
      Route::resource('admin/roles', 'RolesController');
    

      Route::get('/littlesubmenu', [RolesController::class,'little'])->name('admin.littlesubmenu');


      //step form
      Route::get('/question/view', [QuestionController::class, 'index'])->name('admin.index');
      Route::get('/question/create', [QuestionController::class, 'create'])->name('admin.survey.question');
      Route::post('/question/store', [QuestionController::class, 'store'])->name('admin.store.question');
      Route::get('/question/edit/{question_id}', [QuestionController::class, 'edit'])->name('admin.edit.question');
      Route::post('/question/update', [QuestionController::class, 'update'])->name('question.update');
      Route::get('/question/delete/{question_id}', [QuestionController::class, 'delete'])->name('delete.question');

      Route::get('/feedbacks', [FeedbacksController::class, 'index'])->name('admin.feedbacks');
      Route::get('/feedbacks/view/{id}', [FeedbacksController::class, 'view'])->name('admin.feedbacks.view');
    //   Route::get('/feedbacks/delete/{feedback_id}', [FeedbacksController::class, 'delete'])->name('admin.feedbacks.delete');


     //reports
     Route::get('reports', [ReportController::class, 'index'])->name('admin.reports');
    //  Route::post('reports/test', [ReportController::class, 'test'])->name('admin.test');


    });
});
      //forntend routes
      //step form
      Route::get('/stepform', [StepformController::class, 'index'])->name('stepform.index');
      Route::post('/stepdata', [StepformController::class, 'stepdata'])->name('stepform.stepdata');
      Route::post('/stepform/store', [StepformController::class, 'store'])->name('stepform.stepform.store');

