<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/1/2
 * Time: 13:18
 */
namespace Admin\Controller;
use Think\Controller;
class CommonController extends Controller{

    function _initialize(){
        if(!session('?uid')){
            $this->error('请先登陆','/admin/index/login',3);
        }


    }
}