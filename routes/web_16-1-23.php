<?php

use App\Http\Controllers\backend\QuestionController;
use App\Http\Controllers\backend\BackendmenuController;
use App\Http\Controllers\backend\AdminController;
use App\Http\Controllers\backend\AdminusersController;
use App\Http\Controllers\backend\RolesController;
use App\Http\Controllers\backend\CustomersController;
use App\Http\Controllers\backend\BackendsubmenuController;
use App\Http\Controllers\backend\ProductController;
use App\Http\Controllers\backend\FinancialyearController;
use App\Http\Controllers\backend\CompanyController;
use App\Http\Controllers\backend\PurchasebillController;
use App\Http\Controllers\backend\StateController;
use App\Http\Controllers\backend\SupplierController;
use App\Http\Controllers\backend\Taxcontroller;
use App\Http\Controllers\backend\VehicleController;
use App\Http\Controllers\backend\VechlemakeController;
use App\Http\Controllers\backend\VehiclemodalController;
use App\Models\backend\State;
use App\Models\backend\VehicleMake;
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
      Route::get('/question/create', [QuestionController::class, 'create'])->name('admin.survey.question');
      Route::post('/question/store', [QuestionController::class, 'store'])->name('admin.store.question');
    //   route::post('/question/store', [QuestionController::class, 'store'])->name('admin.store.question');
      route::get('/question/view', [QuestionController::class, 'index'])->name('admin.index');
      route::get('/question/edit/{question_id}', [QuestionController::class, 'edit'])->name('edit.question');
      route::post('/question/update/{question_id}', [QuestionController::class, 'update'])->name('question.update');
      route::get('/question/delete/{question_id}', [QuestionController::class, 'delete'])->name('delete.question');

      route::post('/stepform', [QuestionController::class, 'stepform']);


      //products
      Route::get('/products', [ProductController::class, 'index'])->name('admin.products');
      Route::get('/products/create', [ProductController::class, 'create'])->name('admin.products.create');
      Route::post('/products/store', [ProductController::class, 'store'])->name('admin.products.store');
      Route::get('/products/edit/{id}', [ProductController::class,'edit'])->name('admin.products.edit');
      Route::post('/products/update', [ProductController::class,'update'])->name('admin.products.update');
      Route::get('/products/delete/{id}', [ProductController::class,'delete'])->name('admin.products.delete');
      Route::resource('admin/products', 'ProductController');
      

      //tax
      Route::get('/tax', [Taxcontroller::class, 'index'])->name('admin.tax');
      Route::get('/tax/create', [Taxcontroller::class, 'create'])->name('admin.tax.create');
      Route::post('/tax/store', [Taxcontroller::class, 'store'])->name('admin.tax.store');
      Route::get('/tax/edit/{id}', [Taxcontroller::class,'edit'])->name('admin.tax.edit');
      Route::post('/tax/update', [Taxcontroller::class,'update'])->name('admin.tax.update');
      Route::get('/tax/delete/{id}', [Taxcontroller::class,'delete'])->name('admin.tax.delete');
      Route::resource('admin/tax', 'Taxcontroller');
      

      //financial year
      Route::get('/financial/year', [FinancialyearController::class, 'index'])->name('admin.financial.year');
      Route::get('/financial/year/create', [FinancialyearController::class, 'create'])->name('admin.financialyear.create');
      Route::post('/financial/year/store', [FinancialyearController::class, 'store'])->name('admin.financialyear.store');
      Route::get('/financial/year/edit/{id}', [FinancialyearController::class,'edit'])->name('admin.financialyear.edit');
      Route::post('/financial/year/update', [FinancialyearController::class,'update'])->name('admin.financialyear.update');
      Route::get('/financial/year/delete/{id}', [FinancialyearController::class,'delete'])->name('admin.financialyear.delete');
      Route::resource('admin/financial/year/', 'FinancialyearController');


      //costomers
      Route::get('/customer', [CustomersController::class, 'index'])->name('admin.customers');
      Route::get('/customer/create', [CustomersController::class, 'create'])->name('admin.Customers.create');
      Route::post('/customer/store', [CustomersController::class, 'store'])->name('admin.Customers.store');
      Route::get('/customer/edit/{id}', [CustomersController::class,'edit'])->name('admin.Customers.edit');
      Route::post('/customer/update', [CustomersController::class,'update'])->name('admin.Customers.update');
      Route::get('/customer/delete/{id}', [CustomersController::class,'delete'])->name('admin.Customers.delete');
      Route::resource('admin/customer/', 'CustomersController');


      //vechlemake 
      Route::get('/vehiclemake', [VechlemakeController::class, 'index'])->name('admin.vehiclemake');
      Route::get('/vehiclemake/create', [VechlemakeController::class, 'create'])->name('admin.vehiclemake.create');
      Route::post('/vehiclemake/store', [VechlemakeController::class, 'store'])->name('admin.vehiclemake.store');
      Route::get('/vehiclemake/edit/{id}', [VechlemakeController::class,'edit'])->name('admin.vehiclemake.edit');
      Route::post('/vehiclemake/update', [VechlemakeController::class, 'update'])->name('admin.vehiclemake.update');
      Route::get('/vehiclemake/delete/{id}', [VechlemakeController::class,'delete'])->name('admin.vehiclemake.delete');
      Route::resource('admin/vehiclemake/', 'VechlemakeController');
 

      //vechlemodel
      Route::get('/vehiclemodel', [VehiclemodalController::class, 'index'])->name('admin.vehiclemodel');
      Route::get('/vehiclemodel/create', [VehiclemodalController::class, 'create'])->name('admin.vehiclemodel.create');
      Route::post('/vehiclemodel/store', [VehiclemodalController::class, 'store'])->name('admin.vehiclemodel.store');
      Route::get('/vehiclemodel/edit/{id}', [VehiclemodalController::class,'edit'])->name('admin.vehiclemodel.edit');
      Route::post('/vehiclemodel/update', [VehiclemodalController::class, 'update'])->name('admin.vehiclemodel.update');
      Route::get('/vehiclemodel/delete/{id}', [VehiclemodalController::class,'delete'])->name('admin.vehiclemodel.delete');
      Route::resource('admin/vehiclemodel/', 'VehiclemodalController');


      //vehicle error in edit page
      Route::get('/vehicle', [VehicleController::class, 'index'])->name('admin.vehicle');
      Route::get('/vehicle/create', [VehicleController::class, 'create'])->name('admin.vehicle.create');
      Route::post('/vehicle/store', [VehicleController::class, 'store'])->name('admin.vehicle.store');
      Route::get('/vehicle/edit/{id}', [VehicleController::class,'edit'])->name('admin.vehicle.edit');
      Route::post('/vehicle/update', [VehicleController::class,'update'])->name('admin.vehicle.update');
      Route::get('/vehicle/delete/{id}', [VehicleController::class,'delete'])->name('admin.vehicle.delete');
      Route::resource('admin/vehicle/', 'VehicleController');


      //company problem in file uploading with all data
      Route::get('/company', [CompanyController::class, 'index'])->name('admin.company');
      Route::get('/company/create', [CompanyController::class, 'create'])->name('admin.company.create');
      Route::post('/company/store', [CompanyController::class, 'store'])->name('admin.company.store');
      Route::get('/company/edit/{id}', [CompanyController::class,'edit'])->name('admin.company.edit');
      Route::post('/company/update', [CompanyController::class,'update'])->name('admin.company.update');
      Route::get('/company/delete/{id}', [CompanyController::class,'delete'])->name('admin.company.delete');
      Route::resource('admin/company/', 'CompanyController');


      //supplier problem in Vat No Not Storing Vat Number In Database
      Route::get('/supplier', [SupplierController::class, 'index'])->name('admin.supplier');
      Route::get('/supplier/create', [SupplierController::class, 'create'])->name('admin.supplier.create');
      Route::post('/supplier/store', [SupplierController::class, 'store'])->name('admin.supplier.store');
      Route::get('/supplier/edit/{id}', [SupplierController::class,'edit'])->name('admin.supplier.edit');
      Route::post('/supplier/update', [SupplierController::class,'update'])->name('admin.supplier.update');
      Route::get('/supplier/delete/{id}', [SupplierController::class,'delete'])->name('admin.supplier.delete');
      Route::resource('admin/supplier/', 'SupplierController');


      //state
      Route::get('/state', [StateController::class, 'index'])->name('admin.state');
      Route::get('/state/create', [StateController::class, 'create'])->name('admin.state.create');
      Route::post('/state/store', [StateController::class, 'store'])->name('admin.state.store');
      Route::get('/state/edit/{id}', [StateController::class,'edit'])->name('admin.state.edit');
      Route::post('/state/update', [StateController::class,'update'])->name('admin.state.update');
      Route::get('/state/delete/{id}', [StateController::class,'delete'])->name('admin.state.delete');
      Route::resource('admin/state/', 'StateController');


      //Purchase bill
      Route::get('/purchase/bill', [PurchasebillController::class, 'index'])->name('admin.purchase.bill');
      Route::get('/purchase/bill/create', [PurchasebillController::class, 'create'])->name('admin.purchasebill.create');
      //2 ajax routes
      Route::post('/purchase/bill/suppllierdetails/', [PurchasebillController::class, 'details'])->name('admin.purchasebill.details');
      Route::post('/purchase/bill/companydetails/', [PurchasebillController::class, 'companydetails'])->name('admin.purchasebill.companydetails');
      

      Route::post('/purchase/bill/store', [PurchasebillController::class, 'store'])->name('admin.purchasebbill.store');
      Route::get('/purchase/bill/edit/{id}', [PurchasebillController::class,'edit'])->name('admin.purchasebbill.edit');
      Route::post('/purchase/bill/update', [PurchasebillController::class,'update'])->name('admin.purchasebbill.update');
      Route::get('/purchase/bill/delete/{id}', [PurchasebillController::class,'delete'])->name('admin.purchasebill.delete');
      Route::resource('admin/purchase/bill/', 'PurchasebillController');

    });
});


// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
