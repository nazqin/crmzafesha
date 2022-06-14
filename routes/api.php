<?php

use App\Models\upcoming;
use App\Http\Resources\UpcomingResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//** Upcoming Task */

//get all upcoming task
Route::get("/upcoming", function(){
    $upcoming = Upcoming::all();
    return UpcomingResource::collection($upcoming);
});

//add a new task
Route::post('/upcoming', function (Request $request) {
    return Upcoming::create([
        'title' => $request->title,
        'taskId' => $request->taskId,
        'waiting'=> $request->waiting
    ]);
});

//delete upcoming
Route::delete('/upcoming/{taskId}', function ($taskId) {
    DB::table ('upcomings')->where ('taskId', $taskId) ->delete();

    return 204;
});

//today task
Route::post('/dailytask',function(Request $request){
    return Today::create([
        'id' =>$request->id,
        'title'=>$request->title,
        'taskId'=>$request->taskId,
    ]);
});

//delete today task
Route::delete('/dailytask/{taskId}',function($taskId){
    DB:table('todays')->where('taskId',$taskId)->delete();
    return 204;
});