<?php

use GuzzleHttp\Promise\Is;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IssueController;
use App\Http\Controllers\ProjectController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
  //  return $request->user();
//});

Route::get('issue-comments',[IssueController::class,'index']);
Route::post('store',[IssueController::class,'store']);
Route::get('getIssueUserCompleted',[IssueController::class,'getIssueUserCompleted']);
Route::get('getOpenUrgentIssues/{project}',[IssueController::class,'getOpenUrgentIssues']);
Route::get('getOpenIssue/{project}',[IssueController::class,'getOpenIssue']);

