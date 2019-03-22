<?php
/**
 * Created by PhpStorm.
 * User: 王晨琦
 * Date: 2019/1/23
 * Time: 8:43
 */

namespace App\Http\Controllers\vip;

use Illuminate\Http\Request;
use App\Model\Cmsmodel;
use App\Http\Controllers\Controller;

class RegController extends Controller
{
    //
    public function RegistrController($id){
        echo 'ID:'.$id;
        echo __METHOD__;
        $table=Cmsmodel::where(['id'=>$id])->first()->toArray();
        print_r($table);
    }
}
