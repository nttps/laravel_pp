<?php

namespace NttpDev\Model;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'name' , 'title' ,'value' , 'type' ,  'options' ,  'sorting_number'
    ];

    public function getOptionsAttribute(){
        $array = [];
        if($this->atrributes['options'] != null){
            $array = explode(',', $this->atrributes['options']);
        }

        return $array;
    }
}
