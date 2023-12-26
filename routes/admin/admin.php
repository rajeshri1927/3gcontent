<?php
use Illuminate\Support\Facades\Route;

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
    Route::any('/medium', [MediumController::class, 'index']);
    Route::post('/addMedium', [MediumController::class,'addMedium']);
    Route::get('/getMediumAllData',[MediumController::class,'getMediumAllData']);
    Route::get('/updateGetMediumData',[MediumController::class,'updateGetMediumData']);
    Route::delete('/deleteMediumData',[MediumController::class,'deleteMediumData']);

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
    Route::any('/addSubject',['as'=>'','uses'=>$module_controller.'addSubject']);
    Route::any('/getSubjectAllData',['as'=>'','uses'=>$module_controller.'getSubjectAllData']);
    Route::any('/updateGetSubjectData',['as'=>'','uses'=>$module_controller.'updateGetSubjectData']);
    Route::any('/deleteSubjectData',['as'=>'','uses'=>$module_controller.'deleteSubjectData']);  
});