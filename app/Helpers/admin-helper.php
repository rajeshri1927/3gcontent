<?php
use App\Models\Setting;
use App\Models\PaperSetting;
use App\Models\Chapter;

function encryptFormData()
{
    $randomString = '';
    $setting_arr = array('settingKey' => '', 'settingValue' => 0);

    $data_obj = Setting::where('setting_master_Id', 1)->where('settingKey', 'formEncryption')->first();
    $randomString = $data_obj->settingValue;
    return $randomString;
}

function getPaperSettings($user_id)
{
    $data_obj = PaperSetting::where('user_id', 'ADMIN_65D01B99B')->first();
    // $data_obj = PaperSetting::where('user_id', $user_id)->first();
    if (!empty($data_obj)) {
        return $data_obj;
    } else {
        return false;
    }
}

function getChapterDetailsAsPerSubjectId($subjectId){
    $data_obj = Chapter::where('subject_id', $subjectId)->orderBy('chapter_no','ASC')->get();
    if (!empty($data_obj)) {
        return $data_obj;
    }else{
        return false;
    }
}