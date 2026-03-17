<?php

use App\Http\Controllers\ContactRequestController;
use App\Http\Controllers\ContestantController;
use App\Http\Controllers\ContestantVideoController;
use App\Http\Controllers\InterestController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VoterController;
use App\Http\Controllers\VoteController;
use App\Http\Controllers\JudgeFormController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\DeveloperFormController;
use App\Http\Controllers\SponsorFormController;
use App\Http\Controllers\TermController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\JudgeController;
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



    Route::get('/', function () {

        $contestantsCount = \App\Models\Contestant::count();
        $votesCount = \App\Models\Vote::count();
        $projectsCount = \App\Models\Project::count();
        $header = \App\Models\Header::first();
        $ourProgram = \App\Models\OurProgram::first();
        $developers = \App\Models\Developer::all();
        $countdown = \App\Models\Countdown::first();
        $footer = \App\Models\Footer::first();
        $vote = \App\Models\VoteSetting::first();
        $prize = \App\Models\PrizeSetting::first();
        $judgeSettings = \App\Models\JudgeSetting::first();
        $influentialBodySetting = \App\Models\InfluentialBodySetting::first();


        return view('website.home', compact('contestantsCount', 'votesCount', 'projectsCount', 'header', 'ourProgram', 'developers', 'countdown', 'footer', 'vote', 'prize', 'judgeSettings', 'influentialBodySetting'));
    });
    Route::get('/change-lang/{lang}', function ($lang) {
        if (in_array($lang, ['en', 'ar'])) {
            session(['locale' => $lang]);
        }
        return back();
    })->name('change.lang');
    Route::get('/about', function () {

        $aboutUs = \App\Models\AboutWhoWeAre::first();
        $aboutIntro = \App\Models\AboutIntro::first();
        return view('website.about.index', compact('aboutUs', 'aboutIntro'));

    });
    Route::get('/country/egypt', function () {
        return view('website.country.egypt');
    });
    Route::get('/country/ksa', function () {
        return view('website.country.ksa');
    });
    Route::get('/country/uae', function () {
        return view('website.country.uae');
    });
    Route::get('/country/oman', function () {
        return view('website.country.oman');
    });
    Route::get('/country/qatar', function () {
        return view('website.country.qatar');
    });




    Route::get('/news/updates', [NewsController::class, 'index2'])->name('news.index');
    Route::get('/news/updates/details/{id}', [NewsController::class, 'details2'])->name('news.details2');


    Route::get('/contact-us', function () {
        return view('website.contact.index');
    });
    Route::get('/contact-us', function () {
        return view('website.contact.index');
    });


    Route::get('/FAQs', [FaqController::class, 'index2'])->name('faq.index');
    Route::get('/terms/services', [TermController::class, 'index2'])->name('terms.index');



    Route::get('/how_it_work', function () {
        return view('website.how_it_work.index');
    });
    Route::get('/contestant/registeration', function () {
        return view('website.contestant.registeration_form');
    });
    // Note: removed static '/otp' view route to avoid showing OTP page without session.
    Route::get('/signUp', function () {
        return view('website.signUp.signUp');
    });
    Route::get('/signIn', function () {
        return view('website.signIn.signIn');
    });

    Route::get('/ranking', function () {
        return view('website.ranking.index');
    })->name('ranking');





    Route::middleware('auth')->group(function () {

        // Show Profile Page
        Route::get('/profile/{id}', [ProfileController::class, 'edit'])->name('profile.edit');
        // Update Profile
        Route::patch('/profile/{id}', [ProfileController::class, 'update'])->name('profile.update');
        // Delete User Account
        Route::delete('/profile/{id}', [ProfileController::class, 'destroy'])->name('profile.destroy');
        Route::get('/activate/{id}/{store}', [ProfileController::class, 'activate'])->name('activate.user');
        //upload video
        Route::post('/contestant/videos/upload', [ContestantVideoController::class, 'uploadall'])
            ->name('contestant.videos.upload');
    });


    // OTP Routes for contestant (Must be before contestant/{id})
    Route::get('/contestant/otp', [ContestantController::class, 'showOtpForm'])->name('contestant.otp.form');
    Route::post('/contestant/otp/verify', [ContestantController::class, 'verifyOtp'])->name('contestant.otp.verify');
    Route::post('/contestant/otp/resend', [ContestantController::class, 'resendOtp'])->name('contestant.otp.resend');

    Route::get('/contestant/{id}', [ProfileController::class, 'show'])->name('contestant.show');


    //route Partner
    Route::resource('partners', \App\Http\Controllers\PartnerController::class);
    Route::resource('developers', \App\Http\Controllers\DeveloperController::class);
    Route::get('/project/details/{id}', [\App\Http\Controllers\DeveloperController::class, 'project_details'])->name('project.details');
    Route::get('/unit/details/{id}', [\App\Http\Controllers\DeveloperController::class, 'unit_details'])->name('unit.details');
    Route::get('/developer/{id}/projects', [\App\Http\Controllers\DeveloperController::class, 'getDeveloperProjects'])
        ->name('developer.projects');




   //contestant
    Route::get('/contestants',  [ContestantController::class, 'index'])->name('contestants');
    Route::post('/contestant/register', [ContestantController::class, 'register'])->name('contestant.register');
    Route::post('/check-user-exists', [ContestantController::class, 'checkUserExists'])
        ->name('check.user.exists');

    // contact
    Route::post('/contact', [ContactRequestController::class, 'store'])->name('contact.store');


    // voter
    Route::post('/voter', [VoterController::class, 'store'])->name('voter.store');

    Route::get('/vote',[VoteController::class, 'index']);


    Route::get('/voter/profile/{id}', [VoterController::class, 'profile'])->name('voter.profile')->middleware('auth');
    Route::get('voter/package/{id}', [VoterController::class, 'package'])->name('voter.package')->middleware('auth');


    // Votes Routes
    Route::post('/vote/{contestantId}', [VoteController::class, 'vote'])->name('vote')->middleware('auth');
    Route::post('/purchase-votes', [VoteController::class, 'purchaseVotes'])->name('purchase.votes');


    // OTP Routes for voter
    Route::get('/voter/otp', [VoterController::class, 'showOtpForm'])->name('voter.otp.form');
    Route::post('/voter/otp/verify', [VoterController::class, 'verifyOtp'])->name('voter.otp.verify');
    Route::post('/voter/otp/resend', [VoterController::class, 'resendOtp'])->name('voter.otp.resend');

    // OTP Routes for contestant (used after contestant registration)
    // Route::get('/contestant/otp', [ContestantController::class, 'showOtpForm'])->name('contestant.otp.form');
    // Route::post('/contestant/otp/verify', [ContestantController::class, 'verifyOtp'])->name('contestant.otp.verify');
    // Route::post('/contestant/otp/resend', [ContestantController::class, 'resendOtp'])->name('contestant.otp.resend');


    // Interested
    Route::post('/interest/{contestantId}', [InterestController::class, 'toggle'])->name('interest.toggle');




    Route::get('/judgeProfile', function () {
        return view('website.judge.profile');
    });
    Route::get('/judgeSubmission', function () {
        return view('website.judge.submission');
    });


    Route::get('/judge', [JudgeController::class, 'index']);
    Route::get('/judgeProfile/{id}', [JudgeController::class, 'show'])->name('judge.profile');


       // Judge submission POST
    Route::post('/judge/submission', [JudgeFormController::class, 'store'])->name('judge.submit');
    Route::post('/partner/submission', [PartnerController::class, 'store'])->name('partner.submit');
    Route::post('/developer/form', [DeveloperFormController::class, 'store'])->name('developer.form.submit');
    Route::post('/sponsor/form', [SponsorFormController::class, 'store'])->name('sponsor.form.submit');





require __DIR__.'/auth.php';