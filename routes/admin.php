<?php

use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\AdvController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\CommunityInitiativeController;
use App\Http\Controllers\Admin\ComplaintController;
use App\Http\Controllers\Admin\CompleteAboutController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\FooterSettingController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\ImportantLinkController;
use App\Http\Controllers\Admin\LawController;
use App\Http\Controllers\Admin\MunicipalCouncilController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\OurPartController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\PublicSessionController;
use App\Http\Controllers\Admin\QuestionController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\ServiceFormsController;
use App\Http\Controllers\Admin\SuggestionsController;
use App\Http\Controllers\Admin\TenderController;
use App\Http\Controllers\Admin\TenderDetailController;
use App\Http\Controllers\Admin\TopicDiscussionController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\NewListenSessionController;
use App\Http\Controllers\Admin\PageController;
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

        Route::get('/contacts', [ContactController::class, 'index'])->name('admin.contacts.index');
        Route::delete('/contacts/{contact}', [ContactController::class, 'destroy'])->name('admin.contacts.destroy');

        Route::prefix('admin')->name('admin.')->group(function () {
            Route::get('/service-forms', [ServiceFormsController::class, 'index'])->name('service-forms.index');
            Route::delete('/service-forms/{serviceForm}', [ServiceFormsController::class, 'destroy'])->name('service-forms.destroy');
        });

        Route::prefix('admin')->name('admin.')->group(function () {
            Route::get('/suggestions', [SuggestionsController::class, 'index'])->name('suggestions.index');
            Route::delete('/suggestions/{suggestion}', [SuggestionsController::class, 'destroy'])->name('suggestions.destroy');
        });

        Route::resource('users', UserController::class);
        Route::resource('banners', BannerController::class);
        Route::resource('abouts', AboutController::class);
        Route::resource('complete_abouts', CompleteAboutController::class);
        Route::resource('events', EventController::class);
        Route::resource('services', App\Http\Controllers\Admin\ServiceController::class);
        Route::resource('public-sessions', PublicSessionController::class);
        Route::resource('projects', ProjectController::class);
        Route::resource('new-listen-sessions', NewListenSessionController::class);

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
        Route::resource('adminComplaints', ComplaintController::class);
        Route::resource('pages', PageController::class);
        Route::resource('community-initiatives',CommunityInitiativeController::class);

        Route::get('services/{serviceId}/details', [ServiceController::class, 'showDetails'])->name('services.details');
        Route::get('services/{serviceId}/details/create', [ServiceController::class, 'createDetails'])->name('services.details.create');
        Route::post('services/{serviceId}/details', [ServiceController::class, 'storeDetails'])->name('services.details.store');
        Route::get('services/{serviceId}/details/{detailId}/edit', [ServiceController::class, 'editDetails'])->name('services.details.edit');
        Route::put('services/{serviceId}/details/{detailId}', [ServiceController::class, 'updateDetails'])->name('services.details.update');
        Route::delete('services/{serviceId}/details/{detailId}', [ServiceController::class, 'destroyDetails'])->name('services.details.destroy');

        Route::get('/footer-settings', [FooterSettingController::class, 'index'])
            ->name('footer-settings.index');
        Route::put('/footer-settings', [FooterSettingController::class, 'update'])
            ->name('footer-settings.update');
    });
});



Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => 'guest:admin'], function () {
    Route::get('login', [LoginController::class, 'show_login_view'])->name('admin.showlogin');
    Route::post('login', [LoginController::class, 'login'])->name('admin.login');
});
