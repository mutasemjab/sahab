<?php

use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\AdvController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\BusinessTypeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\UnitController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\DeliveryController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\CompleteAboutController;
use App\Http\Controllers\Admin\WholeSaleController;
use App\Http\Controllers\Admin\ShopController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\OfferController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\CrvController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\ImportantLinkController;
use App\Http\Controllers\Admin\LawController;
use App\Http\Controllers\Admin\MunicipalCouncilController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\WarehouseController;
use App\Http\Controllers\Admin\NoteVoucherTypeController;
use App\Http\Controllers\Admin\NoteVoucherController;
use App\Http\Controllers\Admin\OurPartController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\PublicSessionController;
use App\Http\Controllers\Admin\QuestionController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\TaxController;
use App\Http\Controllers\Admin\TenderController;
use App\Http\Controllers\Admin\TenderDetailController;
use App\Http\Controllers\Admin\TopicDiscussionController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Reports\AllProductReportController;
use App\Http\Controllers\Reports\InventoryReportController;
use App\Http\Controllers\Reports\OrderReportController;
use App\Http\Controllers\Reports\ProductReportController;
use App\Http\Controllers\Reports\TaxReportController;
use App\Http\Controllers\Reports\UserReportController;
use App\Models\CompleteAbout;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Spatie\Permission\Models\Permission;
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

define('PAGINATION_COUNT', 11);
Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']], function () {



    Route::group(['prefix' => 'admin', 'middleware' => 'auth:admin'], function () {
        Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');
        Route::get('logout', [LoginController::class, 'logout'])->name('admin.logout');

        /*         start  update login admin                 */
        Route::get('/admin/edit/{id}', [LoginController::class, 'editlogin'])->name('admin.login.edit');
        Route::post('/admin/update/{id}', [LoginController::class, 'updatelogin'])->name('admin.login.update');
        /*         end  update login admin                */

        /// Role and permission
        Route::resource('employee', 'App\Http\Controllers\Admin\EmployeeController', ['as' => 'admin']);
        Route::get('role', 'App\Http\Controllers\Admin\RoleController@index')->name('admin.role.index');
        Route::get('role/create', 'App\Http\Controllers\Admin\RoleController@create')->name('admin.role.create');
        Route::get('role/{id}/edit', 'App\Http\Controllers\Admin\RoleController@edit')->name('admin.role.edit');
        Route::patch('role/{id}', 'App\Http\Controllers\Admin\RoleController@update')->name('admin.role.update');
        Route::post('role', 'App\Http\Controllers\Admin\RoleController@store')->name('admin.role.store');
        Route::post('admin/role/delete', 'App\Http\Controllers\Admin\RoleController@delete')->name('admin.role.delete');

        Route::get('/permissions/{guard_name}', function ($guard_name) {
            return response()->json(Permission::where('guard_name', $guard_name)->get());
        });



        Route::resource('users', UserController::class);
        Route::resource('banners', BannerController::class);
        Route::resource('abouts', AboutController::class);
        Route::resource('complete_abouts', CompleteAboutController::class);
        Route::resource('events', EventController::class);
        Route::resource('services', App\Http\Controllers\Admin\ServiceController::class);
        Route::resource('public-sessions', PublicSessionController::class);
        Route::resource('projects', ProjectController::class);

        Route::resource('advs', AdvController::class);
        Route::resource('news', NewsController::class);
        Route::resource('questions', QuestionController::class);
        Route::resource('settings', SettingController::class);
        Route::resource('our-parts', OurPartController::class);
        Route::resource('municipal-councils', MunicipalCouncilController::class);
        Route::resource('laws', LawController::class);
        Route::resource('tenders', TenderController::class);
        Route::resource('tender-details', TenderDetailController::class);
        Route::resource('topic-discussions', TopicDiscussionController::class);
        Route::resource('galleries', GalleryController::class);
        Route::resource('important-links', ImportantLinkController::class);
        
    });
});



Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => 'guest:admin'], function () {
    Route::get('login', [LoginController::class, 'show_login_view'])->name('admin.showlogin');
    Route::post('login', [LoginController::class, 'login'])->name('admin.login');
});
