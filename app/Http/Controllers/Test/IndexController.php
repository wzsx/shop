<?php
namespace App\Http\Controllers\Test;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller{
    public function index(Request $request){
        $current_url ='http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
        $data =[
            'login' =>$request->get('is_login'),
            'current_url'  => urlencode($current_url),
        ];
        return view('test.index',$data);

    }
    public function apiLogin(Request $request){
     $email=$request->input('email');
     $password=$request->input('pass');
     $data =[
         'email' =>$email,
         'pass'  =>$password
     ];
     $url='http://xiuge.52self.cn/pss';
     $ch =curl_init($url);
     curl_setopt($ch,CURLOPT_HEADER,0);
     curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
     curl_setopt($ch,CURLOPT_POST,1);
     curl_setopt($ch,CURLOPT_POSTFIELDS,$data);
     $response = curl_exec($ch);
     curl_close($ch);
     $response =json_decode($response,true);
     if($response['errno']==0){
         $response=[
             'errno' =>0,
             'msg' => '登录成功',
             'token' =>$response['token']
         ];
     }
     return $response;
    }
}

?>