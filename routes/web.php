<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerController;

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
Route::get('phpmyinfo', function () {
    phpinfo(); 
})->name('phpmyinfo');


Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('userlogin', [AuthController::class, 'userLogin'])->name('login.post'); 
Route::post('adminlogin', [AuthController::class, 'adminLogin'])->name('login.admin'); 
Route::post('cslogin', [AuthController::class, 'customerServiceLogin'])->name('login.cs'); 


Route::get('registration', [AuthController::class, 'registration'])->name('register');
Route::post('post-registration', [AuthController::class, 'postRegistration'])->name('register.post'); 
Route::get('', [CustomerController::class, 'interested'])->name('rsvp.home'); 

Route::group(['namespace' => 'App\Http\Controllers', 'prefix' => 'rsvp'], function() {
    Route::get('interested/{fd?}', [CustomerController::class, 'interested'])->name('rsvp.check'); 
    Route::get('tnc', [CustomerController::class, 'tnc'])->name('rsvp.tnc');
    Route::get('landing/{fd?}', [CustomerController::class, 'landing'])->name('rsvp.landing');
    Route::get('detail/{fd?}', [CustomerController::class, 'detail'])->name('rsvp.detail');
    Route::post('interested/{fd?}', [CustomerController::class, 'interested'])->name('rsvp.check'); 
    Route::get('register/{fd?}', [CustomerController::class, 'register'])->name('rsvp');
    Route::post('thankyou', [CustomerController::class, 'rsvp'])->name('rsvp.post'); 
    Route::get('email', [CustomerController::class, 'email'])->name('rsvp.email'); 
});

Route::get('email-test', function(){
    $details['email'] = 'midoff1@gmail.com';
    dispatch(new App\Jobs\SendEmailJob($details));
    dd('done');
});

// Route::get('', function() {
//     return redirect()->route('rsvp.home');
// });

Route::get('changelog', function() {

    return view('changelog');
})->name('changelog');

Route::group(['namespace' => 'App\Http\Controllers\Partner', 'prefix' => 'p'], function() {

    Route::get('dashboard', 'PageController@dashboard')->name('partner.dashboard');
    Route::get('logout', 'Auth\LoginController@logout')->name('partner.logout');
    Route::get('team', 'TeamController@showTeamPage')->name('partner.showTeamPage');

    //reports
    Route::get('membersAndDownlinesReport', 'ReportController@membersAndDownlinesReport')->name('partner.reports.membersAndDownlinesReport');
    Route::get('memberDownlinesReport/{id}', 'ReportController@memberDownlinesReport')->name('partner.reports.memberDownlinesReport');
    Route::get('membersWithdrawReport', 'ReportController@membersWithdrawReport')->name('partner.reports.membersWithdrawReport');
    Route::get('guaranteeClaimReport', 'ReportController@guaranteeClaimReport')->name('partner.reports.guaranteeClaimReport');
    Route::get('protectionReport', 'ReportController@protectionReport')->name('partner.reports.protectionReport');
    Route::get('insurancePointReport', 'ReportController@insurancePointReport')->name('partner.reports.insurancePointReport');
    Route::get('insurancePointReportById/{id}', 'ReportController@insurancePointReportById')->name('partner.reports.insurancePointReportById'); 
    Route::get('bonusReport', 'ReportController@bonusReport')->name('partner.reports.bonusReport');
    Route::get('bonusReportById/{id}', 'ReportController@bonusReportById')->name('partner.reports.bonusReportById');


});

Route::group(['namespace' => 'App\Http\Controllers\Member'], function() {
    Route::get('login', 'Auth\LoginController@showLoginForm')->name('member.showLoginForm');
    Route::post('login', 'Auth\LoginController@login')->name('member.postLogin');
    Route::get('logout', 'Auth\LoginController@logout')->name('member.logout');

    // Route::get('password', 'ProfileController@showPasswordForm')->name('member.showPasswordForm');
    // Route::post('password', 'ProfileController@changePassword')->name('member.changePassword');

    Route::get('dashboard', 'PageController@dashboard')->name('member.dashboard');  
    Route::get('scan', 'PageController@scan')->name('member.scan'); 
    Route::get('scan2', 'PageController@scan2')->name('member.scan2'); 
    Route::get('scan3', 'PageController@scan3')->name('member.scan3'); 
    Route::get('scan4', 'PageController@scan4')->name('member.scan4'); 
    Route::get('redemption_scan', 'PageController@redemption_scan')->name('member.redemption_scan');
    Route::get('engagement_scan', 'PageController@engagement_scan')->name('member.engagement_scan');
    Route::get('engagement_scan2', 'PageController@engagement_scan2')->name('member.engagement_scan2');
    Route::get('generateQR', 'PageController@generateQR')->name('member.generateQR');
    Route::get('generateQR2', 'PageController@generateQR2')->name('member.generateQR2');
    Route::post('checkIn', 'PageController@checkIn')->name('member.checkIn');
    Route::post('redemption', 'PageController@redemption')->name('member.redemption');
    Route::post('engagement', 'PageController@engagement')->name('member.engagement');
});

Route::group(['namespace' => 'App\Http\Controllers\CustomerService', 'prefix' => 'cs'], function() {
    Route::get('login', 'Auth\LoginController@showLoginForm')->name('cs.showLoginForm');
    Route::post('login', 'Auth\LoginController@login')->name('cs.postLogin');
    Route::get('logout', 'Auth\LoginController@logout')->name('cs.logout');

    Route::get('dashboard', 'PageController@dashboard')->name('cs.dashboard');
    Route::get('getNotification', 'PageController@getNotification')->name('cs.getNotification');
    // Route::get('notification', 'PageController@showNotification')->name('cs.showNotification');

    Route::get('approval/guarantee', 'ApprovalController@showGuarantee')->name('cs.approval.showGuarantee');
    Route::get('approval/withdrawal', 'ApprovalController@showWithdrawal')->name('cs.approval.showWithdrawal');
    Route::get('approval/membership', 'ApprovalController@showMembership')->name('cs.approval.showMembership');
    Route::get('approval/insurance', 'ApprovalController@showInsurance')->name('cs.approval.showInsurance');
    Route::get('approval/showApprovalList', 'ApprovalController@showApprovalList')->name('cs.approval.showApprovalList');
    Route::post('approveClaim', 'ApprovalController@approveClaim')->name('cs.approveClaim');
    Route::post('approveBonusWithdraw', 'ApprovalController@approveBonusWithdraw')->name('cs.approveBonusWithdraw');
    Route::post('approveUser', 'ApprovalController@approveUser')->name('cs.approveUser');
    Route::post('rejectUser', 'ApprovalController@rejectUser')->name('cs.rejectUser');
    Route::post('approveInsurancePoint', 'ApprovalController@approveInsurancePoint')->name('cs.approveInsurancePoint');
    Route::get('bonusPool', 'BonusController@showBonusPoolList')->name('cs.showBonusPoolList');

    Route::get('members', 'MemberController@showMemberList')->name('cs.showMemberList');
    Route::post('imports', 'MemberController@importReport')->name('cs.importReport');
    Route::post('importDirectBonusesReports', 'MemberController@importDirectBonusesReport')->name('cs.importDirectBonusesReport');
    Route::post('exportUsers', 'MemberController@exportUsers')->name('cs.exportUsers');
    Route::get('member/{id?}', 'MemberController@showMemberDetail')->name('cs.showMemberDetail');
    Route::post('member', 'MemberController@postRegistration')->name('cs.postRegistration');
    Route::post('member/{id}', 'MemberController@editMember')->name('cs.editMember');
    Route::post('createBonus', 'MemberController@createBonus')->name('cs.createBonus');
    Route::post('updateBlockStatus', 'MemberController@updateBlockStatus')->name('cs.updateBlockStatus');
    Route::post('changePassword', 'MemberController@changePassword')->name('cs.changePassword');
    Route::post('addInsurancePoint', 'MemberController@addInsurancePoint')->name('cs.addInsurancePoint');

    Route::get('banner', 'PageController@showBannerForm')->name('cs.showBannerForm');
    Route::post('banner', 'PageController@selectBanner')->name('cs.selectBanner');
    Route::post('banner/uploadPhoto', 'PageController@uploadPhoto')->name('cs.uploadPhoto');

    Route::get('bank', 'BankController@showBankForm')->name('cs.showBankForm');
    Route::post('bank', 'BankController@uploadBankDetail')->name('cs.uploadBankDetail');

    //reports
    Route::get('membersAndDownlinesReport', 'ReportController@membersAndDownlinesReport')->name('cs.reports.membersAndDownlinesReport');
    Route::get('memberDownlinesReport/{id}', 'ReportController@memberDownlinesReport')->name('cs.reports.memberDownlinesReport');
    Route::get('membersWithdrawReport', 'ReportController@membersWithdrawReport')->name('cs.reports.membersWithdrawReport');
    Route::get('guaranteeClaimReport', 'ReportController@guaranteeClaimReport')->name('cs.reports.guaranteeClaimReport');
    Route::get('protectionReport', 'ReportController@protectionReport')->name('cs.reports.protectionReport');
    Route::get('insurancePointReport', 'ReportController@insurancePointReport')->name('cs.reports.insurancePointReport');
    Route::get('insurancePointReportById/{id}', 'ReportController@insurancePointReportById')->name('cs.reports.insurancePointReportById'); 
    Route::get('bonusReport', 'ReportController@bonusReport')->name('cs.reports.bonusReport');
    Route::get('bonusReportById/{id}', 'ReportController@bonusReportById')->name('cs.reports.bonusReportById');

    //history
    Route::get('history/guarantee', 'HistoryController@showGuarantee')->name('cs.history.showGuarantee');
    Route::get('history/withdrawal', 'HistoryController@showWithdrawal')->name('cs.history.showWithdrawal');
    Route::get('history/membership', 'HistoryController@showMembership')->name('cs.history.showMembership');
    Route::get('history/insurance', 'HistoryController@showInsurance')->name('cs.history.showInsurance');

    Route::post('updateMemberRank', 'ApprovalController@updateMemberRank')->name('cs.updateMemberRank');
    Route::post('updateBonusPool', 'BonusController@updateBonusPool')->name('cs.updateBonusPool');

});

Route::group(['namespace' => 'App\Http\Controllers\Helpers', 'prefix' => 'h'], function() {
    Route::post('findUserByUsername', 'UserController@findUserByUsername')->name('helpers.findUserByUsername');
});

Route::group(['namespace' => 'App\Http\Controllers\Helpers'], function() {
    Route::get('lang/{locale}', 'LocalizationController@index')->name('helpers.localization');
});

Route::group(['namespace' => 'App\Http\Controllers\Admin', 'prefix' => 'a'], function() {
    Route::get('login', 'Auth\LoginController@showLoginForm')->name('admin.showLoginForm');
    Route::post('login', 'Auth\LoginController@login')->name('admin.postLogin');
    Route::get('logout', 'Auth\LoginController@logout')->name('admin.logout');

    // Route::get('login', 'Auth\LoginController@showLoginForm')->name('admin.showLoginForm');
    Route::get('dashboard', 'PageController@dashboard')->name('admin.dashboard');
    Route::post('checkin', 'PageController@manualcheckIn')->name('admin.checkin');
    Route::get('rsvp', 'PageController@rsvp')->name('admin.rsvp');
    Route::get('redemption', 'PageController@redemption')->name('admin.redemption');
    Route::post('rsvpUser', 'PageController@rsvpUser')->name('admin.rsvpUser');
    Route::post('export/redemption', 'PageController@export')->name('export.redemption');
    Route::post('export/checkin', 'PageController@export')->name('export.checkin');    
    Route::get('qr_code/{id}', 'PageController@qrcode')->name('admin.qrcode');
    Route::post('redemptionCheckin', 'PageController@redemptionCheckIn')->name('admin.redemption.checkin');
    Route::get('engagement', 'PageController@engagement')->name('admin.engagement');
    Route::get('engagement2', 'PageController@engagement2')->name('admin.engagement2');

});