<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\NewListenSessionController;
use App\Http\Controllers\ImportantLinkController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\CommunityController;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HelpUsController;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MediaCenterController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\SiteMapController;
use App\Http\Controllers\SuggestionController;
use App\Http\Controllers\TenderController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group whichf
| contains the "web" middleware group. Now create something great!
|
*/



Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']], function () {

      // Add modal registration route
    Route::post('/modal-register', [AuthController::class, 'modalRegister'])->name('modal.register');
    Route::post('/auth-login', [AuthController::class, 'login'])->name('auth.login');
    Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');
    
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/about', [AboutController::class, 'index'])->name('about');
    Route::get('/projects', [ProjectController::class, 'index'])->name('projects');
    Route::get('/projects/{id}', [ProjectController::class, 'show'])->name('projects.show');
    Route::get('/questions', [QuestionController::class, 'index'])->name('questions');
    Route::get('/importantLink', [ImportantLinkController::class, 'index'])->name('importantLink');
    Route::get('/complaints', [HomeController::class, 'getComplaints'])->name('complaints');
    Route::get('/advs', [HomeController::class, 'getAdvs'])->name('advs');
    Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
    Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
        
    Route::get('/suggestions', [SuggestionController::class, 'index'])->name('suggestions.index');
    Route::post('/suggestions', [SuggestionController::class, 'store'])->name('suggestions.store');


    Route::get('/complaints', [ComplaintController::class, 'index'])->name('complaints.index');
    Route::post('/complaints', [ComplaintController::class, 'store'])->name('complaints.store');
    Route::get('/complaints/track', [ComplaintController::class, 'track'])->name('complaints.track');
    Route::get('/track-complaints', [ComplaintController::class, 'trackIndex'])->name('track-complaints');
    Route::get('/complaints/{id}', [ComplaintController::class, 'show'])->name('complaints.show');
    Route::get('/complaints-details', [ComplaintController::class, 'details'])->name('complaints-details');
    Route::get('/complaints-details-two/{id}', [ComplaintController::class, 'detailsTwo'])->name('complaints-details-two');
    
    Route::get('/services', [ServiceController::class, 'index'])->name('services');
    Route::get('/services/{id}', [ServiceController::class, 'show'])->name('services.show');
    Route::post('/services/form', [ServiceController::class, 'storeForm'])->name('services.form.store');

    Route::get('/websiteTenders', [TenderController::class, 'index'])->name('wbsiteTenders.index');
    Route::get('/websiteTenders/{id}', [TenderController::class, 'show'])->name('wbsiteTenders.show');
    Route::get('/tenders/{id}/download', [TenderController::class, 'downloadDocuments'])->name('tenders.download');
    Route::get('/tenders/{id}/download-files', [TenderController::class, 'downloadFiles'])->name('tenders.download-files');

    Route::get('/communitydetails', [CommunityController::class, 'index'])->name('community.index');
    Route::post('/community/support-initiative/{id}', [CommunityController::class, 'supportInitiative'])->name('community.support-initiative');
    Route::post('/community/vote-topic/{id}', [CommunityController::class, 'voteOnTopic'])->name('community.vote-topic');

    Route::get('/sessions/{id}', [SessionController::class, 'show'])->name('sessions.show');

    Route::get('/media-center', [MediaCenterController::class, 'index'])->name('media.center');

    // Advertisements Routes
    Route::get('/advertisement/{id}', [MediaCenterController::class, 'show'])->name('advertisement.show');

    Route::get('/newListen', [NewListenSessionController::class, 'showAllNewListen'])->name('newListen.index');
    Route::get('/newListen/{id}', [NewListenSessionController::class, 'showNewListen'])->name('newListen.show');

    // News Routes
    // Route::get('/news', [MediaCenterController::class, 'showAllNews'])->name('news.index');
    // Route::get('/news/{id}', [MediaCenterController::class, 'showNews'])->name('news.show');

    Route::get('/helpus', [HelpUsController::class, 'index'])->name('helpus');
    Route::post('/helpus', [HelpUsController::class, 'store'])->name('helpus.store');

    Route::get('/question', [QuestionController::class, 'index'])->name('question');
    Route::get('/question/search', [QuestionController::class, 'search'])->name('question.search');

    Route::get('/importantLinks', [ImportantLinkController::class, 'index'])->name('importantLinks.index');
    
    Route::get('/site-map', [SiteMapController::class, 'index'])->name('site-map');
    
    Route::get('/projects', [ProjectController::class, 'index'])->name('projects');
    
    Route::get('/suggestion', [SuggestionController::class, 'index'])->name('suggestion');
    
    Route::get('/complaintdetails', [ComplaintController::class, 'details'])->name('complaintdetails');
    
    Route::get('/complaintfollow', [ComplaintController::class, 'trackIndex'])->name('complaintfollow');
    
    Route::get('/community', [ComplaintController::class, 'trackIndex'])->name('complaintfollow');
    Route::post('/newsletter/subscribe', [NewsletterController::class, 'subscribe'])->name('newsletter.subscribe');

    // Frontend Page Routes
    Route::get('/terms-and-conditions', function () {
        $page = \App\Models\Page::where('type', 1)->first();
        if (!$page) {
          return view('user.not-found');
        }
        return view('user.page', compact('page'));
    })->name('front.page.terms');

    Route::get('/privacy-policy', function () {
        $page = \App\Models\Page::where('type', 2)->first();
        if (!$page) {
          return view('user.not-found');
        }
        return view('user.page', compact('page'));
    })->name('front.page.privacy');


});

Route::fallback(function () {
    return view('user.not-found'); // or whatever view name you prefer
});