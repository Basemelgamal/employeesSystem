<?php

use App\Models\Factory;
use Illuminate\Support\Str;
use Carbon\Carbon;

if(!function_exists('generateImageName')){
    /**
     * @param $file
     * @return string
     */
    function generateImageName($file){
        $fileNameWithExt = $file->getClientOriginalName();
        $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
        $extention = $file->getClientOriginalExtension();
        $fileNameToStore = $filename.'_'.time().'.'.$extention;
        return Str::snake($fileNameToStore);
    }
}

if(!function_exists('getImg')){
    /**
     * @param $filename
     * @return string
     */
    function getImg($filename,$imageFolder){

        if (!empty($filename)) {
            $base_url = url('/');
            return $base_url . '/storage/' .$imageFolder. '/'. $filename;
        } else {
            return '';
        }
    }
}

if(!function_exists('setImage')){
    /**
     * @param $filename
     * @return string
     */
    function setImage($value, $imageFolder){
        if (!empty($value)){
            $values = $value->storeAs($imageFolder, generateImageName($value),"public");
            $arrVal =explode('/',$values);
            return Str::snake($arrVal[count($arrVal)-1]);
        }
    }
}

