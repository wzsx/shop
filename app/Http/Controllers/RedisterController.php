<?php

namespace App\Http\Controllers\vip;

use Illuminate\Http\Request;
use App\Model\Cmsmodel;
use App\Http\Controllers\Controller;

class RedisterController extends Controller
{
    //
    public function RedisterController($id){
        echo 'ID:'.$id;
        echo __METHOD__;
        $table=Cmsmodel::where(['id'=>$id])->first()->toArray();
        print_r($table);
    }
}
