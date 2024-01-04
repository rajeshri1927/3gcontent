<?php
use Illuminate\Support\Facades\Route;

//Authentication//
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
    Route::get('/getBoardAllData',['as'=>'','uses'=>$module_controller.'getBoardAllData']);
    Route::any('/updateBoarddata',['as'=>'','uses'=>$module_controller.'updateBoarddata']);
    Route::delete('/deleteBoarddata',['as'=>'','uses'=>$module_controller.'deleteBoarddata']);
    //Route::any('/getNoOfBoards',['as'=>'','uses'=>$module_controller.'getNoOfBoards']);
    

    //Medium Controller Route//
    $module_controller = "App\Http\Controllers\Admin\MediumController@";
    Route::any('/medium',['as'=>'','uses'=>$module_controller.'index']);
    Route::post('/addMedium',['as'=>'','uses'=>$module_controller.'addMedium']);
    Route::get('/getMediumAllData',['as'=>'','uses'=>$module_controller.'getMediumAllData']);
    Route::any('/updateGetMediumData',['as'=>'','uses'=>$module_controller.'updateGetMediumData']);
    Route::delete('/deleteMediumData',['as'=>'','uses'=>$module_controller.'deleteMediumData']);

    //Class Controller Route//
    $module_controller = "App\Http\Controllers\Admin\StandardController@";
    Route::any('/standard',['as'=>'','uses'=>$module_controller.'index']);
    Route::get('/getMediums',['as'=>'','uses'=>$module_controller.'getMedium']);
    Route::post('/addClass',['as'=>'','uses'=>$module_controller.'addClass']);
    Route::get('/getClassAllData',['as'=>'','uses'=>$module_controller.'getClassAllData']);
    Route::any('/updateGetClassData',['as'=>'','uses'=>$module_controller.'updateGetClassData']);
    Route::delete('/deleteClassData',['as'=>'','uses'=>$module_controller.'deleteClassData']);
    
    //Subject Route Here//
    $module_controller = "App\Http\Controllers\Admin\SubjectController@";
    Route::any('/subject',['as'=>'','uses'=>$module_controller.'index']);
    Route::any('/getClass',['as'=>'','uses'=>$module_controller.'getClass']);
    Route::any('/addSubject',['as'=>'','uses'=>$module_controller.'addSubject']);
    Route::any('/getSubjectAllData',['as'=>'','uses'=>$module_controller.'getSubjectAllData']);
    Route::any('/updateGetSubjectData',['as'=>'','uses'=>$module_controller.'updateGetSubjectData']);
    Route::any('/deleteSubjectData',['as'=>'','uses'=>$module_controller.'deleteSubjectData']);
    
    //Chapter Route Here//
    $module_controller = "App\Http\Controllers\Admin\ChapterController@";
    Route::any('/chapter',['as'=>'','uses'=>$module_controller.'index']);
    Route::any('/getSubject',['as'=>'','uses'=>$module_controller.'getSubject']);
    Route::any('/addChapter',['as'=>'','uses'=>$module_controller.'addchapter']);
    Route::any('/getChapterAllData',['as'=>'','uses'=>$module_controller.'getChapterAllData']);
    Route::any('/updateGetChaptertData',['as'=>'','uses'=>$module_controller.'updateGetChaptertData']);
    Route::any('/deleteChapterData',['as'=>'','uses'=>$module_controller.'deleteChapterData']);

     //Question Types Route Here//
     $module_controller = "App\Http\Controllers\Admin\QuestionTypeController@";
     Route::any('/questionType',['as'=>'','uses'=>$module_controller.'index']);
     Route::any('/addQuestionType',['as'=>'','uses'=>$module_controller.'addQuestionType']);
     Route::any('/getQuestionTypeAllData',['as'=>'','uses'=>$module_controller.'getQuestionTypeAllData']);
     Route::any('/getTopicAjax',['as'=>'','uses'=>$module_controller.'getTopicAjax']);
     Route::any('/updateQuestionTypeData',['as'=>'','uses'=>$module_controller.'updateQuestionTypeData']);
     Route::any('/deleteQuestionTypeData',['as'=>'','uses'=>$module_controller.'deleteQuestionTypeData']);
    
    //Topics Route Here//
    $module_controller = "App\Http\Controllers\Admin\TopicController@";
    Route::any('/topics',['as'=>'','uses'=>$module_controller.'index']);
    Route::get('/getTopicAllData',['as'=>'','uses'=>$module_controller.'getTopicAllData']);
    Route::get('/getTopicMediums',['as'=>'','uses'=>$module_controller.'getMedium']);
    Route::any('/getClassAjax',['as'=>'','uses'=>$module_controller.'getClassesAjax']);
    Route::any('/getSubjectsAjax',['as'=>'','uses'=>$module_controller.'getSubjectsAjax']);
    Route::any('/getChapterAjax',['as'=>'','uses'=>$module_controller.'getChapterAjax']);
    Route::post('/addTopic',['as'=>'','uses'=>$module_controller.'addTopic']);
    Route::get('/updateGetTopicData',['as'=>'','uses'=>$module_controller.'updateGetTopicData']);
    Route::delete('/deleteTopicData',['as'=>'','uses'=>$module_controller.'deleteTopicData']);
    
    //Question bank Route Here//
    $module_controller = "App\Http\Controllers\Admin\QuestionBankController@";
    Route::any('/questionBank',['as'=>'','uses'=>$module_controller.'index']);
    Route::get('/getQuestionAllData',['as'=>'','uses'=>$module_controller.'getQuestionBankData']);
    Route::any('/addQuestion',['as'=>'','uses'=>$module_controller.'addQuestionBank']);
    Route::any('/getTopicAjax',['as'=>'','uses'=>$module_controller.'getTopicAjax']);
    Route::any('/updateGetQuestionData',['as'=>'','uses'=>$module_controller.'updateQuestionBankData']);
    Route::delete('/deleteQuestionData',['as'=>'','uses'=>$module_controller.'deleteQuestionBankData']);

    //Employee Managment Route Here//
    $module_controller = "App\Http\Controllers\Admin\EmployeeManagentController@";
    Route::any('/employeeManagement',['as'=>'','uses'=>$module_controller.'index']);
    Route::any('/addEmployee',['as'=>'','uses'=>$module_controller.'addEmployee']);
    Route::any('/getEmpAllData',['as'=>'','uses'=>$module_controller.'getEmpAllData']);
    Route::any('/updateGetEmpData',['as'=>'','uses'=>$module_controller.'updateGetEmpData']);
    Route::delete('/deleteEmployeeData',['as'=>'','uses'=>$module_controller.'deleteEmployeeData']);

    //Employee Managment Route Here//
    $module_controller = "App\Http\Controllers\Admin\ClassesManagementController@";
    Route::any('/classesManagement',['as'=>'','uses'=>$module_controller.'index']);
    Route::any('/addClasses',['as'=>'','uses'=>$module_controller.'addClasses']);
    Route::any('/getclassesAllData',['as'=>'','uses'=>$module_controller.'getclassesAllData']);

    // Create question paper routes
    $module_controller = "App\Http\Controllers\Admin\QuestionPaperController@";
    Route::any('/getQuestionPaperAllData',['as'=>'','uses'=>$module_controller.'getQuestionPaperAllData']);
    Route::any('/mcqpaper',['as'=>'','uses'=>$module_controller.'mcqpaperlist']);
    Route::any('/createmcqpaper',['as'=>'','uses'=>$module_controller.'createMcqPaper']);
    Route::any('/addmcqpaper',['as'=>'','uses'=>$module_controller.'addMcqPaperDetails']);
    Route::any('/deleteMCQPaper',['as'=>'','uses'=>$module_controller.'deleteMCQPaperData']);
    Route::any('/viewMCQPaper',['as'=>'','uses'=>$module_controller.'viewMCQPaper']);
    Route::any('/viewMCQPaper/{id}',['as'=>'','uses'=>$module_controller.'viewMCQPaper']);
    Route::any('/subjectivepaper',['as'=>'','uses'=>$module_controller.'subjectivepaperlist']);
    Route::any('/createsubjectivepaper',['as'=>'','uses'=>$module_controller.'createSubjectivePaper']);
    Route::any('/getAllChaptersAjax',['as'=>'','uses'=>$module_controller.'getAllChaptersAjax']);
    Route::any('/getSelectedChapterDetailsAjax',['as'=>'','uses'=>$module_controller.'getSelectedChapterDataAjax']);

    // Ready paper structure routes
    $module_controller = "App\Http\Controllers\Admin\ReadyPaperController@";
    Route::any('/ready_paper_structure',['as'=>'','uses'=>$module_controller.'readyPaperStructure']);
    Route::any('/getReadyQuestionPaperData',['as'=>'','uses'=>$module_controller.'getAllReadyPaperStructureData']);
    Route::any('/addPaperStructureDetails',['as'=>'','uses'=>$module_controller.'readyPaperStructureCreate']);
    Route::any('/updateGetReadyPaperStructureData',['as'=>'','uses'=>$module_controller.'updateReadyPaperStructureData']);
    Route::any('/deleteReadyPaperStructureData',['as'=>'','uses'=>$module_controller.'deletReadyPaperStructure']);
});