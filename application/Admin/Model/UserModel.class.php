<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/12/21
 * Time: 20:33
 */
namespace Admin\Model;
use Think\Model;
class UserModel extends Model{
    //批处理开启验证
    protected $patchValidate=true;

     protected $pk='user_id';
    protected $fields=array(
        'user_id','user_name','user_nickname','user_password','user_dept',
        'user_sex', 'user_birthday','user_tel','user_email','user_ctime'
    );
    protected $_map=array(

        'name'    =>'user_name',
        'nickname'=>'user_nickname',
     'password'   =>'user_password',
        'dept'    =>'user_dept',
        'sex'     =>'user_sex',
        'birthday'=>'user_birthday',
        'tel'     =>'user_tel',
        'email'   =>'user_email'


    );


   protected $_validate=array(
       //array(验证字段1,验证规则,错误提示,[验证条件,附加规则,验证时间]),
     /*  array('user_name','username','用户名必须3到13位',1,'regex',3),
       array('user_password','password','密码必须包括数组字母下滑线,4到10位',1,'regex',3),
       array('re-password','user_password','两次密码必须一致',0,'confirm',3),
       array('user_tel','tel','手机格式不正确',1,'regex',3),
       array('user_email','email','email格式不正确',1,'regex',3),*/
       array('user_name','CheckName','用户已经存在',1,'function',3),
    );
    protected $_auto=array(
      array('user_password','passWordMd5',3,'function'),
      array('user_ctime','getNowDateTime',3,'function')

    );

    function check_Login($username,$password){
    $user=D('user');
    $arr=$user->where("user_name='$username'")->find();


        if(empty($arr)){

           return false;
        }
            if($arr['user_name']==$username && $arr['user_password']==md5($password)){
                session('uname',$arr['user_name']);
                session('unickname',$arr['user_nickname']);
                session('udept',$arr['user_dept']);
                session('uid',$arr['user_id']);


                //保存用户信息到session

                // 将用户角色存入session
                session('roleid', $arr['user_role']);
                // 从Role表中查询role_path
                $tmp = D('Role')->field('role_path')->find($arr['user_role']);
                // 将role_path保存到session中
                session('rolepath', $tmp['role_path']);

                return true;
            }else{
                return false;
            }
        }

}