<?php
use Illuminate\Support\Facades\Route;

// Authentication
Route::group(array('prefix' => '/admin'), function(){
    $module_controller = "App\Http\Controllers\Admin\AuthController@";
    Route::any('/',['as'=>'','uses'=>$module_controller.'login']);
    Route::any('/authenticate',['as'=>'','uses'=>$module_controller.'authenticateUser']);
    Route::any('/registration',['as'=>'','uses'=>$module_controller.'register']);
    Route::any('/storeuser',['as'=>'','uses'=>$module_controller.'submitSignUpForm']);
    Route::any('/logout',['as'=>'','uses'=>$module_controller.'signOut']);
});

Route::group(array('prefix' => '/admin','middleware' => ['web','admin']), function(){
    $module_controller = "App\Http\Controllers\Admin\DashboardController@";
    Route::any('/dashboard',['as'=>'','uses'=>$module_controller.'index']);
    
    //Board Controller route//
    $module_controller = "App\Http\Controllers\Admin\BoardController@";
    Route::any('/board',['as'=>'','uses'=>$module_controller.'index']);
    Route::post('/addBoard',['as'=>'','uses'=>$module_controller.'addBoard']);
    Route::get('/getBoarddata',['as'=>'','uses'=>$module_controller.'getBoarddata']);
    Route::get('/fetchBoardData',['as'=>'','uses'=>$module_controller.'fetchBoardData']);
    Route::delete('/deleteBoarddata',['as'=>'','uses'=>$module_controller.'deleteBoarddata']);

    //Medium Controller Route//
    $module_controller = "App\Http\Controllers\Admin\MediumController@";
    Route::any('/medium',['as'=>'','uses'=>$module_controller.'index']);
    Route::post('/addMedium',['as'=>'','uses'=>$module_controller.'addMedium']);
    Route::get('/getMediumAllData',['as'=>'','uses'=>$module_controller.'getMediumAllData']);
    Route::get('/updateGetMediumData',['as'=>'','uses'=>$module_controller.'updateGetMediumData']);
    Route::delete('/deleteMediumData',['as'=>'','uses'=>$module_controller.'deleteMediumData']);

    //Class Controller Route//
    $module_controller = "App\Http\Controllers\Admin\ClassController@";
    Route::any('/class',['as'=>'','uses'=>$module_controller.'index']);
    Route::get('/getMediums',['as'=>'','uses'=>$module_controller.'getMedium']);
    Route::post('/addClass',['as'=>'','uses'=>$module_controller.'addClass']);
    Route::get('/getClassAllData',['as'=>'','uses'=>$module_controller.'getClassAllData']);
    Route::get('/updateGetClassData',['as'=>'','uses'=>$module_controller.'updateGetClassData']);
    Route::delete('/deleteClassData',['as'=>'','uses'=>$module_controller.'deleteClassData']);
    
    //Subject Route Here//
    $module_controller = "App\Http\Controllers\Admin\SubjectController@";
    Route::any('/subject',['as'=>'','uses'=>$module_controller.'index']);
    Route::any('/getClass',['as'=>'','uses'=>$module_controller.'getClass']);
    
    $module_controller = "App\Http\Controllers\Admin\TopicController@";
    Route::any('/topics',['as'=>'','uses'=>$module_controller.'index']);
    Route::get('/getTopicAllData',['as'=>'','uses'=>$module_controller.'getTopicAllData']);
    Route::any('/getClassAjax',['as'=>'','uses'=>$module_controller.'getClassesAjax']);
    Route::any('/getSubjectsAjax',['as'=>'','uses'=>$module_controller.'getSubjectsAjax']);
    Route::any('/getChapterAjax',['as'=>'','uses'=>$module_controller.'getChapterAjax']);
    Route::post('/addTopic',['as'=>'','uses'=>$module_controller.'addTopic']);
    Route::get('/updateGetTopicData',['as'=>'','uses'=>$module_controller.'updateGetTopicData']);
    Route::delete('/deleteTopicData',['as'=>'','uses'=>$module_controller.'deleteTopicData']);
});