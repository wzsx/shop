<?php
namespace App\Http\Controllers\Weixin;

use App\Model\YkModel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use GuzzleHttp;
use Illuminate\Support\Facades\Storage;
class WxykController extends Controller
{
    protected $redis_weixin_access_token = 'str:weixin_access_token';     //微信 access_token
    protected $redis_weixin_jsapi_ticket = 'str:weixin_jsapi_ticket';     //微信 jsapi_ticket
    public function yk(){
        return view ("weixin.yk");
    }
    public function ddd(){
        return view ("weixin.ddd");
    }
    public function ccc(){
        return view ("weixin.ccc");
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

    public function token(){
        Redis::del($this->redis_weixin_access_token);
        echo $this->getWXAccessToken();
    }
    //自定义菜单
    public function createss(){
        //1 获取access_token 拼接请求接口
        $url = 'https://api.weixin.qq.com/cgi-bin/menu/create?access_token='.$this->getWXAccessToken();
        //2 请求微信接口
        $client = new GuzzleHttp\Client(['base_uri' => $url]);

        $data = [
            "button"    => [
                [
                    "name"=>"秀歌",
                    "sub_button"=>[
                        [
                            "type"  => "click",      // click类型
                            "name"  => "阴雨天",
                            "key"   => "kefu01"
                        ]
                    ]
                ],
                [
                    "name"=>"XXX",
                    "sub_button"=>[
                        [
                            "type"  => "view",      // view类型 跳转指定 URL
                            "name"  => "发布",
                            "url"   => "http://xiuge.52self.cn/weixin/yk"
                        ]
                    ]
                ]
            ]
        ];


        $r = $client->request('POST', $url, [
            'body' => json_encode($data,JSON_UNESCAPED_UNICODE)
        ]);
        // 3 解析微信接口返回信息

        $response_arr = json_decode($r->getBody(),true);
        if($response_arr['errcode'] == 0){
            echo "菜单创建成功";
        }else{
            echo "菜单创建失败，请重试";echo '</br>';
            echo $response_arr['errmsg'];
        }
    }

}