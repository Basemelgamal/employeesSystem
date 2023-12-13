<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait FileAttributes
{
    /**
     * @return null|string
     */
    public function getImageAttribute(){
        if(isset($this->attributes['image'])){
            if(strpos($this->attributes['image'],'https') !== false ||strpos($this->attributes['image'],'http') !== false ){
                if(file_exists(public_path('storage/'.$this->imageFolder.'/'.$this->attributes['image']))){
                    return $this->imageFolder.'/'.$this->attributes['image'];
                }else{
                    return  $this->attributes['image'];
                }
            }else{
                if(file_exists(public_path('storage/'.$this->imageFolder.'/'.Str::snake($this->attributes['image'])))){
                    return getImg(Str::snake($this->attributes['image']),$this->imageFolder);
                }
            }
        }
    }

    /**
     * @param $value
     */
    public function setImageAttribute($value){
        if (!empty($value)){
            if (is_string($value)) {
                $this->attributes['image'] = $value;
            } else {
                $values = $value->storeAs($this->imageFolder, generateImageName($value),"public");
                $arrVal =explode('/',$values);
                $this->attributes['image']=Str::snake($arrVal[count($arrVal)-1]);
            }
        }
        return $this->attributes['image'];
    }
}
