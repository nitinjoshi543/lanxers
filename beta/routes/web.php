<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FreelancerAuthController;
use App\Http\Controllers\FreelancerController;
use App\Http\Controllers\EmployerController;
use App\Http\Controllers\EmployerAuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\ProjectJobController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\AIInterviewController;
use App\Http\Controllers\AiController;
use App\Http\Controllers\JobListingController;
use App\Http\Controllers\HireController;
use App\Http\Controllers\TalentController;

/* =========================================================
   G. ISOLATED — Admin panel & subdomains (untouched)
   ========================================================= */
Route::prefix('admin')->group(function () {
    require base_path('routes/admin.php');
});

Route::domain('hire.lanxers.com')->group(function () {
    Route::get('/', [HireController::class, 'index'])
        ->name('hire.index');

    Route::post('/send-email-otp', [HireController::class, 'sendOtp'])
        ->name('hire.send.otp');

    Route::post('/verify-email-otp', [HireController::class, 'verifyOtp'])
        ->name('hire.verify.otp');

    Route::post('/hire-submit', [HireController::class, 'store'])
        ->name('hire.submit');
});

Route::domain('talent.lanxers.com')->group(function () {
    Route::get('/', [TalentController::class, 'index'])
        ->name('talent.index');

    Route::post('/send-email-otp', [TalentController::class, 'sendOtp'])
        ->name('talent.send.otp');

    Route::post('/verify-email-otp', [TalentController::class, 'verifyOtp'])
        ->name('talent.verify.otp');

    Route::post('/talent-submit', [TalentController::class, 'store'])
        ->name('talent.submit');

    Route::get('/thank-you', function () {
        // Block direct access
        if (!session('talent_submission_completed')) {
            return redirect()->route('talent.index');
        }

        // Allow only once
        session()->forget('talent_submission_completed');

        return view('talent.thankyou');
    })->name('talent.thankyou');

    Route::get('/sales', [TalentController::class, 'salesPage'])
        ->name('talent.sales');


    Route::post('/talent/sales-submit', [TalentController::class, 'storeSales'])->name('abc.sales.submit');

    Route::get('/sales/thank-you', function () {
        // Block direct access
        if (!session('talent_submission_completed')) {
            return redirect()->route('talent.sales');
        }

        // Allow only once
        session()->forget('talent_submission_completed');

        return view('talent.sales.thankyou');
    })->name('talent.sales.thankyou');
});


/* =========================================================
   A. GLOBAL / NEUTRAL — mode-agnostic static/info pages only
   NOTE: Auth (signup/login/forgot/reset) is NOT here anymore.
   Header sends users directly to /jobseekers/... or /employer/...
   ========================================================= */
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/linkedin-jobs', [HomeController::class, 'getLinkedinJobs'])->name('linkedin.jobs');
Route::get('/know-us', [HomeController::class, 'knowUs'])->name('know.us');
Route::get('/contact', [HomeController::class, 'contactUs'])->name('contact');
Route::post('/contact-us', [HomeController::class, 'contactUsStore'])->name('contact.store');

Route::get('/terms-and-conditions', [HomeController::class, 'termsAndConditions'])->name('terms.and.conditions');
Route::get('/user-agreement', [HomeController::class, 'userAgreement'])->name('user.agreement');
Route::get('/privacy-policy', [HomeController::class, 'privacyPolicy'])->name('privacy.policy');


/* =========================================================
   B + C. JOBSEEKERS MODE — /jobseekers prefix
   ========================================================= */
Route::prefix('jobseekers')->name('jobseekers.')->group(function () {

    // ---- AUTH (separate flow, own blade folder) ----
    Route::middleware('guest')->group(function () {
        Route::get('/register', [FreelancerAuthController::class, 'showSignup'])->name('register');
        Route::post('/signup', [FreelancerAuthController::class, 'signup'])->name('signup.store');
        Route::get('/get-states/{country_id}', [FreelancerAuthController::class, 'getStates'])->name('get.states');

        Route::get('/signin', [FreelancerAuthController::class, 'showSignin'])->name('login');
        Route::post('/signin', [FreelancerAuthController::class, 'signin'])->name('login.store');

        Route::get('/forgot-password', [FreelancerAuthController::class, 'showForgot'])->name('password.forgot');
        Route::post('/forgot-password', [FreelancerAuthController::class, 'sendReset'])->name('password.email');
    });
    
    Route::get('/reset-password/{token}', [FreelancerAuthController::class, 'showReset'])->name('password.reset');
    Route::post('/reset-password', [FreelancerAuthController::class, 'updatePassword'])->name('password.update');

    // OTP endpoints for jobseekers signup form
    Route::post('/send-otp', [FreelancerAuthController::class, 'sendOtp'])->name('sendOtp');
    Route::post('/verify-otp', [FreelancerAuthController::class, 'verifyOtp'])->name('verifyOtp');
    Route::post('/store', [FreelancerAuthController::class, 'store'])->name('store');

    // Post-login, pre-profile-complete
    Route::middleware(['auth', 'freelancer'])->group(function () {
        Route::get('/set-password', [FreelancerAuthController::class, 'showSetPassword'])->name('set.password');
        Route::post('/set-password', [FreelancerAuthController::class, 'setPassword'])->name('set.password.update');
        
        Route::put('/profile/update-phone', [ProfileController::class, 'updatePhone'])->name('profile.updatePhone');
        Route::post('/profile/languages', [ProfileController::class, 'updateLanguages'])->name('profile.languages.update');
        Route::post('/profile/social-links', [ProfileController::class, 'updateSocialLinks'])->name('profile.social-links.update');
        Route::post('/profile/skills/update', [ProfileController::class, 'updateSkills'])->name('profile.skills.update');
        Route::get('/profile/skills/search', [ProfileController::class, 'searchSkills'])->name('profile.skills.search');
        Route::post('/profile/project/save', [ProfileController::class, 'saveProject'])->name('profile.project.save');
        Route::delete('/profile/project/{id}', [ProfileController::class, 'deleteProject'])->name('profile.project.delete');
        Route::get('/profile/job-preference/search', [ProfileController::class, 'searchJobPreference'])->name('profile.job-preference.search');
        Route::post('profile/job-preference/update', [ProfileController::class, 'updateJobPreference'])->name('profile.job-preference.update');
        Route::get('/profile/basic-details', [ProfileController::class, 'getBasicDetails'])->name('profile.basic-details');
        Route::post('/profile/basic-details', [ProfileController::class, 'updateBasicDetails'])->name('profile.basic-details.update');
        Route::post('/profile/resume/save', [ProfileController::class, 'saveResume'])->name('profile.resume.save');
        Route::delete('/profile/resume/delete', [ProfileController::class, 'deleteResume'])->name('resume.delete');
        Route::post('/profile-summary/generate', [ProfileController::class, 'generateProfileSummary'])->name('profile.summary.generate');
        Route::post('/profile-summary/save', [ProfileController::class, 'saveProfileSummary'])->name('profile.summary.save');
        Route::get('/education/{id}', [ProfileController::class, 'getEducation'])->name('get.education');
        Route::post('/education/save', [ProfileController::class, 'saveEducation'])->name('education.save');
        Route::get('/experience/{id}', [ProfileController::class, 'getExperience'])->name('get.experience');
        Route::post('/experience/save', [ProfileController::class, 'saveExperience'])->name('experience.save');
            
        Route::get('/profile', [ProfileController::class, 'freelancerProfile'])->name('profile');
        Route::post('/logout', [FreelancerAuthController::class, 'logout'])->name('logout');
        
        Route::get('/profile/start', [ProfileController::class, 'showStartProfile'])->name('profile.start');
        Route::get('/profile/details', [ProfileController::class, 'showCompleteProfileForm'])->name('profile.details');
        Route::post('/profile/complete', [ProfileController::class, 'completeProfile'])->name('profile.complete.store');
        Route::post('/profile/upload-resume', [ProfileController::class, 'uploadResume'])->name('profile.upload.resume');
        Route::post('/jobs/{job}/favourite', [FreelancerController::class, 'toggleFavourite'])->whereNumber('job')->name('job.favourite');
    });

    // ---- Public (job/internship/freelance explorers) ----
    Route::get('/how-it-works', [FreelancerController::class, 'howItWorks'])->name('how.it.works');
    Route::get('/career-advise', [FreelancerController::class, 'careerAdvise'])->name('career.advise');

    Route::get('/find-work/{slug?}', [FreelancerController::class, 'findJobs'])->name('find.work');
    Route::get('/find-work-bk/{slug?}', [FreelancerController::class, 'findJobsBK'])->name('find.work.bk');
    Route::get('/job/{id}', [JobListingController::class, 'show'])->name('job.show');
    Route::post('/job/{id}/favourite', [JobListingController::class, 'toggleFavourite'])->name('job.favourite');
    
    // ---- Authenticated (logged-in jobseeker) — untouched ----
    Route::middleware(['auth', 'profile.complete', 'freelancer'])->group(function () {
        Route::get('/my-jobs', [FreelancerController::class, 'userJobs'])->name('my.jobs');
        Route::get('/jobseekerjob/{type}/{id}/details',[FreelancerController::class, 'ajaxJobDetails'])->name('job.detail.ajax');
        
        Route::get('/job-detail/{slug}', [FreelancerController::class, 'jobDetailPage'])->name('job.detail.page');
        Route::post('/job/apply', [FreelancerController::class, 'jobApply'])->name('job.apply');

        Route::get('/company/{id}', [FreelancerController::class, 'companyProfileDetails'])->name('company.profile');
        Route::get('/wallet', [FreelancerController::class, 'walletPage'])->name('wallet.page');
    });
});


/* =========================================================
   D + E. EMPLOYER MODE — /employer prefix
   ========================================================= */
Route::prefix('employer')->name('employer.')->group(function () {
    
    Route::get('/know-us', [EmployerController::class, 'knowUs'])->name('know.us');
    Route::get('/contact', [EmployerController::class, 'contactUs'])->name('contact');
    Route::post('/contact-us', [EmployerController::class, 'contactUsStore'])->name('contact.store');
    
    Route::get('/terms-and-conditions', [EmployerController::class, 'termsAndConditions'])->name('terms.and.conditions');
    Route::get('/user-agreement', [EmployerController::class, 'userAgreement'])->name('user.agreement');
    Route::get('/privacy-policy', [EmployerController::class, 'privacyPolicy'])->name('privacy.policy');

    // ---- AUTH (separate flow, own blade folder) ----
    Route::middleware('guest')->group(function () {
        Route::get('/register', [EmployerAuthController::class, 'showSignup'])->name('register');
        Route::post('/signup', [EmployerAuthController::class, 'signup'])->name('signup.store');

        Route::get('/signin', [EmployerAuthController::class, 'showSignin'])->name('login');
        Route::post('/signin', [EmployerAuthController::class, 'signin'])->name('login.store');

        Route::get('/forgot-password', [EmployerAuthController::class, 'showForgot'])->name('password.forgot');
        Route::post('/forgot-password', [EmployerAuthController::class, 'sendReset'])->name('password.email');
        Route::get('/reset-password/{token}', [EmployerAuthController::class, 'showReset'])->name('password.reset');
        Route::post('/reset-password', [EmployerAuthController::class, 'updatePassword'])->name('password.update');
    });

    Route::post('/send-otp', [EmployerAuthController::class, 'sendOtp'])->name('sendOtp');
    Route::post('/verify-otp', [EmployerAuthController::class, 'verifyOtp'])->name('verifyOtp');

    Route::post('/verify-email-send-otp', [EmployerAuthController::class, 'verifyEmailSendOtp'])->name('verifyEmailSendOtp');
    Route::post('/verify-email-verify-otp', [EmployerAuthController::class, 'verifyEmailVerifyOtp'])->name('verifyEmailVerifyOtp');

    Route::post('/store', [EmployerAuthController::class, 'store'])->name('store');

    Route::middleware(['auth'])->group(function () {
        Route::get('/set-password', [EmployerAuthController::class, 'showSetPassword'])->name('set.password');
        Route::post('/set-password', [EmployerAuthController::class, 'setPassword'])->name('set.password.update');
        
        Route::post('/employer/get-started/save', [ProfileController::class, 'saveGetStarted'])->name('getStarted.save');
        
        // Basic details
        Route::post('/profile/basic-details', [ProfileController::class, 'saveBasicDetails'])->name('profile.basic-details');
    
        // Contact
        Route::post('/profile/contact',[ProfileController::class, 'saveContactDetails'])->name('profile.contact');
    
        // Company overview
        Route::post('/profile/overview',[ProfileController::class, 'saveCompanyOverview'])->name('profile.overview');
    
        // Documents
        Route::post('/profile/documents',[ProfileController::class, 'uploadDocuments'])->name('profile.documents');

        Route::delete('/profile/documents/{id}',[ProfileController::class, 'deleteDocument'])->name('profile.documents.delete');

        // Services
        Route::post('/profile/services',[ProfileController::class, 'saveServices'])->name('profile.services');
    
        // Team
        Route::post('/profile/team',[ProfileController::class, 'saveTeamMember'])->name('profile.team');
    
        // Hiring preferences
        Route::post('/profile/hiring-preferences',[ProfileController::class, 'saveHiringPreferences'])->name('profile.hiring-preferences');
    
        // Social links
        Route::post('/profile/social-links',[ProfileController::class, 'saveSocialLinks'])->name('profile.social-links');
    
        // Languages
        Route::post('/profile/languages',[ProfileController::class, 'saveLanguages'])->name('profile.languages');
    });

    // ---- Public (hiring intent, pre-login) ----
    Route::get('/', [EmployerController::class, 'employerMainPage'])->name('home');
    Route::get('/our-offerings', [EmployerController::class, 'ourOfferings'])->name('our.offerings');
    Route::get('/how-it-works', [EmployerController::class, 'howItWorks'])->name('how.it.works');
    Route::get('/talent-solutions', [EmployerController::class, 'talentSolutions'])->name('talent.solutions');
    Route::get('/get-states/{country_id}', [EmployerAuthController::class, 'getStates'])->name('get.states');

    Route::middleware(['guest.or.employer'])->group(function () {
        Route::get('/find-talent/{slug?}', [EmployerController::class, 'findTalent'])
            ->name('find.talent');
    });

    // ---- Authenticated (logged-in employer) — untouched ----
    Route::middleware('auth', 'profile.complete', 'employer')->group(function () {
        Route::get('/profile', [ProfileController::class, 'employerProfile'])->name('profile');
        Route::post('/logout', [EmployerAuthController::class, 'logout'])->name('logout');
        Route::get('/my-jobs', [EmployerController::class, 'employerJobs'])->name('my.jobs');
        Route::post('/jobs/{job}/update-status', [ProjectJobController::class, 'updateStatus'])->name('jobs.update.status');
        Route::get('/job-detail/{slug}', [EmployerController::class, 'jobDetailPage'])->name('job.detail.page');
        
        Route::get('/job/{id}/details',[EmployerController::class, 'ajaxJobDetails'])->name('job.detail.ajax');
        
        Route::get('/jobs/{id}/edit', [ProjectJobController::class, 'jobEdit'])->name('jobs.edit');
        
        Route::post('/jobs/{id}/update', [ProjectJobController::class, 'jobUpdate'])->name('jobs.update');
            
        Route::post('/jobs/store', [ProjectJobController::class, 'store'])->name('jobs.store');
        Route::get('/post-job', [ProjectJobController::class, 'postJob'])->name('post.job');
        Route::post('/employer/job/delete', [EmployerController::class, 'deleteJob'])->name('job.delete');
        Route::get('/employer-profile/start', [ProfileController::class, 'showEmployerStartProfile'])->name('profile.start');
        Route::get('/employer-profile/details', [ProfileController::class, 'showEmployerCompleteProfileForm'])->name('profile.details');
        Route::post('/employer-profile/complete', [ProfileController::class, 'completeEmployerProfile'])->name('profile.complete.store');
        Route::post('/freelancers/{freelancer}/favourite', [EmployerController::class, 'toggleFreelancerFavourite'])->whereNumber('freelancer')->name('freelancer.favourite');

        Route::post('/ai/job-description', [ProjectJobController::class, 'generateJobDescription'])->name('ai.job.description');
        Route::post('/ai/job-skills', [ProjectJobController::class, 'generateJobSkills'])->name('ai.job.skills');

        Route::get('/proposal/{proposal}/detail', [EmployerController::class, 'proposalDetail'])->whereNumber('proposal')->name('proposal.detail');
        Route::post('/proposal/{proposal}/status', [EmployerController::class, 'updateProposalStatus'])->whereNumber('proposal')->name('proposal.status');
        Route::get('/freelance-profile/{id?}/{proposal}', [EmployerController::class, 'freelancerProfileDetail'])->name('talent.profile');

        Route::get('/wallet', [EmployerController::class, 'walletPage'])->name('wallet.page');
        Route::post('/transaction/store', [EmployerController::class, 'storeTransaction'])->name('transaction.store');
        
        Route::get(
            '/proposal/{proposalId}/download-cv',
            [EmployerController::class, 'downloadCV']
        )->name('proposal.download-cv');

        Route::post('/proposal/{proposal}/shortlist', 
            [EmployerController::class, 'shortlist']
        )->name('proposal.shortlist');
        
        Route::post('/proposal/{proposal}/reject', 
            [EmployerController::class, 'reject']
        )->name('proposal.reject');
    });
});


/* =========================================================
   F. SHARED AUTHENTICATED — dono modes ke logged-in users
   (AI tools, Chat, Notifications, AI Interview, Resume upload)
   ========================================================= */
Route::middleware(['auth', 'profile.complete'])->group(function () {

    Route::post('/ai-assistant/chat', [AiController::class, 'chat'])->name('ai.assistant.chat');
    Route::post('/ai-assistant/suggestion', [AiController::class, 'suggestion'])->name('ai.assistant.suggestion');
    Route::post('/ai-writing/generate', [AiController::class, 'generateWriting'])->name('ai.writing.generate');
    Route::post('/ai/chat-summary', [AIController::class, 'chatSummary'])->name('ai.chat.summary');
    Route::post('/ai/chat-summary-detail', [AIController::class, 'chatSummaryDetail'])->name('ai.chat.summary.detail');

    Route::get('/resume/upload', [AIInterviewController::class, 'resumeUpload']);
    Route::post('/resume/upload', [AIInterviewController::class, 'upload'])->name('resume.upload');

    Route::post('/notification/read/{id}', [NotificationController::class, 'markAsRead'])->name('notification.read');

    Route::get('/ai-interview/{id}', [AIInterviewController::class, 'show'])->name('ai.interview');
    Route::get('/ai-interview/{id}/start', [AIInterviewController::class, 'start'])->name('ai.interview.start');
    Route::get('/ai-interview/{id}/question/{question}', [AIInterviewController::class, 'question'])->name('ai.interview.question');
    Route::post('/ai-interview/save-answer', [AIInterviewController::class, 'saveAnswer'])->name('ai.interview.answer');
    Route::get('/ai-interview/{id}/finish', [AIInterviewController::class, 'finish'])->name('ai.interview.finish');
    Route::get('/ai-interview/{id}/result', [AIInterviewController::class, 'result'])->name('ai.interview.result');
    Route::post('/ai-interview/autosave', [AIInterviewController::class, 'autoSave'])->name('ai.interview.autosave');
    Route::post('/ai-interview/log', [AIInterviewController::class, 'logViolation'])->name('ai.interview.log');
    Route::post('/ai-interview/init', [AIInterviewController::class, 'initialize'])->name('ai.interview.init');

    Route::get('/chat', [ChatController::class, 'index'])->name('chat.index');
    Route::post('/chat/create', [ChatController::class, 'createConversation'])->name('chat.create');
    Route::post('/chat/send', [ChatController::class, 'sendMessage'])->name('chat.send');
    Route::get('/chat/messages/{conversation}', [ChatController::class, 'loadMessages'])->name('chat.messages');
    Route::post('/chat/read', [ChatController::class, 'markConversationRead'])->name('chat.read');
    Route::get('/chat/unread-count', [ChatController::class, 'getUnreadCount'])->name('chat.unread');
    Route::get('/chat/list', [ChatController::class, 'conversationList'])->name('chat.list');
    Route::post('/chat/hire-request', [ChatController::class, 'sendHireRequest'])->name('chat.hire.request');
    Route::post('/chat/accept-project', [ChatController::class, 'acceptProject'])->name('chat.accept.project');
    Route::post('/chat/upload', [ChatController::class, 'uploadAttachment'])->name('chat.upload');
    Route::get('/chat/download/{id}', [ChatController::class, 'downloadAttachment'])->name('chat.download');
    Route::get('/chat/{id}', [ChatController::class, 'show'])->name('chat.show');
});