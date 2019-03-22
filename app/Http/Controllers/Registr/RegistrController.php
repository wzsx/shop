<?php

namespace App\Http\Controllers\vip;

use Illuminate\Http\Request;
use App\Model\Cmsmodel;
use App\Http\Controllers\Controller;

class RegistrController extends Controller
{
    //
    public function RegistrController($id){
        echo 'ID:'.$id;
        echo __METHOD__;
        $table=Cmsmodel::where(['id'=>$id])->first()->toArray();
        print_r($table);
    }
}
