<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/12/26
 * Time: 19:52
 */
namespace Admin\Model;
use Think\Model;
class emailModel extends Model{
    protected  $pk='email_id';

    protected $fields=array(
     'email_id','email_title','email_content','email_file','email_from','email_to','email_ctime',
    );
   protected $_map=array(
        'title'=>'doc_title',
        'content'=>'doc_content',



    );

    protected $_auto=array(
        // array(完成字段1,完成规则,[完成条件,附加规则]),
        //   email_ctime  email_from session中的自己
        array('email_ctime','getNowDate',1,'function'),
        array('email_from','getUid',1,'function'),
        array('email_to','getToName',1,'callback'),
    );
     function getToName(){
           $ToName=I('post.email_to');
         $user=M();
         $sql="select user_id  from oa_user where user_name='$ToName'";
          $arr=$user->query($sql);
         return $arr[0]['user_id'];
     }

}