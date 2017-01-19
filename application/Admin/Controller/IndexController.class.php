<?php
//声明命名空间
namespace admin\Controller;
//引入控制基础类
use Think\Controller;
class IndexController extends Controller {

    public function index(){
   /*     $num = 10;
       function multiply(){
            $num=100;
            $num = $num * 10;
            }
        multiply();*/
     //   echo $num;



       //phpinfo();
        $this->display('login');

    }

    public function login(){

        $this->display();

    }
    public function verify(){
        //定义验证码配置项
        $config = array(
            'bg'  =>  array(93, 202, 27),  // 背景颜色
            'useCurve'  =>  false,            // 是否画混淆曲线
            'useNoise'  =>  false,            // 是否添加杂点
            'imageH'    =>  40,               // 验证码图片高度
            'imageW'    =>  75,               // 验证码图片宽度
            'fontSize'  =>  15,              // 验证码字体大小(px)
            'fontttf'   =>  '4.ttf',              // 验证码字体，不设置随机获取
            'length'    =>  4,               // 验证码位数
        );

        $verify= new \Think\Verify($config);
        $verify->login();

    }

             public function checkLogin(){
                 $code = I('post.code');

                 $verify=new \Think\Verify();
                 if(!$verify->check($code)){

                    $this->error('验证码不正确',U('login'),3);
                 }
                   $username=I('post.username');
                   $password=I('post.password');
                     $user=D('user');
                   if($user->check_Login($username,$password)){
                       $this->success('登陆成功',U('main/index'),3);
                   }else{
                       $this->error('登陆失败',U('login'),3);
                   }

             }



}