<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\backend\AdminController;
use App\Http\Controllers\backend\AccountController;
use App\Http\Controllers\backend\PermissionController;
use App\Http\Controllers\backend\BackendmenuController;
use App\Http\Controllers\backend\BackendsubmenuController;
use App\Http\Controllers\backend\AdminusersController;
use App\Http\Controllers\backend\RolesController;
use App\Http\Controllers\backend\ExternalusersController;
use App\Http\Controllers\backend\InternalUsersController;
use App\Http\Controllers\backend\BussinessParatnerController;
use App\Http\Controllers\backend\SchoolController;
use App\Http\Controllers\backend\YearController;
use App\Http\Controllers\backend\CategoriesController;
use App\Http\Controllers\backend\SubCategoriesController;
use App\Http\Controllers\backend\SubCategorydetailsController;
use App\Http\Controllers\backend\MarketingBudgetController;
use App\Http\Controllers\backend\CategoryBudgetController;
use App\Http\Controllers\backend\ExpenseController;
use App\Http\Controllers\backend\ReportsController;
use App\Http\Controllers\backend\ImportController;
use App\Http\Controllers\backend\LeadsController;
use App\Http\Controllers\backend\LogController;
use App\Models\backend\AdminUsers;
use App\Http\Controllers\backend\FrgtpassController;

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
//     return view('welcome');
// });

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


// Route::get('/', 'HomeController@index');
// Route::get('/', function(){
//     return view('welcome');
// } );

Route::get('/', [AccountController::class,'showLoginForm'])->name('admin.login' );


Route::prefix('admin')->group(function () {

  Route::group(['middleware'=>'admin.guest'],function (){
    Route::get('/login', [AccountController::class,'showLoginForm'])->name('admin.login');
    Route::post('/login', [AccountController::class,'login'])->name('admin.login.submit');
  });



  Route::group(['middleware'=>'admin.auth'], function () {
  // Route::get('/', [AdminController::class,'index'])->name('admin');
  Route::get('/', [AdminController::class,'index'])->name('admin.dashboard');
  Route::get('/profile', [AdminController::class,'myProfile'])->name('admin.profile');
  Route::post('/update_profile', [AdminController::class,'updateProfile'])->name('admin.update_profile');
  Route::get('/changepassword', [AdminController::class,'changePassword'])->name('admin.change_password');
  Route::post('/updatepassword', [AdminController::class,'updatePassword'])->name('admin.update_password');
  Route::get('/logout', [AccountController::class,'logout'])->name('admin.logout');
  Route::get('/permissions', [PermissionController::class,'index'])->name('admin.permissions');
  Route::get('/permissions/create', [PermissionController::class,'create'])->name('admin.permissions.create');
  Route::post('/permissions/store', [PermissionController::class,'store'])->name('admin.permissions.store');
  Route::get('/permissions/edit/{id}', [PermissionController::class,'edit'])->name('admin.permissions.edit');
  Route::post('/permissions/update', [PermissionController::class,'update'])->name('admin.permissions.update');
  Route::get('/permissions/delete/{id}', [PermissionController::class,'destroy'])->name('admin.permissions.delete');
  Route::resource('admin/permission', 'PermissionController');
  Route::get('/backendmenu', [BackendmenuController::class,'index'])->name('admin.backendmenu');
  Route::get('/backendmenu/create', [BackendmenuController::class,'create'])->name('admin.backendmenu.create');
  Route::post('/backendmenu/store', [BackendmenuController::class,'store'])->name('admin.backendmenu.store');
  Route::get('/backendmenu/edit/{id}', [BackendmenuController::class,'edit'])->name('admin.backendmenu.edit');
  Route::post('/backendmenu/update', [BackendmenuController::class,'update'])->name('admin.backendmenu.update');
  Route::get('/backendmenu/delete/{id}', [BackendmenuController::class,'destroy'])->name('admin.backendmenu.delete');
  Route::get('/backendmenu/view/{id}', [BackendmenuController::class,'show'])->name('admin.backendmenu.view');
  Route::resource('admin/backendmenu', 'BackendmenuController');
  Route::get('/backendsubmenu', [BackendsubmenuController::class,'index'])->name('admin.backendsubmenu');
  Route::get('/backendsubmenu/menu/{menu_id}', [BackendsubmenuController::class,'menu'])->name('admin.backendsubmenu.menu');
  Route::get('/backendsubmenu/create/{menu_id?}', [BackendsubmenuController::class,'create'])->name('admin.backendsubmenu.create');
  Route::post('/backendsubmenu/store', [BackendsubmenuController::class,'store'])->name('admin.backendsubmenu.store');
  Route::get('/backendsubmenu/edit/{id}', [BackendsubmenuController::class,'edit'])->name('admin.backendsubmenu.edit');
  Route::post('/backendsubmenu/update', [BackendsubmenuController::class,'update'])->name('admin.backendsubmenu.update');
  Route::get('/backendsubmenu/delete/{id}', [BackendsubmenuController::class,'destroy'])->name('admin.backendsubmenu.delete');
  Route::get('/backendsubmenu/view/{id}', [BackendsubmenuController::class,'show'])->name('admin.backendsubmenu.view');
  Route::resource('admin/backendsubmenu', 'BackendsubmenuController');

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

//admin.roles
Route::get('/roles', [RolesController::class,'index'])->name('admin.roles');
  Route::get('/roles/create', [RolesController::class,'create'])->name('admin.roles.create');
  Route::post('/roles/store', [RolesController::class,'store'])->name('admin.roles.store');
  Route::get('/roles/edit/{id}', [RolesController::class,'edit'])->name('admin.roles.edit');
  Route::post('/roles/update', [RolesController::class,'update'])->name('admin.roles.update');
  Route::get('/roles/delete/{id}', [RolesController::class,'destroy'])->name('admin.roles.delete');
  Route::get('/roles/view/{id}', [RolesController::class,'show'])->name('admin.roles.view');
  Route::resource('admin/roles', 'RolesController');

   //admin.internalusers  //September
  //Route::get('/internalusers', [InternalUsersController::class,'index'])->name('admin.internalusers');
  Route::get('/users', [AdminController::class, 'showusers'])->name('admin.users');
  Route::get('/create', [AdminController::class, 'create'])->name('admin.create');
  Route::post('/user/store', [AdminController::class, 'store'])->name('admin.store');
  Route::get('/user/delete/{id}', [AdminController::class, 'destroyUser'])->name('admin.user.delete');
  Route::get('/user/edit/{id}', [AdminController::class, 'edit'])->name('admin.user.edit');
  Route::post('/user/update', [AdminController::class, 'update'])->name('admin.user.update');
  Route::post('/user/status', [AdminController::class, 'updatestatus'])->name('admin.user.status');


  //admin external usrs

//   Route::get('/externalusers', [ExternalusersController::class,'index'])->name('admin.externalusers');
//   Route::get('/externalusers/create', [ExternalusersController::class,'create'])->name('admin.externalusers.create');
//   Route::post('/externalusers/store', [ExternalusersController::class,'store'])->name('admin.externalusers.store');
//   Route::get('/externalusers/edit/{id}', [ExternalusersController::class,'edit'])->name('admin.externalusers.edit');
//   Route::post('/externalusers/update', [ExternalusersController::class,'update'])->name('admin.externalusers.update');
//   Route::get('/externalusers/delete/{id}', [ExternalusersController::class,'destroy'])->name('admin.externalusers.delete');
//   Route::get('/externalusers/view/{id}', [ExternalusersController::class,'show'])->name('admin.externalusers.view');
//   Route::resource('admin/externalusers', 'ExternalusersController');
//   Route::get('/externalusers/editstatus/{id}', [ExternalusersController::class,'editstatus'])->name('admin.externalusers.editstatus');
// //   Route::post('/externalusers/updatestatus', [ExternalusersController::class,'updatestatus'])->name('admin.externalusers.updatestatus');




//   Route::get('/loginmanagement', [LoginmanagementController::class,'index'])->name('admin.loginmanagement');
//   Route::get('/loginmanagement/create', [LoginmanagementController::class,'create'])->name('admin.loginmanagement.create');
//   Route::post('/loginmanagement/store', [LoginmanagementController::class,'store'])->name('admin.loginmanagement.store');
//   Route::get('/loginmanagement/edit/{id}', [LoginmanagementController::class,'edit'])->name('admin.loginmanagement.edit');
//   Route::post('/loginmanagement/update', [LoginmanagementController::class,'update'])->name('admin.loginmanagement.update');
//   Route::get('/loginmanagement/delete/{id}', [LoginmanagementController::class,'destroy'])->name('admin.loginmanagement.delete');
//   Route::get('/loginmanagement/view/{id}', [LoginmanagementController::class,'show'])->name('admin.loginmanagement.view');
//   Route::resource('admin/loginmanagement', 'LoginmanagementController');

//   Route::get('/sitemanagement/up', [SitemanagementController::class,'up'])->name('admin.sitemanagement.up');//07-07-2022
//   Route::get('/sitemanagement/down', [SitemanagementController::class,'down'])->name('admin.sitemanagement.down');//07-07-2022


//   //roles Routes
//   Route::get('/roles', [RolesController::class,'index'])->name('admin.roles');
//   Route::get('/roles/create', [RolesController::class,'create'])->name('admin.roles.create');
//   Route::post('/roles/store', [RolesController::class,'store'])->name('admin.roles.store');
//   Route::get('/roles/edit/{id}', [RolesController::class,'edit'])->name('admin.roles.edit');
//   Route::post('/roles/update', [RolesController::class,'update'])->name('admin.roles.update');
//   Route::get('/roles/delete/{id}', [RolesController::class,'destroy'])->name('admin.roles.delete');
//   Route::get('/roles/view/{id}', [RolesController::class,'show'])->name('admin.roles.view');
//   Route::resource('admin/roles', 'RolesController');


//SEPETEMBER 12 SCHOOL MASTER
Route::get('/school', [SchoolController::class, 'index'])->name('admin.school');
Route::get('/school/create', [SchoolController::class, 'create'])->name('admin.school.create');
Route::post('/school/store', [SchoolController::class, 'store'])->name('admin.school.store');
Route::get('/school/edit/{id}', [SchoolController::class, 'edit'])->name('admin.school.edit');
Route::post('/school/update', [SchoolController::class, 'update'])->name('admin.school.update');
Route::get('/school/delete/{id}', [SchoolController::class, 'delete'])->name('admin.school.delete');

//Year Mastre
Route::get('/year', [YearController::class, 'index'])->name('admin.year');
Route::get('/year/create', [YearController::class, 'create'])->name('admin.year.create');
Route::post('/year/store', [YearController::class, 'store'])->name('admin.year.store');
Route::get('/year/edit/{id}', [YearController::class, 'edit'])->name('admin.year.edit');
Route::post('/year/update', [YearController::class, 'update'])->name('admin.year.update');
Route::get('/year/delete/{id}', [YearController::class, 'delete'])->name('admin.year.delete');

//Category
Route::get('/category', [CategoriesController::class, 'index'])->name('admin.category');
Route::get('/category/create', [CategoriesController::class, 'create'])->name('admin.category.create');
Route::post('/category/store', [CategoriesController::class, 'store'])->name('admin.category.store');
Route::get('/category/edit/{id}', [CategoriesController::class, 'edit'])->name('admin.category.edit');
Route::post('/category/update', [CategoriesController::class, 'update'])->name('admin.category.update');
Route::get('/category/delete/{id}', [CategoriesController::class, 'delete'])->name('admin.category.delete');

//Subcategory
Route::get('/subcategory/{id}', [SubCategoriesController::class, 'index'])->name('admin.subcategory');
Route::get('/subcategory/create/{id}', [SubCategoriesController::class, 'create'])->name('admin.subcategory.create');
Route::post('/subcategory/store', [SubCategoriesController::class, 'store'])->name('admin.subcategory.store');
Route::get('/subcategory/edit/{id}', [SubCategoriesController::class, 'edit'])->name('admin.subcategory.edit');
Route::post('/subcategory/update', [SubCategoriesController::class, 'update'])->name('admin.subcategory.update');
Route::get('/subcategory/delete/{id}', [SubCategoriesController::class, 'delete'])->name('admin.subcategory.delete');

 //Subcategory Details
 Route::get('/subcategorydetails/{id}', [SubCategorydetailsController::class, 'index'])->name('admin.subcategorydetails');
 Route::get('/subcategorydetails/create/{id}/{cat_id}', [SubCategorydetailsController::class, 'create'])->name('admin.subcategorydetails.create');
 Route::post('/subcategorydetails/store', [SubCategorydetailsController::class, 'store'])->name('admin.subcategorydetails.store');
 Route::get('/subcategorydetails/edit/{id}/{cat_id}/{sub_cat_id?}', [SubCategorydetailsController::class, 'edit'])->name('admin.subcategorydetails.edit');
 Route::post('/subcategorydetails/update', [SubCategorydetailsController::class, 'update'])->name('admin.subcategorydetails.update');
 Route::get('/subcategorydetails/delete/{id}', [SubCategorydetailsController::class, 'delete'])->name('admin.subcategorydetails.delete');

//marketing
 Route::get('/marketing',[MarketingBudgetController::class, 'index'])->name('admin.marketing');
 Route::get('/marketing/create',[MarketingBudgetController::class, 'index'])->name('admin.marketing.create');
 Route::post('/marketing/store',[MarketingBudgetController::class, 'store'])->name('admin.marketing.store');
 Route::post('/marketing/update',[MarketingBudgetController::class, 'update'])->name('admin.marketing.update');
 Route::get('/marketing/delete',[MarketingBudgetController::class, 'delete'])->name('admin.marketing.delete');

 //Import School Budget with category budget
Route::get('/marketing/school/import',[MarketingBudgetController::class, 'showimportform'])->name('admin.school.import');
Route::post('/marketing/import/budget',[MarketingBudgetController::class, 'import'])->name('admin.school.import.sheet');
Route::get('/marketing/school/manage',[MarketingBudgetController::class, 'showimportdata'])->name('admin.school.manageimports');

//delete imported data
Route::post('/budget/import/removedata',[MarketingBudgetController::class, 'destroy'])->name('admin.school.import.sheet');
Route::post('/budget/import/loaddata',[MarketingBudgetController::class, 'loaddata'])->name('admin.school.import.loaddata');

//Update Existing Marketing Budget
Route::post('/budget/import/update_exists',[MarketingBudgetController::class, 'update_import'])->name('admin.school.import.update');


//marketing Category Budget
Route::get('/marketing/category',[CategoryBudgetController::class, 'index'])->name('admin.marketing.category');
Route::get('/marketing/caregory/create',[CategoryBudgetController::class, 'index'])->name('admin.marketing.create');
Route::post('//marketing/caregory/store',[CategoryBudgetController::class, 'store'])->name('admin.marketing.store');
Route::post('/marketing/marketing/update',[CategoryBudgetController::class, 'update'])->name('admin.marketing.update');
Route::get('/marketing/category/delete',[CategoryBudgetController::class, 'delete'])->name('admin.marketing.category.delete');


//School Expences
Route::get('/expenses',[ExpenseController::class, 'index'])->name('admin.school.expenses');
Route::get('/expenses/create',[ExpenseController::class, 'create'])->name('admin.school.create.expenses');
Route::post('/expenses/store',[ExpenseController::class, 'store'])->name('admin.school.expenses.store');
Route::get('/expenses/edit/{id}',[ExpenseController::class, 'edit'])->name('admin.school.expenses.edit');
Route::post('/expenses/update',[ExpenseController::class, 'update'])->name('admin.school.expenses.update');
Route::get('/expenses/delete/{id}',[ExpenseController::class, 'delete'])->name('admin.school.expenses.delete');
Route::post('/expenses/get_school_budget',[ExpenseController::class, 'getbudget'])->name('admin.school.expenses.budget');

//send type (school / category)
Route::post('/expenses/get_school_type',[ExpenseController::class, 'getschooltype'])->name('admin.school.expenses.budget');



//Expence Ajax
Route::post('/ajax_get_subcat',[ExpenseController::class, 'getSubCategory'])->name('admin.ajax.getsubcategory');
Route::post('/ajax_get_subcat_details',[ExpenseController::class, 'getSubCatDetails'])->name('admin.ajax.subcategorydetails');
Route::post('/ajax_get_details_unit',[ExpenseController::class, 'getdetailsUnit'])->name('admin.ajax.detailsunits');
Route::post('/ajax_get_month',[ExpenseController::class, 'getMonth'])->name('admin.ajax.getMonth');

//ajax get Multiple  subcategory and category details
Route::post('/ajax_get_multiple_subcat',[ExpenseController::class, 'getMultipleSubCategory'])->name('admin.ajax.getsubcategory');
Route::post('/ajax_get_subcat_multiple_details',[ExpenseController::class, 'getMultipleSubCatDetails'])->name('admin.ajax.subcategorydetails');


//ajax change year
Route::post('/loginyear',[AccountController::class,'changeYear'])->name('admin.change.year');

//REPORTS  01/10/2022
Route::get('/reports',[ReportsController::class, 'index'])->name('admin.reports.index');
Route::get('/summaryreport',[ReportsController::class, 'summaryReport'])->name('admin.reports.summary');
Route::get('/budgetreport',[ReportsController::class, 'budgetReport'])->name('admin.reports.budget');

//Detail Report
Route::get('/marketing/report',[ReportsController::class, 'detailsReport'])->name('admin.reports.details');
Route::post('/marketing/getreport',[ReportsController::class, 'getdetailsReport'])->name('admin.reports.getdetails');
Route::get('/marketing/budgetsummary',[ReportsController::class, 'budgetsummaryReport'])->name('admin.budget.summary');





//Import Expenses
Route::get('/expenses/import',[ImportController::class, 'index'])->name('admin.expenses.import');
Route::post('/expenses/importdata',[ImportController::class, 'import'])->name('admin.expenses.importdata');
Route::get('/expenses/import/showbatch',[ImportController::class, 'showbatch'])->name('admin.import.remove');
Route::post('/expenses/import/loaddata',[ImportController::class, 'loaddata'])->name('admin.import.load');
Route::post('/expenses/import/removedata',[ImportController::class, 'destroy'])->name('admin.import.delete');

// Route::get('expenses/result', function(){
// return view('');
// });



//logs
Route::get('/logs',[LogController::class, 'index'])->name('admin.logs');
Route::get('/logs/user/logdetails',[LogController::class, 'userlogs'])->name('admin.user.logs');




//LeadSqured
Route::post('/leads/school',[AdminController::class, 'change_lead_school'])->name('admin.leads.index');

Route::post('/showgraph',[AdminController::class, 'updategraph'])->name('admin.leads.index');

Route::post('graph/month',[AdminController::class , 'set_graph_month'])->name('admin.setgraph');


//DOWNLOAD Samople File
Route::get('/download/expense_format', function(){
    $file= public_path('/sample_files/expense_format.xlsx');
    $headers = array('Content-Type: aapplication/vnd.ms-excel',);
return Response::download($file, 'expense_format.xlsx', $headers);
});


//BUDGET ALOCATION
Route::get('/download/budget_format', function(){
    $file= public_path('/sample_files/budget_allocation_format.xlsx');
    $headers = array(
        'Content-Type: application/vnd.ms-excel',
      );
return Response::download($file, 'budget_allocation_format.xlsx', $headers);
});

});
}); //End if Admin Group]


Route::get('/frgtpassword', [FrgtpassController::class,'frgtpassword'])->name('frgtpassword');
Route::post('/sendotp', [FrgtpassController::class,'sendotp'])->name('sendotp.store');
// Route::get('/sendotp{token}',[FrgtpassController::class,'signupsendotp'])->name('sendOTP');
Route::get('/thankyou', [FrgtpassController::class, 'forthankyou'])->name('forthankyou');
Route::get('resettoken/{token}', [FrgtpassController::class, 'showResetPasswordForm'])->name('resettoken');

Route::post('/changeforgotpassword', [FrgtpassController::class,'changeforgotpassword'])->name('changeforgotpassword.store');
