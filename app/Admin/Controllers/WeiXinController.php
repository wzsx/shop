<?php

namespace App\Admin\Controllers;

use App\Model\WeixinUser;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use GuzzleHttp;
use App\Model\WeixinChatModel;
use Illuminate\Support\Facades\Storage;
class WeiXinController extends Controller
{
    use HasResourceActions;

    /**
     * Index interface.
     *
     * @param Content $content
     * @return Content
     */
    protected $redis_weixin_access_token = 'str:weixin_access_token';     //微信 access_token
    public function index(Content $content)
    {
        return $content
            ->header('Index')
            ->description('description')
            ->body($this->grid());
    }

    /**
     * Show interface.
     *
     * @param mixed $id
     * @param Content $content
     * @return Content
     */
    public function show($id, Content $content)
    {
        return $content
            ->header('Detail')
            ->description('description')
            ->body($this->detail($id));
    }

    /**
     * Edit interface.
     *
     * @param mixed $id
     * @param Content $content
     * @return Content
     */
    public function edit($id, Content $content)
    {
        return $content
            ->header('Edit')
            ->description('description')
            ->body($this->form()->edit($id));
    }

    /**
     * Create interface.
     *
     * @param Content $content
     * @return Content
     */
    public function create(Content $content)
    {
        $user_id=$_GET['user_id'];
//        return $content
//            ->header('Create')
//            ->description('description')
//            ->body($this->form());

$data=WeixinUser::where(['id'=>$user_id])->first();
        return $content
            ->header('Create')
            ->description('description')
            ->body(view('weixin.userchat',['user_info'=>$data])->render());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new WeixinUser);

        $grid->id('Id');
        $grid->uid('Uid');
        $grid->openid('Openid');
        $grid->add_time('Add time');
        $grid->nickname('Nickname');
        $grid->sex('Sex');
        $grid->headimgurl('Headimgurl')->display(function ($img_url){
            return '<img src="'.$img_url.'">';
        });
        $grid->subscribe_time('Subscribe time');

        $grid->actions(function ($actions) {
            // append一个操作
            $key=$actions->getKey();
            $actions->prepend('<a href="/admin/weixin/userinfo/create?user_id='.$key.'"><i class="fa fa-paper-plane"></i></a>');

        });

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(WeixinUser::findOrFail($id));

        $show->id('Id');
        $show->uid('Uid');
        $show->openid('Openid');
        $show->add_time('Add time');
        $show->nickname('Nickname');
        $show->sex('Sex');
        $show->headimgurl('Headimgurl');
        $show->subscribe_time('Subscribe time');

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new WeixinUser);

        $form->number('uid', 'Uid');
        $form->text('openid', 'Openid');
        $form->number('add_time', 'Add time');
        $form->text('nickname', 'Nickname');
        $form->switch('sex', 'Sex');
        $form->text('headimgurl', 'Headimgurl');
        $form->number('subscribe_time', 'Subscribe time');

        return $form;
    }
  
    public function formHl(Request $request)
    {
          // echo '<pre>';print_r($_POST);echo '</pre>';echo '<hr>';
             $url = 'https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token='.$this->getWXAccessToken();
             $openid=$request->input('openid');
             $weixin=$request->input('weixin');
         
             //print_r($url);
             //$content=$request->input('weixin');
             $client = new GuzzleHttp\Client(['base_uri' => $url]);
                 $data = [
                   "touser"=>$openid,
                    "msgtype"=>"text",
                   "text"=>[
                       "content"=>$weixin
                  ]
                 ];
           // var_dump($data);
                 $body = json_encode($data, JSON_UNESCAPED_UNICODE);      //处理中文编码
                 $r = $client->request('POST', $url, [
                     'body' => $body
                 ]);
         
                 // 3 解析微信接口返回信息
         
                 $response_arr = json_decode($r->getBody(), true);
                 echo '<pre>';
                 print_r($response_arr);
                 echo '</pre>';
         
                 if ($response_arr['errcode'] == 0) {
                     //存入数据库
                         $data=[
                             'text'=>$weixin,
                             'add_time'=>time(),
                             'openid'=>$openid,
                             'nickname'=>'客服'
         
                     ];
                         $res=WeixinChatModel::insert($data);
                     $arr=[
                         'code'=>0,
                         'msg'=>'发送成功',
                     ];
                 }else{
                     $arr=[
                         'code'=>1,
                         'msg'=>$response_arr['errmsg'],
                     ];
                 }
             echo json_encode($arr);
         }
         public function getWXAccessToken()
    {

        //获取缓存
        $token = Redis::get($this->redis_weixin_access_token);
        if(!$token){        // 无缓存 请求微信接口
            $url = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.env('WEIXIN_APPID').'&secret='.env('WEIXIN_APPSECRET');
            $data = json_decode(file_get_contents($url),true);

            //记录缓存
            $token = $data['access_token'];
            Redis::set($this->redis_weixin_access_token,$token);
            Redis::setTimeout($this->redis_weixin_access_token,3600);
        }
        return $token;

    }
             public function wx(Request $request){
                 $openid=$request->input('openid');
                 $new=WeixinChatModel::orderBy('add_time','asc')->where(['openid'=>$openid])->get();
                 echo json_encode($new);
             }
         

}
