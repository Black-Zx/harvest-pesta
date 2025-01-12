<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PassportAuthController;
use App\Http\Controllers\API\V1\EWalletController;
use App\Http\Controllers\API\V1\OtpController;
use App\Http\Controllers\API\V1\DashboardController;
use App\Http\Controllers\API\V1\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('register', [PassportAuthController::class, 'register']);
// Route::post('registerCS', [CSAuthController::class, 'register']);
Route::post('userLogin', [PassportAuthController::class, 'userLogin']);
Route::post('csLogin', [PassportAuthController::class, 'customerServiceLogin']);
Route::post('adminLogin', [PassportAuthController::class, 'adminLogin']);
// Route::post('loginCS', [CSAuthController::class, 'loginWithPassport']);
Route::get('calculateBonus', [EWalletController::class, 'calculateBonus']);
Route::get('updateLeaderboard', [EWalletController::class, 'updateLeaderboard']);

// Route::namespace('API')->middleware(['auth:webpass'])->group(function () {
//     // Route::resource('roles', RoleController::class);
//     Route::post('purchaseInsurancePoint', [EWalletController::class, 'purchaseInsurancePoint']);
//     Route::post('transferInsurancePoint', [EWalletController::class, 'transferInsurancePoint']);
//     Route::post('convertInsurancePoint', [EWalletController::class, 'convertInsurancePoint']);
//     Route::post('withdrawBonus', [EWalletController::class, 'withdrawBonus']);
//     Route::post('claimGuarantee', [EWalletController::class, 'claimGuarantee']);
//     // Route::post('calculateBonus', [EWalletController::class, 'calculateBonus']);
//     Route::post('showUserTree', [EWalletController::class, 'showUserTree']);
//     Route::post('getGroupBonus', [EWalletController::class, 'getGroupBonus']);
//     Route::post('reportList/{limit?}', [EWalletController::class, 'reportList']);
//     Route::post('directSponsorBonus', [DashboardController::class, 'directSponsorBonus']);
//     Route::post('otherBonus', [DashboardController::class, 'otherBonus']);
//     Route::post('bonusPoint', [DashboardController::class, 'bonusPoint']);
//     Route::post('insurancePoint', [DashboardController::class, 'insurancePoint']);
//     Route::post('winningPool', [DashboardController::class, 'winningPool']);
//     Route::post('totalMemberByType', [DashboardController::class, 'totalMemberByType']);
//     Route::post('getGroupBonus', [DashboardController::class, 'getGroupBonus']);
//     Route::post('findUserByUsername', [UserController::class, 'findUserByUsername']);
//     Route::post('changeBankAccount', [UserController::class, 'changeBankAccount']);
//     Route::post('changePassword', [UserController::class, 'changePassword']);
// });

// Route::namespace('API')->middleware(['auth:cspass'])->group(function () {
//     Route::post('approveInsurancePointPurchase', [EWalletController::class, 'approveInsurancePoint']);
//     Route::post('approveBonusWithdraw', [EWalletController::class, 'approveBonusWithdraw']);
//     Route::post('approveUser', [EWalletController::class, 'approveUser']);
//     Route::post('approveList/{limit?}', [EWalletController::class, 'approveList']);
//     Route::post('requestOtp', [OtpController::class, 'store']);
//     Route::post('checkOtp', [OtpController::class, 'checkOtp']);
//     Route::post('createBonus', [EWalletController::class, 'createBonus']);
//     Route::post('approveClaim', [EWalletController::class, 'approveClaim']);
//     Route::post('uploadBanner', [DashboardController::class, 'uploadBanner']);
//     Route::post('membersReport', [UserController::class, 'membersReport']);
//     Route::post('insurancePointsReport', [UserController::class, 'insurancePointsReport']);
    
// });
