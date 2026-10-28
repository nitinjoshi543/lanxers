<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin;
use App\Http\Controllers\User;
use App\Http\Controllers\Subadmin;
use App\Http\Controllers\JobController;
use App\Http\Controllers\ExternalJobController;
use App\Http\Controllers\Offer;
use App\Http\Controllers\Extra;
use App\Http\Controllers\Marketingtools;
use App\Http\Controllers\SundayBlockbuster;
use App\Http\Controllers\Freelance;
use App\Http\Controllers\Achievement;
use App\Http\Controllers\CashbackController;
use App\Http\Controllers\GamifiedController;
use App\Http\Controllers\Influencer;
use App\Http\Controllers\Creator;

//admin route
Route::get('/talent-form-list', [User::class, 'talentFormList'])->name('talent.form.list');
Route::get('/get-talent-form-list', [User::class, 'gettalentFormList'])->name('get.talent.form.list');

Route::get('/admin-login', [Admin::class, 'loginPage'])->name('admin.login');
Route::post('/admin-verify-otp-test', [Admin::class, 'verifyOtpTest'])->name('admin.verify.otp.test');

Route::post('/login-otp-send', [Admin::class, 'sendOtp'])->name('login.otp.send');
Route::get('/admin-logout', [Admin::class, 'logout'])->name('admin.logout');

Route::get('/admin-dashboard', [Admin::class, 'dashboard'])->name('admin.dashboard');
Route::get('/freelancer-module', [User::class, 'freelancerModule'])->name('freelancer.module');
Route::post('/freelancer-module-search', [User::class, 'freelancerModuleSearch'])->name('freelancer.module.search');
Route::get('/freelancer-details/{id}', [User::class, 'freelancerDetails'])->name('freelancer.details');

Route::post('/update-profile-level', [User::class, 'updateProfileLevel'])->name('freelancer.update.profile.level');
Route::post('/update-account-status', [User::class, 'updateAccountStatus'])->name('freelancer.update.account.status');


Route::get('/user-referral-list/{id}', [User::class, 'userReferralList'])->name('user.referral.list');
Route::get('/get-user-referral-list', [User::class, 'getUserReferralList'])->name('get.user.referral.list');
Route::get('/user-edit/{id}', [User::class, 'userEdit'])->name('user.edit');
Route::post('/user-personal-details-update/{id}', [User::class, 'userPersonalDetailsUpdate'])->name('user.personal.details.update');
Route::post('/user-bank-details-update/{id}', [User::class, 'userBankDetailsUpdate'])->name('user.bank.details.update');
Route::post('/user-delete', [User::class, 'userDelete'])->name('user.delete');

Route::get('/jobs-list', [JobController::class, 'jobsList'])->name('jobs.list');
Route::get('/get-jobs-list', [JobController::class, 'getjobsList'])->name('get.jobs.list');
Route::get('/jobs-add', [JobController::class, 'jobsAdd'])->name('jobs.add');
Route::get('/skills-search', [JobController::class, 'searchSkills'])->name('skills.search');
Route::post('/submit-jobs-add-form', [JobController::class, 'submitjobsAddForm'])->name('submit.jobs.add.form');
Route::get('/edit-jobs/{id}', [JobController::class, 'editjobs'])->name('edit.jobs');
Route::post('/submit-edit-jobs-form/{id}', [JobController::class, 'submitEditjobsForm'])->name('submit.edit.jobs.form');
Route::post('/jobs-setstatus', [JobController::class, 'setStatus'])->name('jobs.setstatus');

Route::get('/jobs-category-list', [JobController::class, 'jobsCategoryList'])->name('jobs.category.list');
Route::get('/get-jobs-category-list', [JobController::class, 'getjobsCategoryList'])->name('get.jobs.category.list');
Route::get('/jobs-category-add', [JobController::class, 'jobsCategoryAdd'])->name('jobs.category.add');
Route::post('/submit-jobs-category-add-form', [JobController::class, 'submitjobsCategoryAddForm'])->name('submit.jobs.category.add.form');
Route::get('/edit-jobs-category/{id}', [JobController::class, 'editjobsCategory'])->name('edit.jobs.category');
Route::post('/submit-edit-jobs-category-form/{id}', [JobController::class, 'submitEditjobsCategoryForm'])->name('submit.edit.jobs.category.form');
Route::post('/jobs-category-setstatus', [JobController::class, 'setjobsCategoryStatus'])->name('jobs.category.setstatus');

Route::get('/jobs-employer-list', [JobController::class, 'jobsEmployerList'])->name('jobs.employer.list');
Route::get('/get-jobs-employer-list', [JobController::class, 'getjobsEmployerList'])->name('get.jobs.employer.list');
Route::get('/jobs-employer-add', [JobController::class, 'jobsEmployerAdd'])->name('jobs.employer.add');
Route::post('/submit-jobs-employer-add-form', [JobController::class, 'submitjobsEmployerAddForm'])->name('submit.jobs.employer.add.form');
Route::get('/edit-jobs-employer/{id}', [JobController::class, 'editjobsEmployer'])->name('edit.jobs.employer');
Route::post('/submit-edit-jobs-employer-form/{id}', [JobController::class, 'submitEditjobsEmployerForm'])->name('submit.edit.jobs.employer.form');
Route::post('/jobs-employer-setstatus', [JobController::class, 'setjobsEmployerStatus'])->name('jobs.employer.setstatus');

Route::get('/external-jobs-list', [ExternalJobController::class, 'externalJobsList'])->name('external.jobs.list');
Route::get('/get-external-jobs-list', [ExternalJobController::class, 'getExternalJobsList'])->name('get.external.jobs.list');
Route::post('/external-jobs-setstatus', [ExternalJobController::class, 'setExternalJobsStatus'])->name('external.jobs.setstatus');
Route::get('/external-jobs-view/{id}', [ExternalJobController::class, 'externalJobView'])->name('external.jobs.view');
Route::get('/edit-external-jobs-employer/{id}', [ExternalJobController::class, 'editExternalJobsEmployer'])->name('edit.external.jobs.employer');
Route::post('/submit-edit-external-jobs-employer-form/{id}', [ExternalJobController::class, 'submitEditExternalJobsEmployerForm'])->name('submit.edit.external.jobs.employer.form');
Route::post('/toggle-external-job-status/{id}', [ExternalJobController::class, 'toggleExternalJobStatus'])->name('toggle.external.job.status');









// Old Route
Route::get('/generateCSVNew', [User::class, 'generateCSVNew'])->name('generateCSVNew');

Route::get('/videokyc-module', [User::class, 'videokycModule'])->name('videokyc.module');
Route::get('/get-user-videokyc-list', [User::class, 'getUserVideokycList'])->name('get.user.videokyc.list');
Route::get('/mannual-approve-videokyc', [User::class, 'setvideoKycstatus'])->name('mannual.approve.videokyc');

// creator modual
Route::get('/creator-list', [Creator::class, 'creatorList'])->name('creator.list');
Route::get('/get-creator-list', [Creator::class, 'getCreatorList'])->name('get.creator.list');
Route::post('/creator-approval', [Creator::class, 'creatorApproval'])->name('creator.approval');
// Route::get('/influencer-add', [Influencer::class, 'influencerAdd'])->name('influencer.add');
// Route::post('/submit-influencer-add-form', [Influencer::class, 'submitinfluencerAddForm'])->name('submit.influencer.add.form');
// Route::get('/edit-influencer/{id}', [Influencer::class, 'editinfluencer'])->name('edit.influencer');
// Route::post('/submit-edit-influencer-form/{id}', [influencer::class, 'submitEditinfluencerForm'])->name('submit.edit.influencer.form');
// Route::post('/influencer-setstatus', [Influencer::class, 'setinfluencerStatus'])->name('influencer.setstatus');


// Influencer Category
Route::get('/influencer-category-list', [Influencer::class, 'influencerCategoryList'])->name('influencer.category.list');
Route::get('/get-influencer-category-list', [Influencer::class, 'getinfluencerCategoryList'])->name('get.influencer.category.list');
Route::get('/influencer-category-add', [Influencer::class, 'influencerCategoryAdd'])->name('influencer.category.add');
Route::post('/submit-influencer-category-add-form', [Influencer::class, 'submitinfluencerCategoryAddForm'])->name('submit.influencer.category.add.form');
Route::get('/edit-influencer-category/{id}', [Influencer::class, 'editinfluencerCategory'])->name('edit.influencer.category');
Route::post('/submit-edit-influencer-category-form/{id}', [influencer::class, 'submitEditinfluencerCategoryForm'])->name('submit.edit.influencer.category.form');
Route::post('/influencer-category-setstatus', [Influencer::class, 'setinfluencerCategoryStatus'])->name('influencer.category.setstatus');

// Influencer Profile
Route::get('/influencer-list', [Influencer::class, 'influencerList'])->name('influencer.list');
Route::get('/get-influencer-list', [Influencer::class, 'getinfluencerList'])->name('get.influencer.list');
Route::get('/influencer-add', [Influencer::class, 'influencerAdd'])->name('influencer.add');
Route::post('/submit-influencer-add-form', [Influencer::class, 'submitinfluencerAddForm'])->name('submit.influencer.add.form');
Route::get('/edit-influencer/{id}', [Influencer::class, 'editinfluencer'])->name('edit.influencer');
Route::post('/submit-edit-influencer-form/{id}', [influencer::class, 'submitEditinfluencerForm'])->name('submit.edit.influencer.form');
Route::post('/influencer-setstatus', [Influencer::class, 'setinfluencerStatus'])->name('influencer.setstatus');

// Influencer Raw Folder
Route::get('/influencer-raw-folder', [Influencer::class, 'influencerRawFolder'])->name('influencer.raw.folder');
Route::get('/get-raw-folder', [Influencer::class, 'getRawFolder'])->name('get.raw.folder');
Route::get('/add-raw-folder', [Influencer::class, 'addRawFolder'])->name('add.raw.folder');
Route::post('/submit-add-form-raw-folder', [Influencer::class, 'submitAddFormRawFolder'])->name('submit.add.form.raw.folder');
Route::get('/edit-raw-folder/{id}', [Influencer::class, 'editRawFolder'])->name('edit.raw.folder');
Route::post('/submit-edit-raw-folder-form/{id}', [influencer::class, 'submitEditRawFolderForm'])->name('submit.edit.raw.folder.form');
Route::post('/raw-folder-setstatus', [Influencer::class, 'setRawFolderStatus'])->name('raw.folder.setstatus');

// Influencer Raw Folder
Route::get('/influencer-raw-data', [Influencer::class, 'influencerRawData'])->name('influencer.raw.data');
Route::get('/get-raw-data', [Influencer::class, 'getRawData'])->name('get.raw.data');
Route::get('/add-raw-data', [Influencer::class, 'addRawData'])->name('add.raw.data');
Route::post('/submit-add-form-raw-data', [Influencer::class, 'submitAddFormRawData'])->name('submit.add.form.raw.data');
Route::get('/edit-raw-data/{id}', [Influencer::class, 'editRawData'])->name('edit.raw.data');
Route::post('/submit-edit-raw-data-form/{id}', [influencer::class, 'submitEditRawDataForm'])->name('submit.edit.raw.data.form');
Route::post('/raw-data-setstatus', [Influencer::class, 'setRawDataStatus'])->name('raw.data.setstatus');


Route::get('/live-webinar', [User::class, 'liveWebinarDetails'])->name('live.webinar');
Route::get('/live-webinar-add', [User::class, 'LiveWebinarAdd'])->name('live.webinar.add');
Route::get('/get-live-webinar-list', [User::class, 'getLiveWebinarList'])->name('get.live.webinar.list');
Route::post('/live-webinar-setstatus', [User::class, 'setLiveWebinarStatus'])->name('live.webinar.setstatus');
Route::get('/edit-live-webinar/{id}', [User::class, 'editLiveWebinar'])->name('edit.live.webinar');
Route::post('/submit-edit-live-webinar-form/{id}', [User::class, 'submitEditLiveWebinarForm'])->name('submit.edit.live.webinar.form');

Route::post('/submit-live-webinar-add-form', [User::class, 'submitLiveWebinarAddForm'])->name('submit.live.webinar.add.form');

Route::post('/user-redeem-status-change', [User::class, 'userRedeemStatusChange'])->name('user.redeem.status.change');
Route::post('/user-redeem-status-change-verifyotp', [User::class, 'userRedeemStatusChangeVerifyotp'])->name('user.redeem.status.change.verifyotp');

Route::get('/user-redeem-amount-module', [User::class, 'userRedeemAmount'])->name('user.redeem.amount.module');
Route::get('/get-user-redeem-amount-list', [User::class, 'getUserRedeemAmountList'])->name('get.user.redeem.amount.list');
Route::get('/user-redeem-amount-details/{id}', [User::class, 'userRedeemAmountDetails'])->name('user.redeem.amount.details');

Route::get('/gamified-user-list', [GamifiedController::class, 'index'])->name('gamified.user.list');
Route::get('/get-gamified-user-list', [GamifiedController::class, 'getGamifiedUserList'])->name('get.gamified.user.list');
Route::get('/gamified-gift-item-list', [GamifiedController::class, 'gamifiedGiftItemList'])->name('gamified.gift.item.list');
Route::get('/get-gamified-gift-item-list', [GamifiedController::class, 'getGamifiedGiftItemList'])->name('get.gamified.gift.item.list');
Route::get('/edit-gamified-gift-item/{id}', [GamifiedController::class, 'gamifiedGiftItemEdit'])->name('gamified.gift.item.edit');
Route::post('/gamified-gift-item-update/{id}', [GamifiedController::class, 'gamifiedGiftItemUpdate'])->name('gamified.gift.item.update');
Route::get('/view-gamified-gift-user/{id}', [GamifiedController::class, 'viewGamifiedGiftUser'])->name('view.gamified.gift.user');
Route::post('/gamified-gift-user-setstatus', [GamifiedController::class, 'setGamifiedGiftUserStatus'])->name('gamified.gift.user.setstatus');

Route::post('/admin-payment-update', [CashbackController::class, 'paymentUpdate'])
    ->name('admin.payment.update');
Route::get('/admin-payment-update', [CashbackController::class, 'showPaymentForm'])
    ->name('admin.payment.form');

Route::post('/admin/cashbacks/upload', [CashbackController::class, 'uploadCsv'])
    ->name('admin.cashbacks.upload');
Route::get('/cashback-module', [CashbackController::class, 'index'])->name('cashback.module');
Route::get('/cashback-list', [CashbackController::class, 'cashbackList'])->name('cashback.list');
Route::get('/get-user-cashback-list', [CashbackController::class, 'getCashbackList'])->name('get.user.cashback.list');

Route::get('/uaekyc-module', [User::class, 'uaekycModule'])->name('uaekyc.module');
Route::get('/get-user-uaekyc-list', [User::class, 'getUaeUserkycList'])->name('get.user.uaekyc.list');
Route::get('/uaekyc-user-details/{id}', [User::class, 'uaekycUserDetails'])->name('uaekyc.user.details');
Route::get('/uae-approve-disapprove-kyc', [User::class, 'setUaeKycstatus'])->name('user.uaekyc.approvedisapprove');

Route::get('/internationalkyc-module', [User::class, 'internationalkycModule'])->name('internationalkyc.module');
Route::get('/get-user-internationalkyc-list', [User::class, 'getinternationalUserkycList'])->name('get.user.internationalkyc.list');
Route::get('/internationalkyc-user-details/{id}', [User::class, 'internationalkycUserDetails'])->name('internationalkyc.user.details');
Route::get('/international-approve-disapprove-kyc', [User::class, 'setInternationalKycstatus'])->name('user.internationalkyc.approvedisapprove');

Route::post('/submit-find-user-referral', [User::class, 'findUserIndividualCourseReferral'])->name('submit.find.user.referral');
Route::get('/individual-course-user-find', [User::class, 'IndividualCourseUserFind'])->name('individual.course.user.find');

Route::get('/achievement', [Achievement::class, 'index'])->name('achievement');
Route::get('/get-achievement-list', [Achievement::class, 'getAchievementList'])->name('get.achievement.list');
Route::post('/set-achievement-record', [Achievement::class, 'setAchievementRecord'])->name('setAchievementRecord');
Route::post('/update-achievement-records', [Achievement::class, 'updateAchievementRecords'])->name('updateAchievementRecords');


Route::get('/users-payment-module', [User::class, 'userPaymentModule'])->name('users.payment.module');

Route::post('/user-email-verify-change', [User::class, 'userEmailVerifyChange'])->name('user.email.verify.change');
Route::post('/user-status-change', [User::class, 'userStatusChange'])->name('user.status.change');
Route::post('/user-status-change-verifyotp', [User::class, 'userStatusChangeVerifyotp'])->name('user.status.change.verifyotp');
Route::post('/user-account-change', [User::class, 'userAccountChange'])->name('user.account.change');
Route::post('/user-account-change-verifyotp', [User::class, 'userAccountChangeVerifyotp'])->name('user.account.change.verifyotp');
Route::post('/user-withdrawal-request-create', [User::class, 'userWithdrawalRequestCreate'])->name('user.withdrawal.request.create');
Route::post('/user-message-send-whatsapp', [User::class, 'userMessageSendWhatsapp'])->name('user.message.send.whatsapp');

Route::get('/refund', [User::class, 'refund'])->name('refund.create.module');
Route::post('/refund-user-search', [User::class, 'refundUserSearch'])->name('refund.user.search');
Route::get('/get-refund-list', [User::class, 'getRefundList'])->name('get.refund.list');
Route::post('/refund-request-create', [User::class, 'refundRequestCreate'])->name('refund.request.create');

Route::get('/refund-sheet', [User::class, 'refundSheet'])->name('refund.sheet');
Route::post('/refund-sheet-user-search', [User::class, 'refundSheetUserSearch'])->name('refund.sheet.user.search');
Route::get('/get-refund-sheet-list', [User::class, 'getRefundSheetList'])->name('get.refund.sheet.list');
Route::post('/refundpaysetstatus', [User::class, 'refundpaysetstatus'])->name('refundpaysetstatus');
Route::get('/refundPayOtp/{email}/{id}', [User::class, 'refundPayOtp'])->name('refundPayOtp');
Route::get('/setrefundstatus', [User::class, 'setrefundstatus'])->name('setrefundstatus');

Route::get('/users-withdrawal-request', [User::class, 'userWithdrawalRequest'])->name('users.withdrawal.request');
Route::get('/get-user-withdrawal-list', [User::class, 'getUserWithdrawalList'])->name('get.user.withdrawal.list');

Route::get('/user-withdrawal-setstatus', [User::class, 'UserWithdrawalSetstatus'])->name('user.withdrawal.setstatus');
Route::get('/user-withdrawal-generateCid', [User::class, 'UserWithdrawalGenerateCid'])->name('user.withdrawal.generateCid');

Route::get('/self-payuser', [User::class, 'selfpayuser'])->name('self.payuser');

Route::get('/disapprove-self-pay-status', [User::class, 'disapproveSelfPayStatus'])->name('disapprove.self.pay.status');
Route::get('/self-pay-otp/{email}/{id}', [User::class, 'selfPayOtp'])->name('self.pay.otp');
Route::post('/approve-self-pay-status', [User::class, 'approveSelfPayStatus'])->name('approve.self.pay.status');

Route::get('/subadmin-module', [Subadmin::class, 'subadminModule'])->name('subadmin.module');
Route::get('/subadmin-add', [Subadmin::class, 'subadminAdd'])->name('subadmin.add');
Route::post('/submit-admin-module-form', [Subadmin::class, 'submitAdminModuleForm'])->name('submit.admin.module.form');
Route::post('/submit-edit-admin-module-form/{id}', [Subadmin::class, 'submitEditAdminModuleForm'])->name('submit.edit.admin.module.form');
Route::get('/subadmin-edit/{id}', [Subadmin::class, 'subadminEdit'])->name('subadmin.edit');

Route::get('/autokyc-module', [User::class, 'autokycModule'])->name('autokyc.module');
Route::get('/get-user-autokyc-list', [User::class, 'getUserAutokycList'])->name('get.user.autokyc.list');
Route::get('/autokyc-user-details/{id}', [User::class, 'autokycUserDetails'])->name('autokyc.user.details');
Route::get('/user-autokyc-reset', [User::class, 'userAutokycReset'])->name('user.autokyc.reset');
Route::get('/mannual-approve-kyc', [User::class, 'setKycstatus'])->name('mannual.approve.kyc');

Route::get('/weekly-earners', [User::class, 'weeklyEarners'])->name('weekly.earners');
Route::post('/weekly-earners-download', [User::class, 'weeklyEarnersDownload'])->name('weekly.earners.download');

Route::get('/find-user', [User::class, 'findUser'])->name('find.user');
Route::post('/submit-find-user-form', [User::class, 'submitFindUserForm'])->name('submit.find.user.form');
Route::get('/find-user-view/{id}', [User::class, 'findUserView'])->name('find.user.view');
Route::get('/find-user-delete/{id}', [User::class, 'findUserDelete'])->name('find.user.delete');
Route::post('/find-user-passwordupdate', [User::class, 'findUserPasswordUpdate'])->name('find.user.passwordupdate');
Route::post('/find-user-update-details', [User::class, 'findUserUpdateDetails'])->name('find.users.update.details');
Route::post('/viewNumber', [User::class, 'viewNumber'])->name('viewNumber');

Route::get('/sub-users-withdrawal-request', [User::class, 'subuserWithdrawalRequest'])->name('sub.users.withdrawal.request');
Route::get('/get-sub-user-withdrawal-list', [User::class, 'getsubUserWithdrawalList'])->name('get.sub.user.withdrawal.list');
Route::get('/generate-withdrawal-request-csv', [User::class, 'generateWithdrawalRequestCsv'])->name('generate.withdrawal.request.csv');

Route::get('/blog-category-list', [Blog::class, 'blogCategoryList'])->name('blog.category.list');
Route::get('/get-blog-category-list', [Blog::class, 'getBlogCategoryList'])->name('get.blog.category.list');
Route::get('/blog-category-add', [Blog::class, 'blogCategoryAdd'])->name('blog.category.add');
Route::post('/submit-blog-category-add-form', [Blog::class, 'submitBlogCategoryAddForm'])->name('submit.blog.category.add.form');
Route::get('/edit-blog-category/{id}', [Blog::class, 'editBlogCategory'])->name('edit.blog.category');
Route::post('/submit-edit-blog-category-form/{id}', [Blog::class, 'submitEditBlogCategoryForm'])->name('submit.edit.blog.category.form');
Route::post('/blog-category-setstatus', [Blog::class, 'setBlogCategoryStatus'])->name('blog.category.setstatus');

Route::get('/blog-list', [Blog::class, 'blogList'])->name('blog.list');
Route::get('/get-blog-list', [Blog::class, 'getBlogList'])->name('get.blog.list');
Route::get('/blog-add', [Blog::class, 'blogAdd'])->name('blog.add');
Route::post('/submit-blog-add-form', [Blog::class, 'submitBlogAddForm'])->name('submit.blog.add.form');
Route::get('/edit-blog/{id}', [Blog::class, 'editBlog'])->name('edit.blog');
Route::post('/submit-edit-blog-form/{id}', [Blog::class, 'submitEditBlogForm'])->name('submit.edit.blog.form');
Route::post('/blog-setstatus', [Blog::class, 'setStatus'])->name('blog.setstatus');

Route::get('/course-category-list', [Course::class, 'courseCategoryList'])->name('course.category.list');
Route::get('/get-course-category-list', [Course::class, 'getCourseCategoryList'])->name('get.course.category.list');
Route::get('/course-category-add', [Course::class, 'courseCategoryAdd'])->name('course.category.add');
Route::post('/submit-course-category-add-form', [Course::class, 'submitCourseCategoryAddForm'])->name('submit.course.category.add.form');
Route::post('/course-category-setstatus', [Course::class, 'setCourseCategoryStatus'])->name('course.category.setstatus');
Route::get('/edit-course-category/{id}', [Course::class, 'editCourseCategory'])->name('edit.course.category');
Route::post('/submit-edit-course-category-form/{id}', [Course::class, 'submitEditCourseCategoryForm'])->name('submit.edit.course.category.form');
Route::get('/view-course-category/{id}', [Course::class, 'viewCourseCategory'])->name('view.course.category');

Route::get('/course-list', [Course::class, 'courseList'])->name('course.list');
Route::get('/get-course-list', [Course::class, 'getCourseList'])->name('get.course.list');
Route::get('/course-add', [Course::class, 'courseAdd'])->name('course.add');
Route::post('/submit-course-add-form', [Course::class, 'submitCourseAddForm'])->name('submit.course.add.form');
Route::post('/course-setstatus', [Course::class, 'setCourseStatus'])->name('course.setstatus');
Route::get('/edit-course/{id}', [Course::class, 'editCourse'])->name('edit.course');
Route::post('/submit-edit-course-form/{id}', [Course::class, 'submitEditCourseForm'])->name('submit.edit.course.form');
Route::get('/view-course/{id}', [Course::class, 'viewCourse'])->name('view.course');

Route::get('/courses-list', [Course::class, 'coursesList'])->name('courses.list');
Route::get('/get-courses-list', [Course::class, 'getCoursesList'])->name('get.courses.list');
Route::post('/courses-setstatus', [Course::class, 'setCoursesStatus'])->name('courses.setstatus');
Route::get('/courses-add', [Course::class, 'coursesAdd'])->name('courses.add');
Route::post('/submit-courses-add-form', [Course::class, 'submitCoursesAddForm'])->name('submit.courses.add.form');
Route::get('/edit-courses/{id}', [Course::class, 'editCourses'])->name('edit.courses');
Route::post('/submit-edit-courses-form/{id}', [Course::class, 'submitEditCoursesForm'])->name('submit.edit.courses.form');

Route::get('/courses-details-list', [Course::class, 'coursesDetailsList'])->name('courses.details.list');
Route::get('/get-courses-details-list', [Course::class, 'getCoursesDetailsList'])->name('get.courses.details.list');
Route::post('/courses-details-setstatus', [Course::class, 'setCoursesDetailsStatus'])->name('courses.details.setstatus');
Route::get('/courses-details-add', [Course::class, 'coursesDetailsAdd'])->name('courses.details.add');
Route::post('/submit-courses-details-add-form', [Course::class, 'submitCoursesDetailsAddForm'])->name('submit.courses.details.add.form');
Route::get('/edit-courses-details/{id}', [Course::class, 'editCoursesDetails'])->name('edit.courses.details');
Route::post('/submit-edit-courses-details-form/{id}', [Course::class, 'submitEditCoursesDetailsForm'])->name('submit.edit.courses.details.form');

Route::get('/courses-extra', [Course::class, 'coursesExtraList'])->name('courses.extra');
Route::get('/get-courses-extra-list', [Course::class, 'getCoursesExtraList'])->name('get.courses.extra.list');
Route::post('/courses-extra-setstatus', [Course::class, 'setCoursesExtraStatus'])->name('courses.extra.setstatus');
Route::get('/courses-extra-add', [Course::class, 'coursesExtraAdd'])->name('courses.extra.add');
Route::post('/submit-courses-extra-add-form', [Course::class, 'submitCoursesExtraAddForm'])->name('submit.courses.extra.add.form');
Route::get('/edit-courses-extra/{id}', [Course::class, 'editCoursesExtra'])->name('edit.courses.extra');
Route::post('/submit-edit-courses-extra-form/{id}', [Course::class, 'submitEditCoursesExtraForm'])->name('submit.edit.courses.extra.form');

Route::get('/courses-reviews', [Course::class, 'coursesReviewsList'])->name('courses.reviews');
Route::get('/get-courses-reviews-list', [Course::class, 'getCoursesReviewsList'])->name('get.courses.reviews.list');
Route::post('/courses-reviews-setstatus', [Course::class, 'setCoursesReviewsStatus'])->name('courses.reviews.setstatus');
Route::get('/courses-reviews-add', [Course::class, 'coursesReviewsAdd'])->name('courses.reviews.add');
Route::post('/submit-courses-reviews-add-form', [Course::class, 'submitCoursesReviewsAddForm'])->name('submit.courses.reviews.add.form');
Route::get('/edit-courses-reviews/{id}', [Course::class, 'editCoursesReviews'])->name('edit.courses.reviews');
Route::post('/submit-edit-courses-reviews-form/{id}', [Course::class, 'submitEditCoursesReviewsForm'])->name('submit.edit.courses.reviews.form');

Route::get('/parent-category', [Course::class, 'parentCategory'])->name('parent.category');
Route::get('/get-parent-category-list', [Course::class, 'getparentCategoryList'])->name('get.parent.category.list');
Route::get('/parent-category-add', [Course::class, 'parentCategoryAdd'])->name('parent.category.add');
Route::post('/submit-parent-category-add-form', [Course::class, 'submitparentCategoryAddForm'])->name('submit.parent.category.add.form');
Route::post('/parent-category-setstatus', [Course::class, 'setparentCategoryStatus'])->name('parent.category.setstatus');
Route::get('/edit-parent-category/{id}', [Course::class, 'editparentCategory'])->name('edit.parent.category');
Route::post('/submit-edit-parent-category-form/{id}', [Course::class, 'submitEditParentCategoryForm'])->name('submit.edit.parent.category.form');

Route::get('/course-extra', [Course::class, 'courseExtra'])->name('course.extra');
Route::get('/get-course-extra-list', [Course::class, 'getcourseExtraList'])->name('get.course.extra.list');
Route::post('/course-extra-setstatus', [Course::class, 'setcourseExtraStatus'])->name('course.extra.setstatus');
Route::get('/edit-course-extra/{id}', [Course::class, 'editCourseExtra'])->name('edit.course.extra');
Route::post('/submit-edit-course-extra-form/{id}', [Course::class, 'submitEditCourseExtraForm'])->name('submit.edit.course.extra.form');
Route::get('/course-extra-add', [Course::class, 'courseExtraAdd'])->name('course.extra.add');
Route::post('/submit-course-extra-add-form', [Course::class, 'submitcourseExtraAddForm'])->name('submit.course.extra.add.form');

Route::get('/instructor', [Course::class, 'instructor'])->name('instructor');
Route::get('/get-instructor-list', [Course::class, 'getinstructorList'])->name('get.instructor.list');
Route::post('/instructor-setstatus', [Course::class, 'setinstructorStatus'])->name('instructor.setstatus');
Route::get('/edit-instructor/{id}', [Course::class, 'editinstructor'])->name('edit.instructor');
Route::post('/submit-edit-instructor-form/{id}', [Course::class, 'submitEditinstructorForm'])->name('submit.edit.instructor.form');
Route::get('/instructor-add', [Course::class, 'instructorAdd'])->name('instructor.add');
Route::post('/submit-instructor-add-form', [Course::class, 'submitinstructorAddForm'])->name('submit.instructor.add.form');

Route::get('/instructor-reviews', [Course::class, 'instructorReviewsList'])->name('instructor.reviews');
Route::get('/get-instructor-reviews-list', [Course::class, 'getInstructorReviewsList'])->name('get.instructor.reviews.list');
Route::post('/instructor-reviews-setstatus', [Course::class, 'setInstructorReviewsStatus'])->name('instructor.reviews.setstatus');
Route::get('/instructor-reviews-add', [Course::class, 'instructorReviewsAdd'])->name('instructor.reviews.add');
Route::post('/submit-instructor-reviews-add-form', [Course::class, 'submitInstructorReviewsAddForm'])->name('submit.instructor.reviews.add.form');
Route::get('/edit-instructor-reviews/{id}', [Course::class, 'editInstructorReviews'])->name('edit.instructor.reviews');
Route::post('/submit-edit-instructor-reviews-form/{id}', [Course::class, 'submitEditInstructorReviewsForm'])->name('submit.edit.instructor.reviews.form');

Route::get('/course-forum', [Course::class, 'courseForumList'])->name('course.forum');
Route::get('/get-course-forum-list', [Course::class, 'getCourseForumList'])->name('get.course.forum.list');
Route::get('/edit-course-forum/{id}', [Course::class, 'editCourseForum'])->name('edit.course.forum');
Route::post('/submit-edit-course-forum/{id}', [Course::class, 'submitEditCourseForum'])->name('submit.edit.course.forum');
Route::post('/course-forum-setstatus', [Course::class, 'setCourseForumStatus'])->name('course.forum.setstatus');

Route::get('/trainning-categories', [Course::class, 'trainningCategories'])->name('trainning.categories');
Route::get('/get-trainning-categories-list', [Course::class, 'gettrainningCategoriesList'])->name('get.trainning.categories.list');
Route::post('/trainning-category-setstatus', [Course::class, 'setTrainningCategoryStatus'])->name('trainning.category.setstatus');
Route::get('/edit-trainning-category/{id}', [Course::class, 'editTrainningCategory'])->name('edit.trainning.category');
Route::post('/submit-edit-trainning-category-form/{id}', [Course::class, 'submitEditTrainningCategoryForm'])->name('submit.edit.trainning.category.form');
Route::get('/trainning-category-add', [Course::class, 'trainningCategoryAdd'])->name('trainning.category.add');
Route::post('/submit-trainning-category-add-form', [Course::class, 'submittrainningCategoryAddForm'])->name('submit.trainning.category.add.form');

Route::get('/webinar', [Course::class, 'webinar'])->name('webinar');
Route::get('/get-webinar-list', [Course::class, 'getWebinarList'])->name('get.webinar.list');
Route::post('/webinar-setstatus', [Course::class, 'setwebinarStatus'])->name('webinar.setstatus');
Route::get('/edit-webinar/{id}', [Course::class, 'editwebinar'])->name('edit.webinar');
Route::post('/submit-edit-webinar-form/{id}', [Course::class, 'submitEditWebinarForm'])->name('submit.edit.webinar.form');
Route::get('/webinar-add', [Course::class, 'webinarAdd'])->name('webinar.add');
Route::post('/submit-webinar-add-form', [Course::class, 'submitwebinarAddForm'])->name('submit.webinar.add.form');

Route::get('/ten-days-trainning', [Course::class, 'tenDaysTrainning'])->name('ten.days.trainning');
Route::get('/get-ten-days-trainning-list', [Course::class, 'getTenDaysTrainningList'])->name('get.ten.days.trainning.list');
Route::post('/ten-days-trainning-setstatus', [Course::class, 'setTenDaysTrainningStatus'])->name('ten.days.trainning.setstatus');
Route::get('/edit-ten-days-trainning/{id}', [Course::class, 'editTenDaysTrainning'])->name('edit.ten.days.trainning');
Route::post('/submit-edit-ten-days-trainning-form/{id}', [Course::class, 'submitEditTenDaysTrainningForm'])->name('submit.edit.ten.days.trainning.form');
Route::get('/ten-days-trainning-add', [Course::class, 'TenDaysTrainningAdd'])->name('ten.days.trainning.add');
Route::post('/submit-ten-days-trainning-add-form', [Course::class, 'submitTenDaysTrainningAddForm'])->name('submit.ten.days.trainning.add.form');

Route::get('/freelance-trainning-admin', [Course::class, 'freelanceTrainning'])->name('freelance.trainning.admin');
Route::get('/get-freelance-trainning-list', [Course::class, 'getfreelanceTrainningList'])->name('get.freelance.trainning.list');
Route::post('/freelance-trainning-setstatus', [Course::class, 'setfreelanceTrainningStatus'])->name('freelance.trainning.setstatus');
Route::get('/edit-freelance-trainning/{id}', [Course::class, 'editfreelanceTrainning'])->name('edit.freelance.trainning');
Route::post('/submit-edit-freelance-trainning-form/{id}', [Course::class, 'submitEditfreelanceTrainningForm'])->name('submit.edit.freelance.trainning.form');
Route::get('/freelance-trainning-add', [Course::class, 'freelanceTrainningAdd'])->name('freelance.trainning.add');
Route::post('/submit-freelance-trainning-add-form', [Course::class, 'submitfreelanceTrainningAddForm'])->name('submit.freelance.trainning.add.form');

Route::get('/quiz-category', [Course::class, 'quizCategory'])->name('quiz.category');
Route::get('/get-quiz-category-list', [Course::class, 'getQuizCategoryList'])->name('get.quiz.category.list');
Route::get('/edit-quiz-category/{id}', [Course::class, 'editQuizCategory'])->name('edit.quiz.category');
Route::post('/submit-edit-quiz-category-form/{id}', [Course::class, 'submitEditQuizCategoryForm'])->name('submit.edit.quiz.category.form');
Route::get('/quiz-category-add', [Course::class, 'QuizCategoryAdd'])->name('quiz.category.add');
Route::post('/submit-quiz-category-add-form', [Course::class, 'submitQuizCategoryAddForm'])->name('submit.quiz.category.add.form');

Route::get('/quiz-question', [Course::class, 'quizQuestion'])->name('quiz.question');
Route::get('/get-quiz-question-list', [Course::class, 'getQuizQuestionList'])->name('get.quiz.question.list');
Route::get('/edit-quiz-question/{id}', [Course::class, 'editQuizQuestion'])->name('quiz.question.add');
Route::post('/submit-edit-quiz-question-form/{id}', [Course::class, 'submitEditQuizQuestionForm'])->name('submit.edit.quiz.question.form');
Route::get('/quiz-question-add', [Course::class, 'QuizQuestionAdd'])->name('quiz.question.add');
Route::post('/submit-quiz-question-add-form', [Course::class, 'submitQuizQuestionAddForm'])->name('submit.quiz.question.add.form');

Route::get('/gift-task', [Offer::class, 'giftTask'])->name('gift.task');
Route::get('/get-gift-task-list', [Offer::class, 'getGiftTaskList'])->name('get.gift.task.list');
Route::post('/gift-task-setstatus', [Offer::class, 'setGiftTaskStatus'])->name('gift.task.setstatus');
Route::get('/edit-gift-task/{id}', [Offer::class, 'editGiftTask'])->name('edit.gift.task');
Route::post('/submit-edit-gift-task-form/{id}', [Offer::class, 'submitEditGiftTaskForm'])->name('submit.edit.gift.task.form');
Route::get('/gift-task-add', [Offer::class, 'GiftTaskAdd'])->name('gift.task.add');
Route::post('/submit-gift-task-add-form', [Offer::class, 'submitGiftTaskAddForm'])->name('submit.gift.task.add.form');

Route::get('/offer', [Offer::class, 'offer'])->name('offer');
Route::get('/get-offer-list', [Offer::class, 'getOfferList'])->name('get.offer.list');
Route::post('/offer-setstatus', [Offer::class, 'setOfferStatus'])->name('offer.setstatus');
Route::get('/edit-offer/{id}', [Offer::class, 'editOffer'])->name('edit.offer');
Route::post('/submit-edit-offer-form/{id}', [Offer::class, 'submitEditOfferForm'])->name('submit.edit.offer.form');
Route::get('/offer-add', [Offer::class, 'OfferAdd'])->name('offer.add');
Route::post('/submit-offer-add-form', [Offer::class, 'submitOfferAddForm'])->name('submit.offer.add.form');

Route::get('/prime-referral-day', [Offer::class, 'primeReferralDay'])->name('prime.referral.day');
Route::get('/prime-referral-day-list', [Offer::class, 'getPrimeReferralDayList'])->name('get.prime.referral.day.list');
Route::post('/prime-referral-day-setstatus', [Offer::class, 'setPrimeReferralDayStatus'])->name('prime.referral.day.setstatus');
Route::get('/edit-prime-referral-day/{id}', [Offer::class, 'editPrimeReferralDay'])->name('edit.prime.referral.day');
Route::post('/submit-edit-prime-referral-day-form/{id}', [Offer::class, 'submitEditPrimeReferralDayForm'])->name('submit.edit.prime.referral.day.form');
Route::get('/prime-referral-day-add', [Offer::class, 'PrimeReferralDayAdd'])->name('prime.referral.day.add');
Route::post('/submit-prime-referral-day-add-form', [Offer::class, 'submitPrimeReferralDayAddForm'])->name('submit.prime.referral.day.add.form');

Route::get('/prime-alternate-referral-day', [Offer::class, 'primeAlternateReferralDay'])->name('prime.alternate.referral.day');
Route::get('/prime-alternate-referral-day-list', [Offer::class, 'getPrimeAlternateReferralDayList'])->name('get.prime.alternate.referral.day.list');
Route::post('/prime-alternate-referral-day-setstatus', [Offer::class, 'setPrimeAlternateReferralDayStatus'])->name('prime.alternate.referral.day.setstatus');
Route::get('/edit-prime-alternate-referral-day/{id}', [Offer::class, 'editPrimeAlternateReferralDay'])->name('edit.prime.alternate.referral.day');
Route::post('/submit-edit-prime-alternate-referral-day-form/{id}', [Offer::class, 'submitEditPrimeAlternateReferralDayForm'])->name('submit.edit.prime.alternate.referral.day.form');
Route::get('/prime-alternate-referral-day-add', [Offer::class, 'PrimeAlternateReferralDayAdd'])->name('prime.alternate.referral.day.add');
Route::post('/submit-prime-alternate-referral-day-add-form', [Offer::class, 'submitPrimeAlternateReferralDayAddForm'])->name('submit.prime.alternate.referral.day.add.form');

Route::get('/cashback-offer', [Offer::class, 'cashbackOffer'])->name('cashback.offer');
Route::get('/cashback-offer-list', [Offer::class, 'getcashbackOfferList'])->name('get.cashback.offer.list');
Route::post('/cashback-offer-setstatus', [Offer::class, 'setcashbackOfferStatus'])->name('cashback.offer.setstatus');
Route::get('/edit-cashback-offer/{id}', [Offer::class, 'editcashbackOffer'])->name('edit.cashback.offer');
Route::post('/submit-edit-cashback-offer-form/{id}', [Offer::class, 'submitEditcashbackOfferForm'])->name('submit.edit.cashback.offer.form');
Route::get('/cashback-offer-add', [Offer::class, 'cashbackOfferAdd'])->name('cashback.offer.add');
Route::post('/submit-cashback-offer-add-form', [Offer::class, 'submitcashbackOfferAddForm'])->name('submit.cashback.offer.add.form');

Route::get('/banner', [Extra::class, 'banner'])->name('banner');
Route::post('/submit-banner-add-form', [Extra::class, 'submitBannerAddForm'])->name('submit.banner.add.form');

Route::get('/mkt-category', [Marketingtools::class, 'mktCategory'])->name('mkt.category');
Route::get('/mkt-category-list', [Marketingtools::class, 'getmktCategoryList'])->name('get.mkt.category.list');
Route::post('/mkt-category-setstatus', [Marketingtools::class, 'setmktCategoryStatus'])->name('mkt.category.setstatus');
Route::get('/edit-mkt-category/{id}', [Marketingtools::class, 'editmktCategory'])->name('edit.mkt.category');
Route::post('/submit-edit-mkt-category-form/{id}', [Marketingtools::class, 'submitEditmktCategoryForm'])->name('submit.edit.mkt.category.form');
Route::get('/mkt-category-add', [Marketingtools::class, 'mktCategoryAdd'])->name('mkt.category.add');
Route::post('/submit-mkt-category-add-form', [Marketingtools::class, 'submitmktCategoryAddForm'])->name('submit.mkt.category.add.form');

Route::get('/mkt-legal', [Marketingtools::class, 'mktlegal'])->name('mkt.legal');
Route::get('/mkt-legal-list', [Marketingtools::class, 'getmktlegalList'])->name('get.legal.list');
Route::post('/mkt-legal-setstatus', [Marketingtools::class, 'setmktlegalStatus'])->name('mkt.legal.setstatus');
Route::get('/edit-mkt-legal/{id}', [Marketingtools::class, 'editmktlegal'])->name('edit.mkt.legal');
Route::post('/submit-edit-mkt-legal-form/{id}', [Marketingtools::class, 'submitEditmktlegalForm'])->name('submit.edit.mkt.legal.form');
Route::get('/mkt-legal-add', [Marketingtools::class, 'mktlegalAdd'])->name('mkt.legal.add');
Route::post('/submit-mkt-legal-add-form', [Marketingtools::class, 'submitmktlegalAddForm'])->name('submit.mkt.legal.add.form');

Route::get('/mkt-conclave-diaries', [Marketingtools::class, 'mktConclaveDiaries'])->name('mkt.conclave.diaries');
Route::get('/mkt-conclave-diaries-list', [Marketingtools::class, 'getmktConclaveDiariesList'])->name('get.conclave.diaries.list');
Route::post('/mkt-conclave-diaries-setstatus', [Marketingtools::class, 'setmktConclaveDiariesStatus'])->name('mkt.conclave.diaries.setstatus');
Route::get('/edit-mkt-conclave-diaries/{id}', [Marketingtools::class, 'editmktConclaveDiaries'])->name('edit.mkt.conclave.diaries');
Route::post('/submit-edit-mkt-conclave-diaries-form/{id}', [Marketingtools::class, 'submitEditmktConclaveDiariesForm'])->name('submit.edit.mkt.conclave.diaries.form');
Route::get('/mkt-conclave-diaries-add', [Marketingtools::class, 'mktConclaveDiariesAdd'])->name('mkt.conclave.diaries.add');
Route::post('/submit-mkt-conclave-diaries-add-form', [Marketingtools::class, 'submitmktConclaveDiariesAddForm'])->name('submit.mkt.conclave.diaries.add.form');

Route::get('/mkt-affiliate-experience', [Marketingtools::class, 'mktAffiliateExperience'])->name('mkt.affiliate.experience');
Route::get('/mkt-affiliate-experience-list', [Marketingtools::class, 'getmktAffiliateExperienceList'])->name('get.affiliate.experience.list');
Route::post('/mkt-affiliate-experience-setstatus', [Marketingtools::class, 'setmktAffiliateExperienceStatus'])->name('mkt.affiliate.experience.setstatus');
Route::get('/edit-mkt-affiliate-experience/{id}', [Marketingtools::class, 'editmktAffiliateExperience'])->name('edit.mkt.affiliate.experience');
Route::post('/submit-edit-mkt-affiliate-experience-form/{id}', [Marketingtools::class, 'submitEditmktAffiliateExperienceForm'])->name('submit.edit.mkt.affiliate.experience.form');
Route::get('/mkt-affiliate-experience-add', [Marketingtools::class, 'mktAffiliateExperienceAdd'])->name('mkt.affiliate.experience.add');
Route::post('/submit-mkt-affiliate-experience-add-form', [Marketingtools::class, 'submitmktAffiliateExperienceAddForm'])->name('submit.mkt.affiliate.experience.add.form');

Route::get('/mkt-freelancing', [Marketingtools::class, 'mktFreelancing'])->name('mkt.freelancing');
Route::get('/mkt-freelancing-list', [Marketingtools::class, 'getmktFreelancingList'])->name('get.mkt.freelancing.list');
Route::post('/mkt-freelancing-setstatus', [Marketingtools::class, 'setmktFreelancingStatus'])->name('mkt.freelancing.setstatus');
Route::get('/edit-mkt-freelancing/{id}', [Marketingtools::class, 'editmktFreelancing'])->name('edit.mkt.freelancing');
Route::post('/submit-edit-mkt-freelancing-form/{id}', [Marketingtools::class, 'submitEditmktFreelancingForm'])->name('submit.edit.mkt.freelancing.form');
Route::get('/mkt-freelancing-add', [Marketingtools::class, 'mktFreelancingAdd'])->name('mkt.freelancing.add');
Route::post('/submit-mkt-freelancing-add-form', [Marketingtools::class, 'submitmktFreelancingAddForm'])->name('submit.mkt.freelancing.add.form');

Route::get('/mkt-south', [Marketingtools::class, 'mktSouth'])->name('mkt.south');
Route::get('/mkt-south-list', [Marketingtools::class, 'getmktSouthList'])->name('get.mkt.south.list');
Route::post('/mkt-south-setstatus', [Marketingtools::class, 'setmktSouthStatus'])->name('mkt.south.setstatus');
Route::get('/edit-mkt-south/{id}', [Marketingtools::class, 'editmktSouth'])->name('edit.mkt.south');
Route::post('/submit-edit-mkt-south-form/{id}', [Marketingtools::class, 'submitEditmktSouthForm'])->name('submit.edit.mkt.south.form');
Route::get('/mkt-south-add', [Marketingtools::class, 'mktSouthAdd'])->name('mkt.south.add');
Route::post('/submit-mkt-south-add-form', [Marketingtools::class, 'submitmktSouthAddForm'])->name('submit.mkt.south.add.form');

Route::get('/sunday-blockbusters', [SundayBlockbuster::class, 'sundayBlockbuster'])->name('sunday.blockbusters');
Route::get('/sunday-blockbuster-list', [SundayBlockbuster::class, 'getsundayBlockbusterList'])->name('get.sunday.blockbuster.list');
Route::post('/sunday-blockbuster-setstatus', [SundayBlockbuster::class, 'setsundayBlockbusterStatus'])->name('sunday.blockbuster.setstatus');
Route::get('/edit-sunday-blockbuster/{id}', [SundayBlockbuster::class, 'editsundayBlockbuster'])->name('edit.sunday.blockbuster');
Route::post('/submit-edit-sunday-blockbuster-form/{id}', [SundayBlockbuster::class, 'submitEditsundayBlockbusterForm'])->name('submit.edit.sunday.blockbuster.form');
Route::get('/sunday-blockbuster-add', [SundayBlockbuster::class, 'sundayBlockbusterAdd'])->name('sunday.blockbuster.add');
Route::post('/submit-sunday-blockbuster-add-form', [SundayBlockbuster::class, 'submitsundayBlockbusterAddForm'])->name('submit.sunday.blockbuster.add.form');

Route::get('/sunday-blockbuster-form-data', [SundayBlockbuster::class, 'sundayBlockbusterFormData'])->name('sunday.blockbuster.form.data');
Route::get('/sunday-blockbuster-form-data-list', [SundayBlockbuster::class, 'getsundayBlockbusterFormDataList'])->name('get.sunday.blockbuster.form.data.list');

Route::get('/sunday-blockbuster-feedback', [SundayBlockbuster::class, 'sundayBlockbusterFeedback'])->name('sunday.blockbuster.feedback');
Route::get('/sunday-blockbuster-feedback-list', [SundayBlockbuster::class, 'getsundayBlockbusterFeedbackList'])->name('get.sunday.blockbuster.feedback.list');

Route::get('/freelancer', [SundayBlockbuster::class, 'freelancer'])->name('freelancer');
Route::get('/freelancer-list', [SundayBlockbuster::class, 'getfreelancerList'])->name('get.freelancer.list');
Route::post('/freelancer-reject-mail', [SundayBlockbuster::class, 'rejectMail'])->name('freelancer.reject.mail');

Route::get('/freelance-category-list', [Freelance::class, 'freelanceCategoryList'])->name('freelance.category.list');
Route::get('/get-freelance-category-list', [Freelance::class, 'getFreelanceCategoryList'])->name('get.freelance.category.list');
Route::get('/freelance-category-add', [Freelance::class, 'freelanceCategoryAdd'])->name('freelance.category.add');
Route::post('/submit-freelance-category-add-form', [Freelance::class, 'submitFreelanceCategoryAddForm'])->name('submit.freelance.category.add.form');
Route::get('/edit-freelance-category/{id}', [Freelance::class, 'editFreelanceCategory'])->name('edit.freelance.category');
Route::post('/submit-edit-freelance-category-form/{id}', [Freelance::class, 'submitEditFreelanceCategoryForm'])->name('submit.edit.freelance.category.form');
Route::post('/freelance-category-setstatus', [Freelance::class, 'setFreelanceCategoryStatus'])->name('freelance.category.setstatus');

Route::get('/get-freelance-user-record', [Freelance::class, 'getFreelanceUserRecord'])->name('get.freelance.user.record');
Route::get('/freelance-testimony-list', [Freelance::class, 'freelanceTestimonyList'])->name('freelance.testimony.list');
Route::get('/get-freelance-testimony-list', [Freelance::class, 'getFreelanceTestimonyList'])->name('get.freelance.testimony.list');
Route::get('/freelance-testimony-add', [Freelance::class, 'freelanceTestimonyAdd'])->name('freelance.testimony.add');
Route::post('/submit-freelance-testimony-add-form', [Freelance::class, 'submitFreelanceTestimonyAddForm'])->name('submit.freelance.testimony.add.form');
Route::get('/edit-freelance-testimony/{id}', [Freelance::class, 'editFreelanceTestimony'])->name('edit.freelance.testimony');
Route::post('/submit-edit-freelance-testimony-form/{id}', [Freelance::class, 'submitEditFreelanceTestimonyForm'])->name('submit.edit.freelance.testimony.form');
Route::post('/freelance-testimony-setstatus', [Freelance::class, 'setFreelanceTestimonyStatus'])->name('freelance.testimony.setstatus');

Route::get('/cms-page', [Extra::class, 'cmsPage'])->name('cms.page');
Route::get('/cms-page-list', [Extra::class, 'getcmsPageList'])->name('get.cms.page.list');
Route::get('/edit-cms-page/{id}', [Extra::class, 'editcmsPage'])->name('edit.cms.page');
Route::post('/submit-edit-cms-page-form/{id}', [Extra::class, 'submitEditcmsPageForm'])->name('submit.edit.cms.page.form');
Route::get('/cms-page-add', [Extra::class, 'cmsPageAdd'])->name('cms.page.add');
Route::post('/submit-cms-page-add-form', [Extra::class, 'submitcmsPageAddForm'])->name('submit.cms.page.add.form');

Route::get('/testimonial', [Extra::class, 'testimonial'])->name('testimonial');
Route::get('/testimonial-list', [Extra::class, 'gettestimonialList'])->name('get.testimonial.list');
Route::get('/edit-testimonial/{id}', [Extra::class, 'edittestimonial'])->name('edit.testimonial');
Route::post('/submit-edit-testimonial-form/{id}', [Extra::class, 'submitEdittestimonialForm'])->name('submit.edit.testimonial.form');
Route::get('/testimonial-add', [Extra::class, 'testimonialAdd'])->name('testimonial.add');
Route::post('/submit-testimonial-add-form', [Extra::class, 'submittestimonialAddForm'])->name('submit.testimonial.add.form');
Route::post('/testimonial-setstatus', [Extra::class, 'settestimonialStatus'])->name('testimonial.setstatus');

Route::get('/industry-earning', [SundayBlockbuster::class, 'industryEarning'])->name('industry.earning');
Route::get('/industry-earning-list', [SundayBlockbuster::class, 'getindustryEarningList'])->name('get.industry.earning.list');
Route::get('/set-industry-earning-status/{status}/{id}', [SundayBlockbuster::class, 'setindustryEarningStatus'])->name('set.industry.earning.status');

Route::get('/top-performer', [SundayBlockbuster::class, 'topPerformer'])->name('top.performer');
Route::get('/top-performer-list', [SundayBlockbuster::class, 'topPerformerList'])->name('get.top.performer.list');
// admin route ends
