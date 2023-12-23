<?php
use App\Models\Setting;

function encryptFormData()
{
    $randomString = '';
    $setting_arr = array('settingKey' => '', 'settingValue' => 0);

    $data_obj = Setting::where('setting_master_Id', 1)->where('settingKey', 'formEncryption')->first();
    $randomString = $data_obj->settingValue;
    return $randomString;
}