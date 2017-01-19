<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/12/20
 * Time: 19:19
 */
 function mytest(){

     echo "自定义的方法 自能在common下创建 function.php";

 }

//无限分级
  function getDeptTree($arr,$pid=0){
      static $result=array();
      foreach($arr as $value){
          if($value['dept_pid']== $pid){
              $result[]=$value;
              getDeptTree($arr,$value['dept_id']);
          }
      }

      return $result;

  }
//获取时间
  function getNowDate(){

      return date('Y-m-d');
  }
//获取时间
  function getNowDateTime(){
      return date('Y-m-d H:i:s');
  }
//给密码md5加密的方法
  function passWordMd5($password){
      return md5($password);
  }
  //检查用户名是否存在
 function CheckName($username){
     $user=D('user');
    $result= $user->field('user_name')->where("user_name='$username'")->find();
    // dump($result);die();
     if(in_array($username,$result)){
         return false;
     }else{
         return true;
     }
 }
    function getUid(){

       return session('uid');
    }
   function getNameById(){
       $id=session('uid');
       $user=D('user');
       $sql="select user_name from oa_user where user_id=$id ";
       $data=$user->query($sql);
       return $data[0]['user_name'];
   }
